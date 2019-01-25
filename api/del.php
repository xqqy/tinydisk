<?php
//文件删除请求
require("auth.php");
auth();//授权验证

$con = new SQLite3("doc.db");/*connect mysql*/
if (!$con){die("Could not connect!");}

if(!unlink("upload/".$_POST['PATH'])){die("文件删除失败");}
$sql="DELETE FROM `DOC` WHERE `PATH`='".$_POST['PATH']."'";
$result=$con->query($sql);
if($result){echo "done";}else{echo "数据库管理失败";}
?>