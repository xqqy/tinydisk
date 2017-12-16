<?php
if(!empty($_COOKIE['uid']) and !empty($_COOKIE['pswd'])){
    if($_COOKIE['uid']!="123" or $_COOKIE["pswd"]!="321"){
        header('HTTP/1.0 401 Unauthorized');
        exit();
    }
}else{
header('HTTP/1.0 401 Unauthorized');
exit();
}
$con = new SQLite3("doc.db");/*connect mysql*/
if (!$con){die("Could not connect!");}

if(!unlink($_POST['PATH'])){die("文件删除失败");}
$sql="DELETE FROM `DOC` WHERE `PATH`='".$_POST['PATH']."'";
$result=$con->query($sql);
if($result){echo "done";}else{echo "数据库管理失败";}
?>