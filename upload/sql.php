<?php
if(!empty($_COOKIE['uid']) and !empty($_COOKIE['pswd'])){
  if($_COOKIE['uid']!="123" or $_COOKIE["pswd"]!="321"){
      header('HTTP/1.0 401 Unauthorized');
  }
}else{
header('HTTP/1.0 401 Unauthorized');
}
$con = new SQLite3("../doc.db");
if ($con->connect_error)
  {
  die('Could not connect: ');
  }

$size=$_POST['size']/1048576;
$result=$con->query("INSERT INTO DOC (`PATH`,`NAME`,`INFO`,`HASH`) VALUES ('upload/upload/".$_POST['rname']."', '".$_POST['name']."', '".$size."M','".hash("sha256",$_POST['name'])."')");
if(!$result){echo "表更改失败";}else{echo "done";}
?>
