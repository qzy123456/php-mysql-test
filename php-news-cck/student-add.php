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
// echo "<td>{$row['S#']}</td>";
//                echo "<td>{$row['Sname']}</td>";
//                echo "<td>{$row['Sex']}</td>";
//                echo "<td>{$row['Age']}</td>";
//                echo "<td>{$row['Major']}</td>";
$xuehao = $_POST['S#'];
$name = $_POST['Sname'];
$sex = $_POST['Sex'];
$age = $_POST['Age'];
$major = $_POST['Major'];
//查询重复插入
$sql1 = "select * from t_student where `S#` = '$xuehao' ";
$result1=$link->prepare($sql1)->execute();
if($result1){
    header("Location:student.php");
}
// 插入数据
$sql = "INSERT INTO t_student(`S#`,`Sname`,`Sex`,`Age`,`Major`) VALUES ('$xuehao','$name','$sex','$age','$major')";

$result=$link->prepare($sql)->execute();
header("Location:student.php");

