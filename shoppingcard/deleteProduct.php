<?php  
include 'inc/config.inc.php';
include 'inc/mysql.inc.php';
$link = connect();
$charset = "SET NAMES 'utf8';";
execute($link, $charset);
//完成对数据表的删除操作
$productid = intval($_POST['productid']);

$query = "DELETE FROM `shop_cart` WHERE productid=$productid";
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
