<?php
session_start();
//使用一个会话变量检查登录状态
if(isset($_SESSION['user_id'])){
    //使用内置session_destroy()函数调用撤销会话
    session_destroy();
}
//location首部使浏览器重定向到另一个页面
header('Location:login.php');
