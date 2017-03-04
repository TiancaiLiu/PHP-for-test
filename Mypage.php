<html>
	<head>
		<meta http-equiv="content-type" content="text/html" charset="utf-8" />
	</head>
<style type="text/css">
   body{font-size: 12px;font-family: verdana;width: 100%;}
	.page a{border:1px solid #aaaadd;text-decoration: none;padding: 2px 5px 2px 5px;/*上右下左*/margin: 2px;}
	.current{border: 1px solid #000099;background-color: #000099;padding: 4px 6px 4px 6px;margin: 2px;color: #fff;font-weight: bold;}
	.disable a{border: 1px #eee solid;padding: 2px 5px 2px 5px;margin: 2px;color: #ddd;}
	.page{text-align: center;}
	.page form{display: inline;}
	.content{height: 300px;}
</style>
<body>
<?php  
$page=@$_GET['page'];  //获取当前页码值      
$num=10;                                      //每页显示10条数据  
$db=mysql_connect("localhost","root","");          
$select=mysql_select_db("test",$db);                 
$total=mysql_num_rows(mysql_query("select * from message")); //查询数据的总数  
$pagenum=ceil($total/$num);                                    //获得总页数  
$offset=($page-1)*$num;               //当前页码的起始值和末尾值
$showPage=5;                                         
$info=mysql_query("select * from message limit $offset,$num");   //获取相应页数所需要显示的数据  
echo "<div class='content'>";
echo "<table border=1 cellspacing=0 width=40% align=center>";
echo"<tr><td>id</td><td>name</td></tr>";
While($it=mysql_fetch_array($info)){  
    echo "<tr>";
	echo "<td>{$it['id']}</td>";
	echo "<td>{$it['name']}</td>";
	echo "</tr>";  
}                                                              //显示数据  
echo "</table>";
echo "</div>";
/*分页条的实现*/
$page_banner="<div class='page'>";
$pageoffset=($showPage-1)/2;   //计算偏移量
if($page>1){
	$page_banner.="<a href=Mypage.php?page=1>首页</a>";
	$page_banner.="<a href=Mypage.php?page=".($page-1)."><<上一页</a>";
}else{
	$page_banner.="<span class='disable'><a>首页</a></span>";
	$page_banner.="<span class='disable'><a><<上一页></a></span>";
}

$start=1;
$end=$pagenum;  //初始化数据

//首部省略
if($pagenum>$showPage){
	if($page>$pageoffset+1){//判断页码前面是否出现省略号例如页码3，小于偏移量+1，没有省略号，页码4大于偏移量+1，有省略号
		 $page_banner.="...";
	}
	if($page>$pageoffset){
		$start=$page-$pageoffset;//当前页大于偏移量时，则页码开始位置等于当前页-偏移量
		$end=$pagenum>$page+$pageoffset ? $page+$pageoffset : $pagenum;
	}else{
		$start=1;
		$end=$pagenum > $showPage ? $showPage : $pagenum;
	}
	if($page+$pageoffset>$pagenum){
		$start=$start-($page+$pageoffset-$end);
	}
}
//显示页码
for($i=$start;$i<=$end;$i++){
	if($page==$i){
		$page_banner.="<span class='current'>{$i}</span>";
	}else{
		$page_banner.="<a href=Mypage.php?page=".$i.">{$i}</a>";
	}
}

//尾部省略
if($pagenum>$showPage&&$pagenum>$page+$pageoffset){
	$page_banner.="...";
}
if($page<$pagenum){
	$page_banner.="<a href=Mypage.php?page=".($page+1).">下一页>></a>";
	$page_banner.="<a href=Mypage.php?page=".($pagenum).">尾页</a>";
}else{
	$page_banner.="<span class='disable'><a>尾页</a></span>";
	$page_banner.="<span class='disable'><a>下一页>></a></span>";             //$page_banner.=  链接符 ".="
}

$page_banner.="共{$pagenum}页,";	
$page_banner.="<form action='Mypage.php'method='get'>";
$page_banner.="到第<input type='text' size='2' name='page'>页";
$page_banner.="<input type='submit' value='前往'>";
$page_banner.="</form></div>";
echo $page_banner;
?>
</body>
</html> 