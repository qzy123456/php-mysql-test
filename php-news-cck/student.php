<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>学生管理</title>
    <link href="index.css" rel="stylesheet" type="text/css">
    <script type="text/javascript"src="index.js"></script>
</head>
<style type="text/css">
.wrapper {width: 1000px;margin: 20px auto;}
h2 {text-align: center;}
.add {margin-bottom: 20px;}
.add a {text-decoration: none;color: #fff;background-color: green;padding: 6px;border-radius: 5px;}
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
                <li><a href="index.php">课程管理</a></li>
                <li><a href="addnews.php">增加选课记录</a></li>
                <li class="active"><a href="student.php">增加学生</a></li>
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
		<h2>学生管理</h2>
        <div class="main">
		<table width="960" border="1">
			<tr>
				<th style="text-align: center">学号</th>
				<th style="text-align: center">姓名</th>
                <th style="text-align: center">性别</th>
                <th style="text-align: center">年龄</th>
				<th style="text-align: center">专业</th>
				<th style="text-align: center">操作</th>
			</tr>

			<?php
				// 1.导入配置文件
				require "dbconfig.php";

            if(!isset($_SESSION['user_id'])){
                header('Location:login.php');
            }
				// 2. 连接mysql
				$link = new PDO('mysql:host='.HOST.';dbname='.DBNAME, USER, PASS);
            $link -> exec("set character_set_client='utf8'");
            $link -> exec("set character_set_results='utf8'");
            $link -> exec("set collation_connection='utf8_general_ci'");
				// 3. 从DBNAME中查询到news数据库，返回数据库结果集,并按照addtime降序排列  
				$sql = "SELECT * FROM t_student";
				foreach($link->query($sql) as $id =>$row) {

                echo "<tr>";
                echo "<td>{$row['S#']}</td>";
                echo "<td>{$row['Sname']}</td>";
                echo "<td>{$row['Sex']}</td>";
                echo "<td>{$row['Age']}</td>";
                echo "<td>{$row['Major']}</td>";
                echo "<td xmlns=\"http://www.w3.org/1999/html\">
							<button onclick = dels(\"{$row['S#']}\") >删除</button>
							<button onclick = update({$id})  '>添加</button>
						  </td>";
                echo "</tr>";
                echo "        <div id=\"form_1_{$id}\" class=\"form_2 hide1\">
                <form action=\"student-add.php\" method=\"post\">
                    <div id='input_1_{$id}' class=\"input_1\"><div class=\"login_logo\">学生分数</div><div class=\"close\" onclick=hides({$id})>X</div></div>
                    <hr>
                    <div class=\"input_1\">
                        <input type=\"number\" name=\"S#\" placeholder=\"&nbsp;学号\">
     
                    </div>
                    <div class=\"input_1\">
                     <input type=\"text\" name=\"Sname\" placeholder=\"&nbsp;名字\">
                       
</div>
                    <div class=\"input_1\">
                    
                        <input type=\"text\" name=\"Sex\" placeholder=\"&nbsp;性别\">
                       
</div>
                    <div class=\"input_1\">
                    
                        <input type=\"number\" name=\"Age\" placeholder=\"&nbsp;年龄\">
                       
</div>
                    <div class=\"input_1\">
                    
                        <input type=\"text\" name=\"Major\" placeholder=\"&nbsp;专业\">
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

        function dels(sid){
            if (confirm("确定删除这条记录吗？")){
                window.location = "student-del.php?S="+sid;
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
