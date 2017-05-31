<?php
/**
 * KindEditor PHP
 *
 * 本PHP程序是演示程序，建议不要直接在实际项目中使用。
 * 如果您确定直接使用本程序，使用之前请仔细确认相关安全设置。
 *
 */

require_once 'JSON.php';
$originalConf = require  '../../../Common/Conf/uploadconfig.php';
require '../../../Home/Controller/ImagesController.class.php';

$scope = isset($_GET['scope']) ? $_GET['scope'] : '';
if (!preg_match("/\w+/", $scope)) {
    alert('invalid scope');
}
$config = $originalConf[$scope];
if (!$config) {
    alert('没有在配置文件中找到对应的scope');
}

$image = new ImagesController();
$fileInfo = $image->upload($config);
if(false !== $fileInfo){
    if(is_array($fileInfo)){
        if(count($fileInfo)==1){
            $file_url = '/Public/'.$fileInfo[0];
        }else{
            $arr=array();
            foreach($fileInfo as $k=>$file){
                array_push($arr,$file);
            }
            $file_url = $arr;
        }
    }
}
header('Content-type: text/html; charset=UTF-8');
$json = new Services_JSON();
echo $json->encode(array('error' => 0, 'url' => $file_url));
exit;

function alert($msg) {
	header('Content-type: text/html; charset=UTF-8');
	$json = new Services_JSON();
	echo $json->encode(array('error' => 1, 'message' => $msg));
	exit;
}
