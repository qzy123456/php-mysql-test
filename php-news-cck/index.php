<?php
session_start();
if(!isset($_SESSION['user_id'])){
    header('Location:login.php');
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>后台管理系统</title>
    <link href="index.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/css/bootstrap.min.css">
    <script type="text/javascript"src="index.js"></script>
</head>
<style type="text/css">
.wrapper {width: 1000px;margin: 20px auto;}
h2 {text-align: center;}
.add {margin-bottom: 20px;}
.add a {text-decoration: none;color: #fff;background-color: green;padding: 6px;border-radius: 5px;}
.adds {margin-bottom: 20px; float: right; margin-right: 100px}
.adds a {text-decoration: none;color: #fff;background-color: green;padding: 6px;border-radius: 5px;}
td {text-align: center;}
.show1{
    display: block;
}
    .hide1{
        display: none;
    }
</style>
<!-- 最新版本的 Bootstrap 核心 CSS 文件 -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" integrity="sha384-HSMxcRTRxnN+Bdg0JdbxYKrThecOKuH5zCYotlSAcp1+c8xmyTe9GYg1l9a69psu" crossorigin="anonymous">
<!-- 最新的 Bootstrap 核心 JavaScript 文件 -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js" integrity="sha384-aJ21OjlMXNL5UyIl/XNwTMqvzeRMZH2w8c5cRVpzpU8Y5bApTppSuUkhZXN0VxHd" crossorigin="anonymous"></script>
<body>
<div class="container">
    <div class="row">
        <div class="span6">
            <ul class="nav nav-pills">
                <li class="active"><a href="index.php">课程管理</a></li>
                <li><a href="addnews.php">增加选课记录</a></li>
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
	<div class="wrapper">
		<h2>后台管理系统</h2>
        <div class="main">
		<table width="960" border="1">
			<tr>
				<th>学号</th>
				<th>姓名</th>
				<th>分数</th>
				<th>课程</th>
				<th>性别</th>
				<th>年龄</th>
				<th>操作</th>
			</tr>

			<?php
				// 1.导入配置文件
				require "dbconfig.php";

				// 2. 连接mysql
				$link = new PDO('mysql:host='.HOST.';dbname='.DBNAME, USER, PASS);
            $link -> exec("set character_set_client='utf8'");

            $link -> exec("set character_set_results='utf8'");

            $link -> exec("set collation_connection='utf8_general_ci'");


				// 3. 从DBNAME中查询到news数据库，返回数据库结果集,并按照addtime降序排列  
				$sql = "SELECT * FROM t_student_course INNER JOIN t_student INNER JOIN t_course
WHERE t_student_course.`S#` = t_student.`S#`  
and  t_student_course.`C#` = t_course.`C#`  
and  t_student_course.`C#` in (SELECT t_course.`C#` FROM t_course WHERE t_course.`T#` = '{$_SESSION['user_id']}')";
            //array(20) { ["S#"]=> string(7) "2012001" [0]=> string(7) "2012001"
            // ["C#"]=> string(4) "c001" [1]=> string(4) "c001"
            // ["Score"]=> string(2) "87" [2]=> string(2) "87" [3]=> string(7) "2012001"
            // ["Sname"]=> string(2) "??" [4]=> string(2) "??" ["Sex"]=> string(1) "?" [5]=> string(1) "?" ["Age"]=> string(2) "25" [6]=> string(2) "25" ["Major"]=> string(4) "????" [7]=> string(4) "????" [8]=> string(4) "c001" ["Cname"]=> string(3) "???" [9]=> string(3) "???" ["T#"]=> string(4) "t001" [10]=> string(4) "t001" }
				foreach($link->query($sql) as $id =>$row) {

                echo "<tr>";
                echo "<td>{$row['S#']}</td>";
                echo "<td>{$row['Sname']}</td>";
                echo "<td>{$row['Score']}</td>";
                echo "<td>{$row['Cname']}</td>";
                echo "<td>{$row['Sex']}</td>";
                echo "<td>{$row['Age']}</td>";
                echo "<td xmlns=\"http://www.w3.org/1999/html\">
							<button onclick = dels(\"{$row['S#']}\",\"{$row['C#']}\") >删除</button>
							<button onclick = update({$id})  '>修改</button>
						  </td>";
                echo "</tr>";
                echo "        <div id=\"form_1_{$id}\" class=\"form_1 hide1\">
                <form action=\"action-editnews.php\" method=\"post\">
                    <div id='input_1_{$id}' class=\"input_1\"><div class=\"login_logo\">学生分数</div><div class=\"close\" onclick=hides({$id})>X</div></div>
                    <hr>
                    <div class=\"input_1\">
                        <input type=\"number\" name=\"Score\" placeholder=\"&nbsp;分数\">
                        <input type=\"hidden\" name=\"S#\" value='{$row['S#']}'>
                        <input type=\"hidden\" name=\"C#\" value='{$row['C#']}'>
                        
                    </div>
                    <div class=\"input_1\"><input class=\"submit_1\" type=\"submit\" value=\"提&nbsp;交\"></div>
                </form>
            </div>
        </div>";
            }
			?>

		</table>
	</div>




	<script type="text/javascript">

        function dels(sid,cid){
            if (confirm("确定删除这条记录吗？")){
                window.location = "action-del.php?S="+sid+"&C="+cid;
            }
        }
        function update(id){
            $('#form_1_'+id).removeClass('hide1');
            $('#form_1_'+id).addClass('show1');
        }


        function hides(id) {
            $('#form_1_'+id).addClass('hide1');
        }

	</script>
</body>
</html>
