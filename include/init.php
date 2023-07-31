<?php
/**
 * 全局项加载
 * @copyright (c) Emlog All Rights Reserved
 */
ob_start();
header('Content-Type: text/html; charset=UTF-8');
date_default_timezone_set("PRC");
define('IN_CRONLITE', true);
define('SYSTEM_ROOT', dirname(__FILE__).'/');
define('ROOT', dirname(SYSTEM_ROOT).'/');
//cookie加密密钥
define('SYS_KEY', 'esukuraf');

require_once (SYSTEM_ROOT.'/lib/model.php');
require_once (SYSTEM_ROOT.'/lib/function.base.php');


//全局删除反斜杠
doStripslashes();

$randkey = rand(0,11);
$firstname = [
	'0' => [
		'name' => '无差别',
		'img' => '/index/img/sukura.jpg'
	],
	'1' => [
		'name' => '雪辉',
		'img' => '/index/img/sukura.jpg'
	],
	'2' => [
		'name' => '杀人',
		'img' => '/index/img/sukura.jpg'
	],
	'3' => [
		'name' => '搜查',
		'img' => '/index/img/sukura.jpg'
	],
	'4' => [
		'name' => '涂鸦',
		'img' => '/index/img/sukura.jpg'
	],
	'5' => [
		'name' => '千里眼',
		'img' => '/index/img/sukura.jpg'
	],
	'6' => [
		'name' => '交换',
		'img' => '/index/img/sukura.jpg'
	],
	'7' => [
		'name' => '增值',
		'img' => '/index/img/sukura.jpg'
	],
	'8' => [
		'name' => '逃亡',
		'img' => '/index/img/sukura.jpg'
	],
	'9' => [
		'name' => '饲养',
		'img' => '/index/img/sukura.jpg'
	],
	'10' => [
		'name' => '观测者',
		'img' => '/index/img/sukura.jpg'
	],
	'11' => [
		'name' => '正义',
		'img' => '/index/img/sukura.jpg'
	]
];
$tourist = $firstname[$randkey]['name'].'日记持有者';
$touristimg = $firstname[$randkey]['img'];

$password_hash = '@#%^#$%&*^*#';
$date = date("Y-m-d H:i:s");
session_start();

$set = new Model("sukura_set");
$conf = $set->find(array("id = 1"),"","*");
//默认image
$defaultImg = '/index/img/sukura.jpg';
//IP黑名单
$ip = funip(getIp()) ? getIp() : '';
//$ip_arr = explode(',',$conf['ipadmin']);
/*
if(in_array($ip, $ip_arr)){
	exit('黑名单');
}*/
//DEBUG
if($conf['debug']!=1){error_reporting(0);}

//weburl
$http_type = ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on') || (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https')) ? 'https://' : 'http://';
$WebUrl = $http_type . $_SERVER['HTTP_HOST'];

loader('member');
loader('mcrypt.class');

?>