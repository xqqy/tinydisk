<?php
$con = new mysqli("localhost","doc","EmZnmEkIRKFStf91","DOC");/*connect mysql*/
if ($con->connect_error){die("Could not connect!");}
$result=$con->query('set names utf8');

if(!unlink($_POST['PATH'])){die("文件删除失败");}
$sql="DELETE FROM `DOC` WHERE `PATH`='".$_POST['PATH']."'";
$result=$con->query($sql);
if($result){echo "done";}else{echo "数据库管理失败";}
?>