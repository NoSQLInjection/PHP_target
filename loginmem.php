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
include('connmem.php');

//检测用户名及密码是否正确
//$cursor = $user->find(array("username" => $username,"password" => $password));

//foreach ($cursor as $document) {
//    echo $document["username"] . "\n";}
$get_value = $memcache->get($username);   //从内存中取出$username的value,此时value是一个数组

if(!$get_value)//不存在当前用户
{
   echo 'Error: The username ',$username,' is not existed <a href="regmem.html">return</a>';
    exit;
}

//$condit=array("username" => $username, "password" => $password);//选择条件

//$res=$user->find($condit)->count();//查询
//var_dump($res);


if($get_value[0]==$password)//密码匹配
{   
    $_SESSION['username'] = $username;

    $_SESSION['password'] = $password;
    echo $username,' Welcome ! <a href="mymem.php">The centre of users</a><br />';

    echo 'Click here<a href="login.php?action=logout">Log out</a> Log out!<br />';

    exit;
}

else 
{
    exit('Fail to log in!Please log in <a href="javascript:history.back(-1);">return </a> to retry');
}




?>

