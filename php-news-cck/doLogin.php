<?php
// 1.导入配置文件
require "dbconfig.php";
session_start();
// 2. 连接mysql
$link = new PDO('mysql:host='.HOST.';dbname='.DBNAME, USER, PASS);
$link -> exec("set character_set_client='utf8'");

$link -> exec("set character_set_results='utf8'");

$link -> exec("set collation_connection='utf8_general_ci'");


// 设置 PDO 错误模式为异常
$link->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$username = $_POST['username'];
//$pass = $_POST['Sname'];
//查询重复插入
$sql1 = "select * from t_teacher where `T#` = '$username' ";
$result=$link->query($sql1);
if($result && $result->rowCount()){ //判断结果集对象是否存在,并且结果集数量是否大于0,也就是说是否存在数据
    //rowCount()是结果集中的一个方法，可以返回当前结果集中的记录条数
    $result->setFetchMode(PDO::FETCH_ASSOC);//设置结果集的读取方式，这里用的是关联的方式进行读取
    $row = $result->fetch();//获取记录
    $_SESSION['user_id']=$row['T#'];
    $_SESSION['user_name']=$row['Tname'];
    header("Location:index.php");
}else{
    header("Location:login.php");
}

