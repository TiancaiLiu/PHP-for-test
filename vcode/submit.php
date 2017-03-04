<?php
session_start();
header("Content-Type:text/html;charset=utf-8");
if(@$_POST[check]){
	if(@$_POST[check]==""){
		echo "<script>alert('验证码不能为空');location.href='submit.php';</script>";
	}
	if(@$_POST[check]==@$_SESSION[check_pic]){
		echo "<script>alert('用户登录成功');location.href='submit.php';</script>";
	}else{
		echo "<script>alert('您输入的验证码不正确！请重新输入！');location.href='submit.php';</script>";
	}
}


	?>
	
<form action="" method="post">
	
	<img src='checks.php' /><br />
	
	<input type="text" name="check" />
	
	<input type="submit" value="提交" />
</form>