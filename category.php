<?php
/**
 建表语句
 CREATE TABLE `category` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(25) NOT NULL DEFAULT '',
  `pid` int(11) DEFAULT NULL,
  `path` varchar(25) DEFAULT NULL,
  `level` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4;

不需要递归的构建二维数组，通过对path进行排序
select * from category order by path;
*/

$arr = array(
	['id'=>1,'name'=>'服饰','pid'=>0,'path'=>'0,1','level' => 1],
	['id'=>2,'name'=>'男装','pid'=>1,'path'=>'0,1,2','level' =>2],
	['id'=>4,'name'=>'短裤男','pid'=>2,'path'=>'0,1,2,4','level' =>3],
	['id'=>3,'name'=>'女装','pid'=>1,'path'=>'0,1,3','level'=> 2],
	['id'=>7,'name'=>'夏群女','pid'=>3,'path'=>'0,1,3,7','level'=> 3],
	['id'=>5,'name'=>'通讯','pid'=>0,'path'=>'0,5','level' =>1],
	['id'=>6,'name'=>'手机','pid'=>5,'path'=>'0,5,6','level' =>2]
);

class Category{
	// 组合以为数组（非递归）需要在查询时排序
	public static function getLevel($cate)
	{
		$result = [];
		foreach ($arr as $k => $v) {
			$deep = explode(',', trim($v['path'], ','));
			$arr[$k]['name'] = str_repeat('&nbsp;&nbsp;', count($deep)) . '|--' . $arr[$k]['name'];
			$result[] = $arr[$k];
		}
		return $result;
	}
	
	// 组合一维数组（递归）
	public static function unLimitedForLevel($cate, $html = '|--', $pid = 0, $level = 0)
	{
		$arr = array();
		foreach ($cate as $v) {
			if ($v['pid'] == $pid) {
				$v['level'] = $level + 1;
				$v['html'] = str_repeat($html, $level);
				$arr[] = $v;
				$arr = array_merge($arr, self::unLimitedForLevel($cate, $html, $v['id'], $level + 1));
			}
		}
		return $arr;
	}
	
	// 组合多维数组
	public static function unLimitedForLayer($cate, $name = 'child', $pid = 0)
	{
		$arr = array();
		foreach ($cate as $v) {
			if ($v['pid'] == $pid) {
				$v[$name] = self::unLimitedForLayer($cate, $name, $v['id']);
				$arr[] = $v;
			}
		}
		return $arr;
	}
	
	// 传递一个子类id，返回所有父级id
	public static function getParents($cate, $id) 
	{
		$arr = array();
		foreach ($cate as $v) {
			if ($v['id'] == $id) {
				$arr[] = $v;
				$arr = array_merge(self::getParents($cate, $v['pid']), $arr);
			}
		}
		return $arr;
	}
	
	// 传递一个父级id，返回所有子类id
	public static function function getChildsId($cate, $id) 
	{
		$arr = array();
		foreach ($cate as $v) {
			if ($v['pid'] == $id) {
				$arr[] = $v['id'];
				$arr = array_merge($arr, self::getChildsId($cate, $v['id']));
			}
		}	
		return $arr;
	}
	
	// 传递一个父级id，返回所有子类
	public static function function getChilds($cate, $id) 
	{
		$arr = array();
		foreach ($cate as $v) {
			if ($v['pid'] == $id) {
				$arr[] = $v;
				$arr = array_merge($arr, self::getChilds($cate, $v['id']));
			}
		}	
		return $arr;
	}
}
