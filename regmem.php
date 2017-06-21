<?php
if(!isset($_POST['submit']))//检查变量是否存在
{
    exit('Illegal access!');
}

$username = $_POST['username'];
$password = ($_POST['password']);
$email = $_POST['email'];

//注册信息判断，正则表达式
if(!preg_match('/^[\w\x80-\xff]{3,15}$/', $username)){
    exit('Error：Username.<a href="javascript:history.back(-1);">return</a>');
}
if(strlen($password) < 6){
    exit('Error：Password.<a href="javascript:history.back(-1);">return</a>');
}

//if(!preg_match('\w+([-+.]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*/', $email)){
  // exit('Error：Email<a href="javascript:history.back(-1);">return</a>');
//}

//包含数据库连接文件
include('connmem.php');
//检测用户名是否已经存在

$var = $memcache->get($username);

if($var)//存在相同用户名
{
   echo 'Error: The username ',$username,' is existed <a href="javascript:history.back(-1);">return</a>';
    exit;
}

//写入数据


//用户信息

$userinfo=array($password,$email);

try
{
    $memcache->set($username,$userinfo);        //设置一个变量到内存中，名称是key 值是test

    echo "Success!<br />";
}
catch(Exception $e)
{
	echo 'Error!<br />';
    echo 'Click here<a href="javascript:history.back(-1);">return </a> retry ';
}

exit('Sign in successful!<a href="loginmem.html">Log in</a>');

   
?>