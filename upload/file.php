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

/****
    waited
****/
//print_r($_FILES);exit;

$file = $_FILES['mof'];

$type = trim(strrchr($_POST['rname'], '.'),'.');

// print_r($_POST['test']);exit;

if($file['error']==0){
        if(!file_exists('./upload/'.$_POST['rname'])){
            if(!move_uploaded_file($file['tmp_name'],'./upload/'.$_POST['rname'])){
                echo '移动文件失败';
            }
        }else{
            $content=file_get_contents($file['tmp_name']);
            if (!file_put_contents('./upload/'.$_POST['rname'], $content,FILE_APPEND)) {
                echo '合并文件失败';
            }
}
}else{
    echo '文件上传失败';
}

?>
