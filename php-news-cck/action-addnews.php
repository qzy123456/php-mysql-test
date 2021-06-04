<?php
session_start();
if(!isset($_SESSION['user_id'])){
    header('Location:login.php');
}
// 1.导入配置文件
require "dbconfig.php";

// 2. 连接mysql
$link = new PDO('mysql:host='.HOST.';dbname='.DBNAME, USER, PASS);
$link -> exec("set character_set_client='utf8'");

$link -> exec("set character_set_results='utf8'");

$link -> exec("set collation_connection='utf8_general_ci'");


// 设置 PDO 错误模式为异常
$link->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$xuehao = $_POST['S#'];
$kecheng = $_POST['C#'];
//查询重复插入
$sql1 = "select * from t_student_course where `S#` = '$xuehao' and  `C#` = '$kecheng' ";
$result1=$link->prepare($sql1)->execute();
if($result1){
    header("Location:index.php");
}
// 插入数据
$sql = "INSERT INTO t_student_course(`S#`,`C#`,`Score`) VALUES ('$xuehao','$kecheng',0)";

$result=$link->prepare($sql)->execute();
header("Location:index.php");

