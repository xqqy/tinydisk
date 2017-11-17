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
                echo 'failed';
            }
        }else{
            $content=file_get_contents($file['tmp_name']);
            if (!file_put_contents('./upload/upload.'.$type, $content,FILE_APPEND)) {
                echo 'failed';
            }
}
}else{
    echo 'failed';
}

?>
