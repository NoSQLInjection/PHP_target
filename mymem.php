<?php

session_start();


if(!isset($_SESSION['username']))
{
    header("Location:login.html");
    exit();
}

//包含数据库连接文件
include('connmem.php');//连接数据库

$password = $_SESSION["password"];
$username = $_SESSION["username"];
$email= $_SESSION['email'] ;
//选择查询相应的username的用户
$get_value = $memcache->get($username);   //从内存中取出$username的value,此时value是一个数组

if(!$get_value)//不存在当前用户
{
   echo 'Error: The username ',$username,' is not existed <a href="regmem.html">return</a>';
    exit;
}

echo '用户信息：<br />';
echo '用户名：',$username,'<br />';
echo '邮箱：',$email,'<br />';
echo '<a href="loginmem.php?action=logout">注销</a> 登录<br />';
?>