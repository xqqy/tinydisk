<?php
//文件下载核心
require("auth.php");
auth();//授权验证

if(empty($_GET['filename'])){//检查输入是否为空
    header('HTTP/2.0 404 File Not Found'); 
	echo '<html><body><h1>404 File Not Found!</h1><br/><p>喵网络服务</p></body></html>';
	exit;
}
download("upload/".$_GET['filename'],$_GET['filename']);

function download($filepath,$filename){//下载进程
	if(!$filepath||!is_file($filepath) || !file_exists($filepath)){//检查文件是否存在
        header('HTTP/2.0 404 File Not Found'); 
		echo '<html><body><h1>404 File Not Found!</h1><br/><p>喵网络服务</p></body></html>';
		exit;
	}
	$handle=fopen($filepath,'rb');//打开文件
    Header ( "Content-type: application/octet-stream" ); //设置头
    Header ( "Accept-Ranges: bytes" );  
    Header ( "Accept-Length: " . filesize ( $filepath ) );  
	header('Content-Disposition:attachment;filename="'.$filename.'"');
    echo fread ($handle,filesize($filepath));    
    fclose ($handle);    
    exit ();  
}
?>