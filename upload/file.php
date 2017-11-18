<?php 
/****
    waited
****/
//print_r($_FILES);exit;

$file = $_FILES['mof'];

$type = trim(strrchr($_POST['name'], '.'),'.');

// print_r($_POST['test']);exit;

if($file['error']==0){
        if(!file_exists('./upload/'.$_POST['name'])){
            if(!move_uploaded_file($file['tmp_name'],'./upload/'.$_POST['name'])){
                echo '移动文件失败';
            }
        }else{
            $content=file_get_contents($file['tmp_name']);
            if (!file_put_contents('./upload/'.$_POST['name'], $content,FILE_APPEND)) {
                echo '合并文件失败';
            }
}
}else{
    echo '文件上传失败';
}

?>
