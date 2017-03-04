<?php
/**
 *      php输出CSV和EXCEL两种简单的方法
 			注:CSV的定义：逗号分隔值（Comma-Separated Values，CSV，有时也称为字符分隔值，因为分隔字符也可以不是逗号），其文件以纯文本形式存储表格数据（数字和文本）。纯文本意味着该文件是一个字符序列，不含必须像二进制数字那样被解读的数据。CSV文件由任意数目的记录组成，记录间以某种换行符分隔；每条记录由字段组成，字段间的分隔符是其它字符或字符串，最常见的是逗号或制表符。通常，所有记录都有完全相同的字段序列。

 *	1.定义header()头部输出格式
 *		header("Content-type:application/vnd.ms-excel");
 *		header("Content-Disposition:filename=xxx.xls");
 *
 *
 *
 *
 *	
 */
header("Content-Type:text/html;charset=utf-8");
header("Content-type:application/vnd.ms-excel");
header("Content-Disposition:filename=test2.xls");

// echo "A1\t B1\t C1\n";
// echo "A2\t B2\t C2\n";
// echo "A3\t B3\t C3\n";  //csv简单形式
?>
<!--加上下面一句话后，在excel表格中就不会出现乱码-->
<html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" > 
<!DOCTYPE html> 
<html> 
	 <head> 
	    <meta http-equiv="Content-type" content="text/html;charset=UTF-8" /> 
	 </head> 
	 <body>            
	     <table width="200" border="1">
			<tr>
				<td colspan="3"><font color='red'>学员统计</font></td>
			</tr>
			<tr>
				<td>编号</td>
				<td>姓名</td>
				<td>年龄</td>
			</tr>
			<tr>
				<td>1</td>
				<td>张三</td>
				<td>18</td>
			</tr>
			<tr>
				<td>2</td>
				<td>李四</td>
				<td>19</td>
			</tr>
			<tr>
				<td>3</td>
				<td>赵六</td>
				<td>21</td>
			</tr>
			<tr>
				<td>=A3+A4+A5</td>
				<td></td>
				<td>=sum(C3:C5)</td>
			</tr>
		</table>
	 </body> 
</html> 