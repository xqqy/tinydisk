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
<head>
<meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1.0">
<link href="search.css" rel="stylesheet" />
<style>
body{width: 100%;   
        height: 100%;   
        font-family: 'Open Sans',sans-serif;   
        margin: 0;     
        background-color:#161719}
.small{
float:left;
margin: 5px;
padding: 10px;
text-align: center;
background-color: snow/*#a1e9dc  b4feff*/;
}
</style>
<title>文件系统</title>
</head>
<div style="height:10%;color:snow;">
<span style="font-size:50px">
个人云盘
</span>
<a href="./upload"><button>上传文件</button></a>
<a href="delete.php"><button>删除文件</button></a>
<a href="logout.html"><button>登出</button></a>
</div>

<div style="float:left;height:90%;color:snow">
        <?php 
        
        class METRO/*是时候面向对象了！*/{
                var $atid;
                var $name;
                var $info; /*设置每个磁铁的标题和信息*/

                function OUT(){
                        echo "<div class='small'>".'<a href='.$this->path .'>';/*设置为链接模式*/
                        echo "<p style='font-size:200%;'>".$this->name."</p>";/*输出title*/
                        echo "<p style='font-size:100%;'>".$this->info."</p>";/*输出帮助*/
                        echo"</a></div>";
                }

                function __construct($row){
                        $this->path=$row['PATH'];
                        $this->name=$row['NAME'];
                        $this->info=$row['INFO'];
                }
                
        }

        $con = new mysqli("localhost","doc","EmZnmEkIRKFStf91","DOC");/*connect mysql*/
        if (!$con){die("Could not connect!");}
	
	$result=$con->query('set names utf8');

        $sql="SELECT * FROM `DOC`";
        $result=$con->query($sql);

if($result){
    // 输出数据
    while($row =  $result->fetch_assoc()){
                $now= new METRO($row);
                $now->OUT();
    }
} else {echo "没有结果";} ?>
</div>
