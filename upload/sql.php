<?php
$con = new mysqli("localhost","doc","EmZnmEkIRKFStf91","DOC");
if ($con->connect_error)
  {
  die('Could not connect: ');
  }

  $size=$_POST['size']/1048576;
$con->query("set names utf8");
$result=$con->query("INSERT INTO DOC (`PATH`,`NAME`,`INFO`,`HASH`) VALUES ('upload/upload/".$_POST['name']."', '".$_POST['name']."', '".$size."M','".hash("sha256",$_POST['name'])."')");
if(!$result){echo "表更改失败";}else{echo "done";}
?>
