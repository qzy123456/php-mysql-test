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
// 获取修改的新闻
$xuehao = $_POST['S#'];
$kecheng = $_POST['C#'];
$score = $_POST['Score'];
if($score < 0){
    $score = 0;
}elseif ($score>100){
    $score = 100;
}
// 更新数据
// 插入数据
$sql = "UPDATE t_student_course set `Score` = $score where `S#` = '$xuehao' and `C#` = '$kecheng' ";

$result=$link->prepare($sql)->execute();
header("Location:index.php");

