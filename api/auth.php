<?php
function auth(){
    if(!empty($_COOKIE['uid']) and !empty($_COOKIE['pswd'])){
        if($_COOKIE['uid']!="123" or $_COOKIE["pswd"]!="321"){
            header('HTTP/2.0 401 Unauthorized');
            echo "<html><body><h1>401 Unauthorized!</h1><br/><p>喵网络服务</p></body></html>";
            exit();
        }
    }else{
    header('HTTP/2.0 401 Unauthorized');
    echo "<html><body><h1>401 Unauthorized!</h1><br/><p>喵网络服务</p></body></html>";
    exit();
    }
}
?>