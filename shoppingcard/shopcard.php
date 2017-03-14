<?php 
include 'inc/config.inc.php';
include 'inc/mysql.inc.php';
$link = connect();
$charset = "SET NAMES 'utf8';";
execute($link, $charset);
 ?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>购物车</title>
<link type="text/css" rel="stylesheet" href="style/reset.css">
<link type="text/css" rel="stylesheet" href="style/main.css">
<script type="text/javascript" src="js/jquery-3.1.1.js"></script>
<!--[if IE 6]>
<script type="text/javascript" src="js/DD_belatedPNG_0.0.8a-min.js"></script>
<script type="text/javascript" src="js/ie6Fixpng.js"></script>
<![endif]-->
</head>

<body>
<div class="headerBar">
	<div class="topBar">
		<div class="comWidth">
			<div class="leftArea">
				<a href="#" class="collection">购物车</a>
			</div>
			<div class="rightArea">
				欢迎来到测试商城！<a href="#">[登录]</a><a href="#">[免费注册]</a>
			</div>
		</div>
	</div>
	<div class="logoBar">
		<div class="comWidth">
			<div class="logo fl">
			</div>
			<div class="stepBox fr">
				<div class="step"></div>
				<ul class="step_text">
					<li class="s01 active">我的购物车</li>
					<li class="s02 active">填写核对订单</li>
					<li class="s03">订单提交成功</li>
				</ul>
			</div>
		</div>
	</div>
</div>
<div class="shoppingCart comWidth">
	<div class="hr_25"></div>
	<div class="shopping_item">
		<h3 class="shopping_tit">支付方式</h3>
		<div class="shopping_cont padding_shop">
			<ul class="shopping_list">
				<li><input type="radio" class="radio" id="r1"><label for="r1">微信支付</label></li>
				<li><input type="radio" class="radio" id="r2"><label for="r2">支付宝</label></li>
				<li><input type="radio" class="radio" id="r2"><label for="r2">银联网上银行</label></li>
			</ul>
		</div>
	</div>
	<div class="hr_25"></div>
	<div class="shopping_item">
		<h3 class="shopping_tit">送货清单<input class="backCar" type="button" value="清空购物车" onclick="clearCart()">
		</h3>
		<script type="text/javascript">
			function clearCart() {
				var url = "clear.php";
				var success = function(response) {
					if(response.errno == 0) {
						$(".products").remove();
						$("#total").remove();
					}
				}
				$.get(url, success, "json");
			}
		</script>
		<div class="shopping_cont pb_10">
			<div class="cart_inner">
				<div class="cart_head clearfix">
					<div class="cart_item t_name">商品名称</div>
					<div class="cart_item t_price">单价</div>
					<div class="cart_item t_return">数量</div>
					<div class="cart_item t_subtotal">小计</div>
					<div class="cart_item t_subtotal">操作</div>
				</div>
				<?php
				$total = 0;
				$query = "SELECT p.id, p.title, p.price, c.num FROM `shop_product` p, `shop_cart` c WHERE p.id=c.productid AND c.userid=1";
				$result = execute($link, $query);
				while($data = mysqli_fetch_assoc($result)) {
				?>
				<div id="div-<?php echo $data['id']?>" class="products">
				<div class="cart_cont clearfix">
					<div class="cart_item t_name">
						<div class="cart_shopInfo clearfix">
							<img src="images/des_sm.jpg" alt="">
							<div class="cart_shopInfo_cont">
								<p class="cart_link"><a href="#"><?php echo $data['title'] ?></a></p>
								<p class="cart_info">已选择的支付方式：支付宝</p>
							</div>
						</div>
					</div>
					<div class="cart_item t_price">
						<span id="p-<?php echo $data['id']?>"><?php echo $data['price'] ?></span>元
					</div>
					<div class="cart_item t_num">
						<input type="text" name="goods_number" 
								value="<?php echo $data['num']?>" 
								style="border:1px solid #191970;width:60px;height:20px;text-align:center;" 
								onblur="changeNum(<?php echo $data['id']?>,this.value)" 
								id="product-<?php echo $data['id']?>">
						</input>
					</div>
					<div class="cart_item t_subtotal t_red"><span id="total-<?php echo $data['id']?>"><?php echo $data['price']*$data['num'] ?></span>元</div>
					<div class="cart_item t_subtotal t_red"><a href="javascript:delPro(<?php echo $data['id']?>);">删除</a></div>
				</div>	
				</div>
				<?php 
					$total += $data['price']*$data['num'];
				} 
				?>
			</div>
		</div>
	</div>
	<div class="hr_25"></div>
	<div class="shopping_item">
		<h3 class="shopping_tit">订单结算</h3>
		<div class="shopping_cont padding_shop clearfix">
			<div class="cart_count fr">
				<div class="cart_rmb">
					<i>总计：</i><span id="total">￥<?php echo $total?></span>
				</div>
				<div class="cart_btnBox">
					<input type="button" class="cart_btn" value="提交订单">
				</div>
			</div>
		</div>
	</div>
</div>
<div class="hr_25"></div>
<div class="footer">
	<p><a href="#">测试</a><i>|</i><a href="#">测试公告</a><i>|</i> <a href="#">线上招聘</a><i>|</i><a href="#">联系我们</a><i>|</i>客服热线：400-675-1234</p>
	<p>Copyright &copy; 2006 - 2014 版权所有&nbsp;&nbsp;&nbsp;京ICP备09037834号&nbsp;&nbsp;&nbsp;京ICP证B1034-8373号&nbsp;&nbsp;&nbsp;某市公安局XX分局备案编号：123456789123</p>
	<p class="web"><a href="#"><img src="images/webLogo.jpg" alt="logo"></a><a href="#"><img src="images/webLogo.jpg" alt="logo"></a><a href="#"><img src="images/webLogo.jpg" alt="logo"></a><a href="#"><img src="images/webLogo.jpg" alt="logo"></a></p>
</div>
</body>
<script type="text/javascript">
	function changeNum(productid,num){
		//alert(productid);
		//alert(num);
		//通过ajax将对应商品的数量进行修改操作
		var url = "changeNum.php";
		var data = {'productid':productid,'num':num};
		var success = function(response) {
			if(response.errno == 0){
				var price = ($("#product-"+productid).val()) * ($("#p-"+productid).html());
				$("#total-"+productid).html(price);
			}
		}
		$.post(url,data,success,"json");
	}
	function delPro(productid) {
		var url = "deleteProduct.php";
		var data = {'productid':productid};
		var success = function(response) {
			if(response.errno == 0){
				$("#div-"+productid).remove();
			}
		}
		$.post(url,data,success,"json");
	}
</script>
</html>
