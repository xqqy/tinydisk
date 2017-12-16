<?php
if(!empty($_COOKIE['uid']) and !empty($_COOKIE['pswd'])){
        if($_COOKIE['uid']!="123" or $_COOKIE["pswd"]!="321"){
                die("<script>document.location='login.html'</script>");
        }
}else{
        die("<script>document.location='login.html'</script>");
}

?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>文件中心</title>
    <link rel="stylesheet" href="http://cdn.static.runoob.com/libs/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="http://cdn.static.runoob.com/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="http://cdn.static.runoob.com/libs/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="index.css"></link>
</head>

<body>
    <nav class="navbar navbar-top navbar-inverse" role="navigation">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">切换导航</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#">个人云盘</a>
            </div>
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li class="active">
                    <a href="#">我的文件</a>
                </li>
                <li>
                    <a href="#" onclick="upload()">上传文件</a>
                    <div id="formd"></div>
                </li>
                <li>
                    <div id="upimg">
                        <div id="load"></div>
                    </div>
                </li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li>
                    <a href="logout.html">
                        <span class="glyphicon glyphicon-log-out"></span>登出
                    </a>
                </li>
            </ul>
    </div>
        </div>
    </nav>

    <div id="warn" class="container">
    <?php if(!empty($_GET['success'])){
            echo '<div class="alert alert-success alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                        &times;
                    </button>
                '.$_GET['success'].'
                    </div>';
    }
        if(!empty($_GET['error'])){
            echo '<div class="alert alert-danger alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert"aria-hidden="true">
                    &times;
                    </button>
                '.$_GET['error'].'
                </div>';
        }
?>
</div>
    <div class="container">
        <?php 
            
            class METRO{
                    var $atid;
                    var $name;
                    var $info; //设置每个磁铁的标题和信息

                    function OUT(){
                        echo '<div class="col-md-4 column">
                                    <h2>'.$this->name.'</h2>
                                    <p>文件大小：'.$this->info.'</p>
                                    <p>
                                        <a class="btn" href="'.$this->path.'">下载 >></a>
                                        <a class="btn" onclick=javascript:del("'.$this->path.'")>删除 >></a>
                                    </p>
                             </div>';
                    }
    
                    function __construct($row){
                            $this->path=$row['PATH'];
                            $this->name=$row['NAME'];
                            $this->info=$row['INFO'];
                    }
                    
            }
    
            $con = new mysqli("localhost","doc","EmZnmEkIRKFStf91","DOC");//connect mysql
            if (!$con){die("Could not connect!");}
        
        $result=$con->query('set names utf8');
    
            $sql="SELECT * FROM `DOC`";
            $result=$con->query($sql);
    
    if($result){
        // 输出数据
        echo '<div class="row clearfix">';
        $t=0;
        while($row =  $result->fetch_assoc()){
            if(t<3){
                    $now= new METRO($row);
                    $now->OUT();
            }else{
                echo '</div><div class="row clearfix">';
                $now= new METRO($row);
                $now->OUT();
            }
        }
        echo'</div>';
    } else {echo "没有结果";} 
   ?>
    </div>

</body>
<script>
    document.getElementById("formd").innerHTML = '<form enctype="multipart/form-data" action="file.php" method="post">' +
        '<input type="file" id="filei" onchange="upfile()" style="display:none;width:1px;height:1px"/></form>';
    setTimeout(() => {
        document.getElementById("warn").innerHTML="";
    }, 4001);
    function upload() {
        document.getElementById("filei").click();
    }
    function del(path){
        var xhr=new XMLHttpRequest();
        var data=new FormData();
        data.append("PATH",path);
        xhr.open("POST","del.php",true);
        xhr.send(data);
        xhr.onreadystatechange=function(){
            if(xhr.readyState==4 ){
                if(xhr.status==200){
                    if(xhr.responseText=='done'){
                        document.location="index.php?success=删除成功"
                    } else{
                        document.location="index.php?error="+xhr.responseText;
                    }
                } else{
                    document.location="index.php"+"网络错误"+xhr.status
                }
            }
        }
    }
</script>
<script type="text/javascript" src="index.js">
</script>

</html>