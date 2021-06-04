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

// 插入数据
$sql = "select * from t_course";
// 设置 PDO 错误模式为异常
$link->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$res=$link->query($sql);
$result =  $res->fetchAll();

// 插入数据
$sql2 = "select * from t_student";

$res2=$link->query($sql2);
$result2 =  $res2->fetchAll();


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1.0" />
<title>添加</title>

<link rel="stylesheet" type="text/css" href="bootstrap.min.css" />

<style type="text/css">
html,body {
	height: 100%;
}

.login-box {
	width: 100%;
	max-width:500px;
	height: 400px;
	position: absolute;
	top: 50%;

	margin-top: -200px;
	/*设置负值，为要定位子盒子的一半高度*/

}
@media screen and (min-width:500px){
	.login-box {
		left: 50%;
		/*设置负值，为要定位子盒子的一半宽度*/
		margin-left: -250px;
	}
}	

.form {
	width: 100%;
	max-width:500px;
	height: 275px;
	margin: 25px auto 0px auto;
	padding-top: 25px;
}	
.login-content {
	height: 300px;
	width: 100%;
	max-width:500px;
	background-color: rgba(255, 250, 2550, .6);
	float: left;
}		
	
	
.input-group {
	margin: 0px 0px 30px 0px !important;
}
.form-control,
.input-group {
	height: 40px;
}

.form-group {
	margin-bottom: 0px !important;
}
.login-title {
	padding: 20px 10px;
	background-color: rgba(0, 0, 0, .6);
}
.login-title h1 {
	margin-top: 10px !important;
}
.login-title small {
	color: #fff;
}

.link p {
	line-height: 20px;
	margin-top: 30px;
}
.btn-sm {
	padding: 8px 24px !important;
	font-size: 16px !important;
}
</style>

</head>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" integrity="sha384-HSMxcRTRxnN+Bdg0JdbxYKrThecOKuH5zCYotlSAcp1+c8xmyTe9GYg1l9a69psu" crossorigin="anonymous">
<!-- 最新的 Bootstrap 核心 JavaScript 文件 -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js" integrity="sha384-aJ21OjlMXNL5UyIl/XNwTMqvzeRMZH2w8c5cRVpzpU8Y5bApTppSuUkhZXN0VxHd" crossorigin="anonymous"></script>
<body>
<div class="container">
    <div class="row">
        <div class="span6">
            <ul class="nav nav-pills">
                <li><a href="index.php">课程管理</a></li>
                <li class="active"><a href="addnews.php">增加选课记录</a></li>
                <li><a href="student.php">增加学生</a></li>
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#"><?php echo $_SESSION['user_name']?><b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li><a href="logout.php">退出</a></li>
                        <!--                        <li><a href="#">Google Plus API</a></li>-->
                        <!--                        <li><a href="#">HTML5</a></li>-->
                        <!--                        <li class="divider"></li>-->
                        <!--                        <li><a href="#">Examples</a></li>-->
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</div>
<div class="box">
		<div class="login-box">

			<div class="login-content ">
			<div class="form">
			<form action="action-addnews.php" method="post">
				<div class="form-group">
					<div class="col-xs-12  ">
						<div class="input-group">
							<span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
                            <select  class="form-control" name="C#">
                                <?php
                                foreach ($result as $value)
                                    echo "<option value=\"{$value['C#']}\">{$value['Cname']}</option>";
                                ?>
                            </select>
						</div>
					</div>
				</div>
				<div class="form-group">
					<div class="col-xs-12  ">
						<div class="input-group">
							<span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
                            <select class="form-control" name="S#">
                                <?php
                                foreach ($result2 as $value)
                                    echo "<option value=\"{$value['S#']}\">{$value['Sname']}--{$value['S#']}</option>";
                                ?>
                            </select>
						</div>
					</div>
				</div>
				<div class="form-group form-actions">
					<div class="col-xs-4 col-xs-offset-4 ">
						<button type="submit" class="btn btn-sm btn-info">登录</button>
					</div>
				</div>
			</form>
			</div>
		</div>
	</div>
</div>

<div style="text-align:center;">

</div>

</body>

</html>