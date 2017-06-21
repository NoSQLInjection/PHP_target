<?php

session_start();


if(!isset($_SESSION['username']))
{
    header("Location:login.html");
    exit();
}

//包含数据库连接文件
include('conn.php');//连接数据库

$password = $_SESSION["password"];
$username = $_SESSION["username"];
$email= $_SESSION['email'] ;
//选择查询相应的username的用户
$cursor = $user->find(array("username" => $username))->limit(1);
$cursor->getNext();

echo '用户信息：<br />';
echo '用户名：',$username,'<br />';
echo '邮箱：',$email,'<br />';
echo '<a href="login.php?action=logout">注销</a> 登录<br />';
?>