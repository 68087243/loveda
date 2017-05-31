<?php
header('Content-type: text/html; charset=UTF-8');
require './kindeditor/php/JSON.php';
require '../Home/Controller/ImagesController.class.php';
$originalConf = require  '../Common/Conf/uploadconfig.php';
$callback = isset($_GET['back']) ? $_GET['back']:(isset($_GET['callback']) ? $_GET['callback'] : '');

if (!preg_match("/^http:\/\/[A-Za-z0-9]+\.[A-Za-z0-9]+[\/=\?%\-&_~`@[\]\’:+!]*([^<>\”])*$/", $callback)) {
    $data = array('error' => 1, 'message' => "无效的回调");
    response($data);
}

$scope = isset($_GET['scope']) ? $_GET['scope'] : '';
if (!preg_match("/\w+/", $scope)) {
    $data = array('error' => 1, 'message' => "无效的scope");
    response($data);
}

$config = $originalConf[$scope];
if (!$config) {
    $data = array('error' => 1, 'message' => "没有在配置文件中找到对应的scope1");
    response($data);
}
$image = new ImagesController();
$stream = isset($_REQUEST['stream']) ? $_REQUEST['stream'] : '';
if(isset($_GET['isbase64']) && $_GET['isbase64'] == true && $stream){
    $fileInfo = $image->uploadBase64($config,$stream);
}else{
    $fileInfo = $image->upload($config);

}
if(false !== $fileInfo){
    if(is_array($fileInfo)){
        $data =array('error' => 0,'url'=> $fileInfo);
    }
}else{
    $data = array('error' => 1,'url'=> '上传失败');
}
if(isset($_REQUEST['isaj']) && $_REQUEST['isaj'] ==1){
    ajaxSuccess($data);
}else{
    response($data);
}
function response($data) {
    $json = new Services_JSON();
    $callback = isset($_GET['callback']) ? $_GET['callback'] : '';
    $url = $callback . "?s=" . $json->encode($data);
    header("Location: " . $url);
}

function ajaxSuccess($data){
    $result['code'] = 100;
    $result['message'] = 'success';
    $result['data'] = $data;
    header('Content-Type:application/json; charset=utf-8');
    if(preg_match('/^jQuery/',$_GET['callback'])){
        exit($_GET['callback'].'('.json_encode($result).')');
    }else {
        exit(json_encode($result));
    }
}

?>
