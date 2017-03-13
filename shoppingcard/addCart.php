<?php 
//加入购物车操作
include 'inc/config.inc.php';
include 'inc/mysql.inc.php';
$link = connect();
$charset = "SET NAMES 'utf8';";
execute($link, $charset);

$productid = intval($_POST['productid']);
$num = intval($_POST['num']);
$query = "SELECT price FROM `shop_product` where id=$productid";
execute($link, $query);
$result = execute($link, $query);
$data = mysqli_fetch_assoc($result);
$price = $data['price'];
//购物车数据添加操作（还需判断当前用户购物车上已经加入该商品）
$query = "SELECT * FROM `shop_cart` WHERE productid=$productid AND userid=1";
$result_data = execute($link, $query);
if(mysqli_num_rows($result_data) == 1){
	$sql = "UPDATE `shop_cart` SET num=num+$num WHERE userid=1 AND productid=$productid";
}else{
	$sql = "INSERT INTO `shop_cart`(productid, num, price, createtime) VALUES ($productid, $num, $price, now())";
}
execute($link, $sql);
if(mysqli_affected_rows($link)==1){
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
//返回一个json格式的数据
 echo json_encode($response);

 ?>