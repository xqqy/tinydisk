<?php
//文件上传完成通知
require("auth.php");
auth();//授权验证
$con = new SQLite3("doc.db");
$rand=mt_rand(0,10000);
if (!$con)
  {
  die('Could not connect: ');
  }

  $type = trim(strrchr($_POST['filename'], '.'),'.');

if($type=="htaccess" or $type=="exe" or $type=="php" or $type=="html"){
	die("危险文件，禁止上传");
}
if(empty($_POST['filename']) or empty($_POST['hash'])){
  die("表单错误");
}
rename("upload/".SQLite3::escapeString($_POST['filename']),"upload/$rand".SQLite3::escapeString($_POST['filename']));
$size=$_POST['size']/1048576;
$result1=$con->query("INSERT INTO DOC (`PATH`,`FILENAME`,`INFO`,`HASH`) VALUES ('$rand".SQLite3::escapeString($_POST['filename'])."', '".SQLite3::escapeString($_POST['filename'])."', '".$size."M','".SQLite3::escapeString($_POST['hash'])."')");
$sql="DELETE FROM `UNDONE` WHERE `HASH`='".SQLite3::escapeString($_POST['hash'])."'";
$result2=$con->query($sql);
if(!($result1 and $result2)){echo "表更改失败";}else{echo "done";}
?>
