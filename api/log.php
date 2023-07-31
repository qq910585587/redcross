<?php
include("../include/init.php");
header("Content:Content-type:text/html;charset=utf-8");
//   // 作用取得客户端的ip、地理位置、浏览器、以及访问设备

   ////获得访客浏览器类型
   function GetBrowser(){
    if(!empty($_SERVER['HTTP_USER_AGENT']))
    {
     $br = $_SERVER['HTTP_USER_AGENT'];
     if (preg_match('/MSIE/i',$br)){
       $br = 'MSIE';
     }
     elseif (preg_match('/Firefox/i',$br)){
       $br = 'Firefox';
     }elseif (preg_match('/Chrome/i',$br)){
       $br = 'Chrome';
     }elseif (preg_match('/Safari/i',$br)){
       $br = 'Safari';
     }elseif (preg_match('/Opera/i',$br)){
       $br = 'Opera';
     }else {
       $br = 'Other';
     }
       return json_encode($br);
     }else{
       return "";}
   }
   ////获得访客浏览器语言
   function GetLang()
   {
      if(!empty($_SERVER['HTTP_ACCEPT_LANGUAGE'])){
        $lang = $_SERVER['HTTP_ACCEPT_LANGUAGE'];
        $lang = substr($lang,0,5);
        if(preg_match("/zh-cn/i",$lang)){
          $lang = "简体中文";
        }elseif(preg_match("/zh/i",$lang)){
          $lang = "繁体中文";
        }else{
          $lang = "English";
        }
        return json_encode($lang);
      }else{
      return "";
      }
   }
   //获取客户端操作系统信息包括win10
  function GetOs(){
    $agent = $_SERVER['HTTP_USER_AGENT'];
    $os = false;
    if (preg_match('/win/i', $agent) && strpos($agent, '95'))
    {
      $os = 'Windows 95';
    }
    else if (preg_match('/win 9x/i', $agent) && strpos($agent, '4.90'))
    {
      $os = 'Windows ME';
    }
    else if (preg_match('/win/i', $agent) && preg_match('/98/i', $agent))
    {
      $os = 'Windows 98';
    }
    else if (preg_match('/win/i', $agent) && preg_match('/nt 6.0/i', $agent))
    {
      $os = 'Windows Vista';
    }
    else if (preg_match('/win/i', $agent) && preg_match('/nt 6.1/i', $agent))
    {
      $os = 'Windows 7';
    }
    else if (preg_match('/win/i', $agent) && preg_match('/nt 6.2/i', $agent))
    {
      $os = 'Windows 8';
    }else if(preg_match('/win/i', $agent) && preg_match('/nt 10.0/i', $agent))
    {
      $os = 'Windows 10';#添加win10判断
    }else if (preg_match('/win/i', $agent) && preg_match('/nt 5.1/i', $agent))
    {
      $os = 'Windows XP';
    }
    else if (preg_match('/win/i', $agent) && preg_match('/nt 5/i', $agent))
    {
      $os = 'Windows 2000';
    }
    else if (preg_match('/win/i', $agent) && preg_match('/nt/i', $agent))
    {
      $os = 'Windows NT';
    }
    else if (preg_match('/win/i', $agent) && preg_match('/32/i', $agent))
    {
      $os = 'Windows 32';
    }
    else if (preg_match('/linux/i', $agent))
    {
      $os = 'Linux';
    }
    else if (preg_match('/unix/i', $agent))
    {
      $os = 'Unix';
    }
    else if (preg_match('/sun/i', $agent) && preg_match('/os/i', $agent))
    {
      $os = 'SunOS';
    }
    else if (preg_match('/ibm/i', $agent) && preg_match('/os/i', $agent))
    {
      $os = 'IBM OS/2';
    }
    else if (preg_match('/Mac/i', $agent) && preg_match('/PC/i', $agent))
    {
      $os = 'Macintosh';
    }
    else if (preg_match('/PowerPC/i', $agent))
    {
      $os = 'PowerPC';
    }
    else if (preg_match('/AIX/i', $agent))
    {
      $os = 'AIX';
    }
    else if (preg_match('/HPUX/i', $agent))
    {
      $os = 'HPUX';
    }
    else if (preg_match('/NetBSD/i', $agent))
    {
      $os = 'NetBSD';
    }
    else if (preg_match('/BSD/i', $agent))
    {
      $os = 'BSD';
    }
    else if (preg_match('/OSF1/i', $agent))
    {
      $os = 'OSF1';
    }
    else if (preg_match('/IRIX/i', $agent))
    {
      $os = 'IRIX';
    }
    else if (preg_match('/FreeBSD/i', $agent))
    {
      $os = 'FreeBSD';
    }
    else if (preg_match('/teleport/i', $agent))
    {
      $os = 'teleport';
    }
    else if (preg_match('/flashget/i', $agent))
    {
      $os = 'flashget';
    }
    else if (preg_match('/webzip/i', $agent))
    {
      $os = 'webzip';
    }
    else if (preg_match('/offline/i', $agent))
    {
      $os = 'offline';
    }
    else if (preg_match('/iphone/i', $agent))
    {
      $os = 'iphone';
    }
    else if (preg_match('/android/i', $agent))
    {
      $os = 'android';
    }
    else if (preg_match('/ipad/i', $agent))
    {
      $os = 'ipad';
    }
    else
    {
      $os = '';
    }
    return json_encode($os);
  }
  //获得访客真实ip
   function Get_ip()
  {
    if ($_SERVER["HTTP_CLIENT_IP"] && !empty($_SERVER["HTTP_CLIENT_IP"])) {
      $ip = $_SERVER["HTTP_CLIENT_IP"];
    }
    if ($_SERVER['HTTP_X_FORWARDED_FOR'] && !empty($_SERVER['HTTP_X_FORWARDED_FOR'])) { // 获取代理ip
      $ips = explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);
    }
    if ($ip) {
      $ips = array_unshift($ips, $ip);
    }
    $count = count($ips);
    for ($i = 0; $i < $count; $i ++) {
      if (! preg_match("/^(10|172\.16|192\.168)\./i", $ips[$i])) { // 排除局域网ip
        $ip = $ips[$i];
        break;
      }
    }
    $tip = empty($_SERVER['REMOTE_ADDR']) ? $ip : $_SERVER['REMOTE_ADDR'];
    return $tip;
   /* if ($tip == "127.0.0.1") { // 获得本地真实IP
      return $this->get_onlineip();
    } else {
      return $tip;
    }*/
  }
   // //根据ip获得访客所在地地名
  function Getaddress($ip = '')
  {
    if (empty($ip)) {
      $ip = Get_ip();
    }
    $ipadd = file_get_contents("http://ip-api.com/json/".$ip."?fields=country,isp,org,as,mobile,proxy,hosting&lang=zh-CN"); // ip-api
    if ($ipadd) {
        
        return json_decode($ipadd,true);
   /*   $charset = iconv("gbk", "utf-8", $ipadd);
      preg_match_all("/[\x{4e00}-\x{9fa5}]+/u", $charset, $ipadds);
      return $ipadds; // 返回一个二维数组*/
    } else {
      return "";
    }
  }


function encrypt($string, $key)
{
	$key = hash('SHA256',$key);
	// openssl_encrypt 加密不同Mcrypt，对秘钥长度要求，超出16加密结果不变
	$data = openssl_encrypt($string, 'AES-128-ECB', hex2bin($key), OPENSSL_RAW_DATA);
	$data = strtolower(bin2hex($data));
	return $data;
}   
if($_POST){
    if($_POST['key'] == encrypt($_POST['time'],'sakura')){
        $year = date("Y");
        $month = date("m");
        $day = date("d");
        $start = mktime(0,0,0,$month,$day,$year);//当天开始时间戳
        $end= mktime(23,59,59,$month,$day,$year);//当天结束时间戳
        if($_SERVER['REMOTE_ADDR']){
            $set->table_name = 'package_log';
            $log_ip = $set->keyfind('*','ip = "'.daddslashes($_SERVER['REMOTE_ADDR']).'" AND time > '.$start.' AND url = "'.$_SERVER['HTTP_HOST'].'"');
            if($log_ip){
                exit(EchoMsg(200,'success og','','','1',''));
            }else{
                $data = array();
                $get_ip = Getaddress();
                $data['time'] = time();
                $data['url'] = $_SERVER['HTTP_HOST'];
                $data['ip'] = $_SERVER['REMOTE_ADDR'];
                $data['language'] = json_decode(GetLang());
                $data['system'] = json_decode(GetOs());
                $data['browser'] = json_decode(GetBrowser());
                $data['country'] = $get_ip['country'];
                $data['area'] = $get_ip['isp'];
               // $data['mobile'] = $get_ip['mobile']==true?1:0;
                $data['proxy'] = $get_ip['proxy']==true?1:0;
                $data['hosting'] = $get_ip['hosting']==true?1:0;
                $data['agent'] = $_SERVER['HTTP_USER_AGENT'];

                $sql = $set->create($data); 
                if($sql){
                    exit(EchoMsg(200,'success log','','','1',''));
                }else{
                    exit(EchoMsg(203,'error log','','','1',''));
                }
            }
        } 
    }
}

?>