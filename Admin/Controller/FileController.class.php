<?php

namespace Admin\Controller;

use Think\Controller;

/**
 * 文件控制器
 * 主要用于下载模型的文件上传和下载
 */
class FileController extends Controller {
	public function index() {
		echo('');
	}
	/* 编辑器文件上传 */
	public function upload_editor($immediate = '', $saveremoteimage = '') {
		// TODO: 用户登录检测
		if ($saveremoteimage == '1') {
			// 远程抓图，下载
			
			$arrUrls = explode ( '|', $_POST ['urls'] );
			$urlCount = count ( $arrUrls );
			for($i = 0; $i < $urlCount; $i ++) {
				$localUrl = saveRemoteImg ( $arrUrls [$i] );
				if ($localUrl) {
					$arrUrls [$i] = $localUrl;
				}
			}
			echo implode ( '|', $arrUrls );
		} else {
			// 本地上传
			$fdata = 'filedata';
			create_file ( C ( 'DOWNLOAD_UPLOAD.rootPath' ) . 'index.html' );
			
			/* 返回标准数据 */
			$return = array (
					'status' => 1,
					'info' => '上传成功',
					'data' => '' 
			);
			
			/* 调用文件上传组件上传文件 */
			$File = D ( 'File' );
			$info = $File->upload ( $_FILES, C ( 'DOWNLOAD_UPLOAD' ) ); // TODO:上传到远程服务器
			
			/* 记录附件信息 */
			if ($info) {
				$targetPath = C ( 'DOWNLOAD_UPLOAD.rootPath' ) . $info [$fdata] ['savepath'] . $info [$fdata] ['savename'];
				$targetPath = str_replace ( './', __ROOT__ . '/', $targetPath );
				if ($immediate == '1') {
					$targetPath = '!' . $targetPath;
				}
				
				$return ['err'] = '';
				$return ['msg'] = "{'url':'" . $targetPath . "','localname':'" . $info [$fdata] ['name'] . "','id':1}";
			} else {
				$return ['err'] = $File->getError ();
				$return ['msg'] = '';
			}
			
			$echo = "{'err':'" . $return ['err'] . "','msg':" . $return ['msg'] . "}";
			/* 返回JSON数据 */
			echo ($echo);
			die ();
		}
	}
	
	/* 文件上传 */
	public function upload() {
		// TODO: 用户登录检测
		$fdata = 'download';
		
		create_file ( C ( 'DOWNLOAD_UPLOAD.rootPath' ) . 'index.html' );
		
		/* 返回标准数据 */
		$return = array (
				'status' => 1,
				'info' => '上传成功',
				'data' => '' 
		);
		
		/* 调用文件上传组件上传文件 */
		$File = D ( 'File' );
		$info = $File->upload ( $_FILES, C ( 'DOWNLOAD_UPLOAD' ) ); // TODO:上传到远程服务器
		
		/* 记录附件信息 */
		if ($info) {
			$targetPath = C ( 'DOWNLOAD_UPLOAD.rootPath' ) . $info [$fdata] ['savepath'] . $info [$fdata] ['savename'];
			$targetPath = str_replace ( './', __ROOT__ . '/', $targetPath );
			$return ['data'] = think_encrypt ( json_encode ( $info [$fdata] ) );
			$return ['info'] = $targetPath;
		} else {
			$return ['status'] = 0;
			$return ['info'] = $File->getError ();
		}
		
		/* 返回JSON数据 */
		$this->ajaxReturn ( $return );
	}
	/* 下载文件 */
	public function download($id = null) {
		if (empty ( $id ) || ! is_numeric ( $id )) {
			$this->error ( '参数错误！' );
		}
		
		$logic = D ( 'Download', 'Logic' );
		if (! $logic->download ( $id )) {
			$this->error ( $logic->getError () );
		}
	}
}
function saveRemoteImg($sUrl) {
	$maxAttachSize = C ( 'DOWNLOAD_UPLOAD.maxSize' );
	$upExt = "jpg,jpeg,gif,png,bmp";
	
	$reExt = '(' . str_replace ( ',', '|', $upExt ) . ')';
	if (substr ( $sUrl, 0, 10 ) == 'data:image') {
		if (! preg_match ( '/^data:image\/' . $reExt . '/i', $sUrl, $sExt ))
			return false;
		$sExt = $sExt [1];
		$imgContent = base64_decode ( substr ( $sUrl, strpos ( $sUrl, 'base64,' ) + 7 ) );
	} else { // url图片
		if (! preg_match ( '/\.' . $reExt . '$/i', $sUrl, $sExt ))
			return false;
		$sExt = $sExt [1];
		$imgContent = getUrl ( $sUrl );
	}
	if (strlen ( $imgContent ) > $maxAttachSize)
		return false;
	$sLocalFile = getLocalPath ( $sExt );
	file_put_contents ( $sLocalFile, $imgContent );
	
	$fileinfo = @getimagesize ( $sLocalFile );
	if (! $fileinfo || ! preg_match ( "/image\/" . $reExt . "/i", $fileinfo ['mime'] )) {
		@unlink ( $sLocalFile );
		return false;
	}
	$sLocalFile = str_replace ( '//', '/', $sLocalFile );
	$sLocalFile = str_replace ( './', __ROOT__ . '/', $sLocalFile );
	return $sLocalFile;
}
function getUrl($sUrl, $jumpNums = 0) {
	$arrUrl = parse_url ( trim ( $sUrl ) );
	if (! $arrUrl)
		return false;
	$host = $arrUrl ['host'];
	$port = isset ( $arrUrl ['port'] ) ? $arrUrl ['port'] : 80;
	$path = $arrUrl ['path'] . (isset ( $arrUrl ['query'] ) ? "?" . $arrUrl ['query'] : "");
	$fp = @fsockopen ( $host, $port, $errno, $errstr, 30 );
	if (! $fp)
		return false;
	$output = "GET $path HTTP/1.0\r\nHost: $host\r\nReferer: $sUrl\r\nConnection: close\r\n\r\n";
	stream_set_timeout ( $fp, 60 );
	@fputs ( $fp, $output );
	$Content = '';
	while ( ! feof ( $fp ) ) {
		$buffer = fgets ( $fp, 4096 );
		$info = stream_get_meta_data ( $fp );
		if ($info ['timed_out'])
			return false;
		$Content .= $buffer;
	}
	@fclose ( $fp );
	global $jumpCount;
	if (preg_match ( '/^HTTP\/\d.\d (301|302)/is', $Content ) && $jumpNums < 5) {
		if (preg_match ( '/Location:(.*?)\r\n/is', $Content, $murl ))
			return getUrl ( $murl [1], $jumpNums + 1 );
	}
	if (! preg_match ( '/^HTTP\/\d.\d 200/is', $Content ))
		return false;
	$Content = explode ( "\r\n\r\n", $Content, 2 );
	$Content = $Content [1];
	if ($Content)
		return $Content;
	else
		return false;
}
function getLocalPath($sExt) {
	$attachDir = str_replace ( '/file/', '/remote/', C ( 'DOWNLOAD_UPLOAD.rootPath' ) );
	$attachSubDir = date ( 'Y-m-d' );
	$newAttachDir = $attachDir . '/' . $attachSubDir . '/';
	
	create_file ( $newAttachDir . '/index.html' );
	
	PHP_VERSION < '4.2.0' && mt_srand ( ( double ) microtime () * 1000000 );
	$newFilename = date ( "YmdHis" ) . mt_rand ( 1000, 9999 ) . '.' . $sExt;
	$targetPath = $newAttachDir . '/' . $newFilename;
	return $targetPath;
}
