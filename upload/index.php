<?php
if(!empty($_COOKIE['uid']) and !empty($_COOKIE['pswd'])){
        if($_COOKIE['uid']!="123" or $_COOKIE["pswd"]!="321"){
                die("<script>document.location='login.html'</script>");
        }
}else{
        die("<script>document.location='login.html'</script>");
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="zh-CN">
<head>
<title>分割大文件上传</title>
<meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1.0">
<style>
    #test{
        width: 200px;
        height: 100px;
        border: 1px solid green;
        display: none;
    }
    #img{
        width: 50px;
        height: 50px;
        display: none;
    }
    #upimg{
        text-align: center;
        font: 8px/10px '微软雅黑','黑体',sans-serif;
        width: 300px;
        height: 10px;
        border: 1px solid green;
    }
    #load{
        width: 0%;
        height: 100%;
        background: green;
        text-align: center;
    }
</style>
</head>
    <body>
        <form enctype="multipart/form-data" action="file.php" method="post">
            <!-- 
            <input type="file" name="pic" />
            <div id="img"></div>
            <input type="button" value="uploadimg" onclick="upimg();" /><br />
            -->
            <div id="upimg">
                <div id="load"></div>
            </div>
            <input type="file" name="mof" multiple="multiple"/>
            <input type="button" value="uploadfile" onclick="upfile();" />
        </form>
        <div id="test">
            进度条
        </div>
<a href="../"><button>返回</button></a>
<script type="text/javascript">
    var dom=document.getElementsByTagName('form')[0];
    var xhr=new XMLHttpRequest();
    var fd;
    var des=document.getElementById('load');
    var num=document.getElementById('upimg');
    var file;
    const LENGTH=1*1024*1024;
    var start;
    var end;
    var blob;
    var pecent;
    var random=Math.floor(Math.random()*10000);
    var name;

    function upfile(){
        start=0;
        end=LENGTH+start;

        file=document.getElementsByName('mof')[0].files[0];
        name=file.name.replace(/\s/g,"_")
        if(!file){
            alert('请选择文件');
            return;
        }
        
        var xhrboth=new XMLHttpRequest();
        xhrboth.open("POST","check.php",true);
        var dot=new FormData;
        dot.append("name",name)
        xhrboth.send(dot);
        xhrboth.onreadystatechange=function(){
            if(this.readyState==4){
                if(this.status==200 && this.responseText=="notboth"){
                    up();
                    return;
                }
                else{
                    alert(this.responseText)
                    return;
                }
            }
        }
    }

    function up(){
        if(start<file.size){
            xhr.open('POST','file.php',true);
            xhr.onreadystatechange=function(){
                if(this.readyState==4){
                    if(this.status>=200&&this.status<300){
                        if(this.responseText.indexOf('failed') >= 0){
                            alert(this.responseText);
                            des.style.width='0%';
                        }else{
                            start=end;
                            end=start+LENGTH;
                            //setTimeout('up()',1000);
                            up();
                        }

                    }
                }
            }
            xhr.upload.onprogress=function(ev){
                if(ev.lengthComputable){
                    pecent=100*(ev.loaded+start)/file.size;
                    if(pecent>100){
                        pecent=100;
                    }
                    //num.innerHTML=parseInt(pecent)+'%';
                    des.style.width=pecent+'%';
                    des.innerHTML = parseInt(pecent)+'%'
                }
            }
　　　　　　　
　　　　　　　//分割文件核心部分slice
            blob=file.slice(start,end);
            fd=new FormData();
            fd.append('mof',blob);
            fd.append('name',name);
            fd.append('rname',random+name);
            //console.log(fd);
            xhr.send(fd);
        }else{
            xhrend=new XMLHttpRequest();
            end=new FormData();
            xhrend.open("POST","sql.php",true);
            end.append("size",file.size);
            end.append("name",name);
            end.append("rname",random+name)
            xhrend.send(end);
            xhrend.onreadystatechange=function(){
                if(this.readyState==4){
                if(this.status==200 && this.responseText=="done"){
                    alert("上传成功")
		    document.location = '../'
                    return;
                }
                else{
                    alert(this.responseText)
                    return;
                }
            }
            }
            return;
        }
    }

    function change(){
        des.style.width='0%';
        return;
    }
    
</script>
    </body>
</html>
