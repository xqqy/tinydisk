<?php
if(!empty($_COOKIE['uid']) and !empty($_COOKIE['pswd'])){
    if($_COOKIE['uid']!="123" or $_COOKIE["pswd"]!="321"){
        header('HTTP/1.0 401 Unauthorized');
    }
}else{
header('HTTP/1.0 401 Unauthorized');
}
$con = new mysqli("localhost","doc","EmZnmEkIRKFStf91","DOC");
    if ($con->connect_error)
      {
      die('Could not connect:');
      }
    
    $con->query("use names utf8");

$sql="SELECT `NAME` FROM `DOC` WHERE `HASH`='".hash("sha256",$_POST['name'])."'";
$result= $con->query($sql);


if($row=$result->fetch_assoc() or file_exists("upload/".$_POST['name'])){echo "服务器端有重复文件";}else{echo "notboth";}
    ?>
