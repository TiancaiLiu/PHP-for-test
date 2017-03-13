<?php 
include 'inc/config.inc.php';
include 'inc/mysql.inc.php';
$link = connect();
$charset = "SET NAMES 'utf8';";
execute($link, $charset);
//完成对数据表的修改操作
$productid = intval($_POST['productid']);
$num = intval($_POST['num']);
$userid = 1;

$query = "UPDATE `shop_cart` SET num=$num where userid=$userid and productid=$productid";
execute($link, $query);
if(mysqli_affected_rows($link) == 1){
	$response = array(
			'errno'  =>  '0',
			'errmsg' =>  'success',
			'data'   =>  true,
		);
}else{
	$response = array(
			'errno'  =>  '-1',
			'errmsg' =>  'fail',
			'data'   =>  false,
		);
}	

 echo json_encode($response);
?>
