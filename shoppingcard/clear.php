<?php 
include 'inc/config.inc.php';
include 'inc/mysql.inc.php';
$link = connect();
$charset = "SET NAMES 'utf8';";
execute($link, $charset);

$userid = 1;
$query = "DELETE FROM `shop_cart` WHERE userid=$userid";
execute($link, $query);
if(mysqli_affected_rows($link)) {
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