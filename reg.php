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
include('conn.php');
//检测用户名是否已经存在

$check_query=$user->find(array("username" => $username))->count();
//如果不存在相同的
//var_dump($check_query);

if($check_query!=0){
    echo 'Error: The username ',$username,' is existed <a href="javascript:history.back(-1);">return</a>';
    exit;
}

//写入数据
$password = $password;//对密码进行MD5变换
//var_dump($password);

//用户信息
$userinfo=array("username" => $username, "password" =>$password,"email"=>$email);

try
{

	$INSERT =$user->insert($userinfo);
	//插入信息
    echo "Success!<br />";
}
catch(Exception $e)
{
	echo 'Error!<br />';
    echo 'Click here<a href="javascript:history.back(-1);">return </a> retry ';
}

exit('Sign in successful!<a href="login.html">Log in</a>');

   
?>