<?php

class ImagesController{
    public function upload($config){
        $savePath ='/upload/'.($config['savepath']?$config['savepath']:'/other/');
        $publicPath = __DIR__.'../../../Public';
        $absSavePath =$publicPath.$savePath;
        if (!is_dir($absSavePath)) {
            if (!mkdir($absSavePath, 0777, true)) {
                GLog('upload', '上传目录' . $absSavePath . '无法创建');
                return false;
            }
        }
        $fileInfo = array();
        $files = $this->dealFiles($_FILES);
        foreach ($files as $key => $file) {
            if (empty($file['name'])) {
                continue;
            }
            //登记上传文件的扩展信息
            $file['key'] = $key;
            $pathinfo = pathinfo($file['name']);//取得上传文件的后缀
            $file['extension'] =$pathinfo['extension'] ;
            $file['savepath'] = $savePath;
            $file['abssavepath'] = $absSavePath;
            // 使用子目录保存文件
            $file['savename'] = date('Ymd', time()) . '/'.  md5($file['name']) . "." . $file['extension'];
            $file['filepath'] = '/'.$savePath . $file['savename'];
            if (!$this->check($file,$config)) {
                return false;
            }
            //保存上传文件
            if (!$this->save($file)) {
                return false;
            }
            $fileInfo[] = $file['filepath'];
        }
        return $fileInfo;
    }

    public function uploadBase64($config,$stream){
        if (preg_match('/^(data:\s*image\/(\w+);base64,)/', $stream, $result)) {
            $files = array();
            $savePath ='/upload'.($config['savepath']?$config['savepath']:'/other/');
            $publicPath = __DIR__.'../../../Public';
            $absSavePath =$publicPath.$savePath;
            if (!is_dir($absSavePath)) {
                if (!mkdir($absSavePath, 0777, true)) {
                    GLog('upload', '上传目录' . $absSavePath . '无法创建');
                    return false;
                }
            }
            $type = $result[2];
            $filename=substr(md5($stream), 8, 16) . ".{$type}";
            $src_img =$absSavePath.$filename;
            if (file_put_contents($src_img, base64_decode(str_replace($result[1], '', $stream)))){
                if ((isset($config['fixedWidth']) && $config['fixedWidth'] > 0)
                    && (isset($config['fixedHeight']) && $config['fixedHeight'] > 0)) {//缩略图的高宽必须大于0
                    $thumbfilename='t_'.substr(md5($stream), 8, 16) . ".{$type}";
                    $tsavePath ='/thumb'.($config['savepath']?$config['savepath']:'/other/');
                    $tabsSavePath = __DIR__.'../../../Public'.$tsavePath;
                    $new_file=$tabsSavePath.$thumbfilename;
                    if (!is_dir($tabsSavePath)) {
                        if (!mkdir($tabsSavePath, 0777, true)) {
                            GLog('upload', '上传缩略图目录' . $tabsSavePath . '无法创建');
                            return false;
                        }
                    }
                    if($this->img2thumb($src_img, $new_file, $width = $config['fixedWidth'], $height = $config['fixedHeight'])){
                        //判断是否是个文件
                        $info = getimagesize($new_file);
                        if($info){
                            $files['thumb'] = $tsavePath.$thumbfilename;
                        }else{
                            return false;
                        }
                    }else{
                        return false;
                    }
                }
                //判断是否是个文件
                $info = getimagesize($src_img);
                if($info){
                    $files['img'] = $savePath.$filename;
                }else{
                    return false;
                }
            }
            return $files;
        }
        return false;
    }

    function fileext($file){
        return pathinfo($file, PATHINFO_EXTENSION);
    }

    /**
     * 生成缩略图
     * @param string     源图绝对完整地址{带文件名及后缀名}
     * @param string     目标图绝对完整地址{带文件名及后缀名}
     * @param int        缩略图宽{0:此时目标高度不能为0，目标宽度为源图宽*(目标高度/源图高)}
     * @param int        缩略图高{0:此时目标宽度不能为0，目标高度为源图高*(目标宽度/源图宽)}
     * @param int        是否裁切{宽,高必须非0}
     * @param int/float  缩放{0:不缩放, 0<this<1:缩放到相应比例(此时宽高限制和裁切均失效)}
     * @return boolean
     */
    function img2thumb($src_img, $dst_img, $width = 75, $height = 75, $cut = 0, $proportion = 0)
    {
        if(!is_file($src_img))
        {
            return false;
        }
      //  $ot = $this->fileext($dst_img);
       // $otfunc = 'image' . ($ot == 'jpg' ? 'jpeg' : $ot);
        $srcinfo = getimagesize($src_img);
        $src_w = $srcinfo[0];
        $src_h = $srcinfo[1];
        $type  =$srcinfo['mime'];
        switch ($type) {
            case "image/gif":
                $source = imagecreatefromgif($src_img);
                break;
            case "image/pjpeg":
            case "image/jpeg":
            case "image/jpg":
                $source = imagecreatefromjpeg($src_img);
                break;
            case "image/png":
            case "image/x-png":
                $source = imagecreatefrompng($src_img);
                break;
        }

  //      $createfun = 'imagecreatefrom' . ($type == 'jpg' ? 'jpeg' : $type);

        $dst_h = $height;
        $dst_w = $width;
        $x = $y = 0;

        /**
         * 缩略图不超过源图尺寸（前提是宽或高只有一个）
         */
        if(($width> $src_w && $height> $src_h) || ($height> $src_h && $width == 0) || ($width> $src_w && $height == 0))
        {
            $proportion = 1;
        }
        if($width> $src_w)
        {
            $dst_w = $width = $src_w;
        }
        if($height> $src_h)
        {
            $dst_h = $height = $src_h;
        }

        if(!$width && !$height && !$proportion)
        {
            return false;
        }
        if(!$proportion)
        {
            if($cut == 0)
            {
                if($dst_w && $dst_h)
                {
                    if($dst_w/$src_w> $dst_h/$src_h)
                    {
                        $dst_w = $src_w * ($dst_h / $src_h);
                        $x = 0 - ($dst_w - $width) / 2;
                    }
                    else
                    {
                        $dst_h = $src_h * ($dst_w / $src_w);
                        $y = 0 - ($dst_h - $height) / 2;
                    }
                }
                else if($dst_w xor $dst_h)
                {
                    if($dst_w && !$dst_h)  //有宽无高
                    {
                        $propor = $dst_w / $src_w;
                        $height = $dst_h  = $src_h * $propor;
                    }
                    else if(!$dst_w && $dst_h)  //有高无宽
                    {
                        $propor = $dst_h / $src_h;
                        $width  = $dst_w = $src_w * $propor;
                    }
                }
            }
            else
            {
                if(!$dst_h)  //裁剪时无高
                {
                    $height = $dst_h = $dst_w;
                }
                if(!$dst_w)  //裁剪时无宽
                {
                    $width = $dst_w = $dst_h;
                }
                $propor = min(max($dst_w / $src_w, $dst_h / $src_h), 1);
                $dst_w = (int)round($src_w * $propor);
                $dst_h = (int)round($src_h * $propor);
                $x = ($width - $dst_w) / 2;
                $y = ($height - $dst_h) / 2;
            }
        }
        else
        {
            $proportion = min($proportion, 1);
            $height = $dst_h = $src_h * $proportion;
            $width  = $dst_w = $src_w * $proportion;
        }
      //  $src = $createfun("$src_img");
        $dst = imagecreatetruecolor($width ? $width : $dst_w, $height ? $height : $dst_h);
        $white = imagecolorallocate($dst, 255, 255, 255);
        imagefill($dst, 0, 0, $white);

        if(function_exists('imagecopyresampled'))
        {
            imagecopyresampled($dst, $source, $x, $y, 0, 0, $dst_w, $dst_h, $src_w, $src_h);
        }
        else
        {
            imagecopyresized($dst, $source, $x, $y, 0, 0, $dst_w, $dst_h, $src_w, $src_h);
        }
        switch ($type) {
            case "image/gif":
                imagegif($dst, $dst_img);
                break;
            case "image/pjpeg":
            case "image/jpeg":
            case "image/jpg":
                imagejpeg($dst, $dst_img);
                break;
            case "image/png":
            case "image/x-png":
                imagepng($dst, $dst_img);
                break;
        }
        imagedestroy($dst);
        imagedestroy($source);
        return true;
    }



    /**
     * 转换上传文件数组变量为正确的方式
     * @access private
     * @param array $files 上传的文件变量
     * @return array
     */
    public function dealFiles($files) {
        $fileArray = array();
        $n = 0;
        foreach ($files as $file) {
            if (is_array($file['name'])) {
                $keys = array_keys($file);
                $count = count($file['name']);
                for ($i = 0; $i < $count; $i++) {
                    foreach ($keys as $key)
                        $fileArray[$n][$key] = $file[$key][$i];
                    $n++;
                }
            } else {
                $fileArray[$n] = $file;
                $n++;
            }
        }
        return $fileArray;
    }

    /**
     * 检查上传的文件
     * @access private
     * @param array $file 文件信息
     * @return boolean
     */
    public function check($file,$config) {
        // 如果是图像文件 检测文件格式
        if (in_array(strtolower($file['extension']), array('gif', 'jpg', 'jpeg', 'bmp', 'png', 'swf'))) {
            $imgInfo = getimagesize($file['tmp_name']);
            if (false === $imgInfo) {
                return '非法图像文件';
            }
            if(isset($config['maxWidth']) || isset($config['maxHeight'])){
                if (($config['maxWidth'] > 0 && $imgInfo[0] > $config['maxWidth']) ||
                    ($config['maxHeight'] > 0 && $imgInfo[1] > $config['maxHeight'])) {
                    return "图片长宽不能超过{$config['maxWidth']}*{$config['maxHeight']}";
                }
            }
            if(isset($config['fixedWidth']) || isset($config['fixedHeight'])) {
                if (($config['fixedWidth'] > 0 && $imgInfo[0] != $config['fixedWidth']) ||
                    ($config['fixedHeight'] > 0 && $imgInfo[1] != $config['fixedHeight'])
                ) {
                    return "图片长宽需为 {$config['fixedWidth']}*{$config['fixedHeight']}";
                }
            }
        }
        if ($file['error'] !== 0) {
            //文件上传失败
            //捕获错误代码
            return ($file['error']);
        }
        //文件上传成功，进行自定义规则检查
        //检查文件大小
        if(isset($config['maxSize'])){
            if ($config['maxSize'] > 0 && $file['size'] > $config['maxSize']) {
                return  '上传文件最大为'.$config['maxSize'].'B！';
            }
        }

        //检查文件Mime类型
        if (!empty($config['allowTypes']) && !in_array(strtolower($file['type']), $config['allowTypes'])) {
            return '上传文件MIME类型不允许！';
        }

        //检查文件类型
        if (!empty($config['allowExts']) && !in_array(strtolower($file['extension']), $config['allowExts'], true)) {
            return '上传文件类型不允许';
        }

        //检查是否合法上传
        if (!is_uploaded_file($file['tmp_name'])) {
            return '非法上传文件！';
        }
        return true;
    }

    /**
     * 上传一个文件
     * @access public
     * @param mixed $name 数据
     * @param string $value 数据表名
     * @return string
     */
    public function save($file) {
        $filename = $file['abssavepath'] . $file['savename'];
        if (is_file($filename)) {
            // 不覆盖同名文件
            return  '文件已经存在！' . $filename;
        }

        if (!is_dir(dirname($filename))) {
            mkdir(dirname($filename), 0755, true);
        }
        if (!move_uploaded_file($file['tmp_name'], $filename)) {
            return '文件上传保存错误！';
        }
        return true;
    }



    /**
     * base64上传
     */
    public function createimg(){
        $stream = I('post.stream');
        $path = C('UPLOAD_PATH');
        if (preg_match('/^(data:\s*image\/(\w+);base64,)/', $stream, $result)) {
            $type = $result[2];
            $savePath =  'upload/'.date('Y-m-d').'/';
            $mdpath =$path.$savePath;
            if(!is_dir($mdpath)){
                mkdir($mdpath, 0777);
            }
            $filename =$savePath.substr(md5($stream), 8, 16) . ".{$type}";
            if (file_put_contents($path.$filename,base64_decode(substr(strstr($stream,','),1)))) {
                $info = getimagesize($path.$filename);
                //判断是否是个文件
                if($info){
                    apiReturn(CodeModel::ERROR,'图片上传成功',$filename);
                }else{
                    apiReturn(CodeModel::ERROR,'图片上传失败');
                }
            }else{
                apiReturn(CodeModel::ERROR,'图片保存失败'.$path.$savePath);
            }
        }else{
            apiReturn(CodeModel::ERROR,'图片流上传失败');
        }
    }
}
?>