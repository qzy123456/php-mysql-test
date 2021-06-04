<?php
// 1.导入配置文件
require "dbconfig.php";
session_start();
if(!isset($_SESSION['user_id'])){
    header('Location:login.php');
}
// 2. 连接mysql
$link = new PDO('mysql:host='.HOST.';dbname='.DBNAME, USER, PASS);
$link -> exec("set character_set_client='utf8'");

$link -> exec("set character_set_results='utf8'");

$link -> exec("set collation_connection='utf8_general_ci'");


// 设置 PDO 错误模式为异常
$link->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$sid = $_GET['S'];
if(empty($sid)){
    header("Location:index.php");
}
//删除数据
$sql = "DELETE FROM t_student where  `S#` = '$sid' ";

$result=$link->prepare($sql)->execute();
header("Location:student.php");



