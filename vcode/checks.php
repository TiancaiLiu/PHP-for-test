<?php
session_start();
$img_w=100;
$img_h=30;
srand(microtime()*100000);
for($i=0;$i<4;$i++){
	$new_num.=dechex(rand(0,15));
}
$_SESSION[check_pic]=$new_num;
$num_img=imagecreate($img_w, $img_h);
imagecolorallocate($num_img, 225, 225, 225);
for($i=0;$i<strlen($_SESSION[check_pic]);$i++){
	$font=mt_rand(3, 5);//设置随机字体
	$x=mt_rand(1, 8)+$img_w*$i/4;//设置随机字符所在位置的x坐标
	$y=mt_rand(1, $img_h/4);
	$color=imagecolorallocate($num_img, mt_rand(0, 100), mt_rand(0, 150), mt_rand(0, 200));
	imagestring($num_img, $font, $x, $y, $_SESSION[check_pic][$i], $color);
}
ob_clean();
header("content-type:image/png");
imagepng($num_img);
//imagedestroy($num_image);这个函数不好使



	
	
	
	
?>