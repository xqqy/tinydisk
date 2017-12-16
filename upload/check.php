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
$con = new SQLite3("../doc.db");
if (!$con){die("Could not connect!");}

$sql="SELECT `NAME` FROM `DOC` WHERE `HASH`='".hash("sha256",$_POST['name'])."'";
$result= $con->query($sql);


if($row=$result->fetchArray(SQLITE3_ASSOC) or file_exists("upload/".$_POST['name'])){echo "服务器端有重复文件";}else{echo "notboth";}
    ?>
