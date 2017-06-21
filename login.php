<?php
session_start();

//登录
if(!isset($_POST['submit']))//submit 不存在
{
    exit('Illegal access!!');
}
$username = $_POST['username'];//用户名接收明文

$password = $_POST['password'];
//echo $password;

//包含数据库连接文件
include('conn.php');

//检测用户名及密码是否正确
//$cursor = $user->find(array("username" => $username,"password" => $password));

//foreach ($cursor as $document) {
//    echo $document["username"] . "\n";}
$condit=array("username" => $username, "password" => $password);//选择条件

//var_dump($condit);
$res=$user->find($condit)->count();//查询
var_dump($res);


if($res>0)//存在
{   
    $_SESSION['username'] = $username;

    $_SESSION['password'] = $password;
    echo $username,' Welcome ! <a href="my.php">The centre of users</a><br />';

    echo 'Click here<a href="login.php?action=logout">Log out</a> Log out!<br />';

    exit;
}

else 
{
    exit('Fail to log in!Please log in <a href="javascript:history.back(-1);">return </a> to retry');
}




?>

