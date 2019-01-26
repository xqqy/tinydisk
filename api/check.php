<?php
//文件上传前，通过检查文件sha256来判定是否存在重复文件，同时检查是否为危险文件并设置分片
require("auth.php");
auth();//授权验证

$con = new SQLite3("doc.db");
if (!$con){die("Could not connect!");}

$sql="SELECT `PATH` FROM `DOC` WHERE `HASH`='".$_POST["hash"]."' OR `FILENAME`='".$_POST['filename']."';";
$result= $con->query($sql);


if($row=$result->fetchArray(SQLITE3_ASSOC)){
    die("服务器端有重复文件或重名文件:".$row['FILENAME']);
}else{
    $sql="SELECT `PKGNUM` FROM `UNDONE` WHERE `HASH`='".$_POST["hash"]."';";
    $result= $con->query($sql);
    if($row=$result->fetchArray(SQLITE3_ASSOC)){//断点续传
        if(!empty($row['PKGNUM'])){
            die("haveundone!".$row['PKGNUM']);
        }else{
            die("error");
        }
    }else{
        die("notboth");
    }
}
echo "error";

?>
