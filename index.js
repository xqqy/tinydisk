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
    document.getElementById("upimg").style.display="block";
    document.getElementById("load").style.display="block";
    start=0;
    end=LENGTH+start;

    file=document.getElementById('filei').files[0];
    name=file.name.replace(/\s/g,"_")
    if(!file){
        alert('请选择文件');
        return;
    }
    
    var xhrboth=new XMLHttpRequest();
    xhrboth.open("POST","upload/check.php",true);
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
                document.location="/index.php?error="+xhrboth.responseText;
                document.getElementById("upimg").style.display="none";
                document.getElementById("load").style.display="none";
                return;
            }
        }
    }
}

function up(){
    if(start<file.size){
        xhr.open('POST','upload/file.php',true);
        xhr.onreadystatechange=function(){
            if(this.readyState==4){
                if(this.status>=200&&this.status<300){
                    if(this.responseText.indexOf('failed') >= 0){
                        alert(this.responseText);
                        des.style.width='0%';
                        document.getElementById("upimg").style.display="none";
                        document.getElementById("load").style.display="none";
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
        xhrend.open("POST","upload/sql.php",true);
        end.append("size",file.size);
        end.append("name",name);
        end.append("rname",random+name)
        xhrend.send(end);
        xhrend.onreadystatechange=function(){
            if(this.readyState==4){
            if(this.status==200 && this.responseText=="done"){
                document.getElementById("upimg").style.display="none";
                document.getElementById("load").style.display="none";
                document.location = '/index.php?success=上传成功'
                return;
            }
            else{
                alert(this.responseText)
                document.getElementById("upimg").style.display="none";
                document.getElementById("load").style.display="none";
                return;
            }
        }
        }
        return;
    }
}