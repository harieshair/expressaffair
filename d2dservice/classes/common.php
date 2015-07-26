<?php
include_once($_SERVER['DOCUMENT_ROOT']."/eventconfig.php");
error_reporting(E_ALL);
ini_set('display_errors', '1');
//include_once(CLASSFOLDER.'/dbconnection.php');
class commonclass
{
	//private $roleid=null;
//	private $userid=null;
//	private $dbconnect=null;
//
//function commonclass() 
//{
//	$roleid=$_SESSION['hpadminusertype'];
//	$userid=$_SESSION['hpadminuserid'];
//	$dbconnect=new dbconnection;
//}
/*--------------------------------------------------------------*/

 public static function to_gmt($timestamp)
		{
			return $timestamp - date('Z', $timestamp);
		}
/*-------------------------------------------------------------*/
 public static function to_ist($timestamp)
		{
			$offset= 5.5;
			return $timestamp + ($offset * 60 * 60);		
		}
/*--------------------------------------------------------------*/
public static function ConvertOneTimezoneToAnotherTimezone($time,$currentTimezone,$timezoneRequired)
{
    $system_timezone = date_default_timezone_get();
    $local_timezone = $currentTimezone;
    date_default_timezone_set($local_timezone);
    $local = date("Y-m-d H:i:s A");
 
    date_default_timezone_set("GMT");
    $gmt = date("Y-m-d H:i:s A");
 
    $require_timezone = $timezoneRequired;
    date_default_timezone_set($require_timezone);
    $required = date("Y-m-d H:i:s A");
 
    date_default_timezone_set($system_timezone);

    $diff1 = (strtotime($gmt) - strtotime($local));
    $diff2 = (strtotime($required) - strtotime($gmt));

    $date = new DateTime($time);
    $date->modify("+$diff1 seconds");
    $date->modify("+$diff2 seconds");
    $timestamp = $date->format("m-d-Y H:i:s");
    return $timestamp;
}
/*----------------------------------------------------------*/
//Usage: Getting client side IP Address
//Param: None
//return: This will return client side IP Address
//Created by: Guna
//Created date: 20/2/2013
  public static function GetIP()
	{
		if (getenv("HTTP_CLIENT_IP") && strcasecmp(getenv("HTTP_CLIENT_IP"), "unknown"))
		$ip = getenv("HTTP_CLIENT_IP");
		else if (getenv("HTTP_X_FORWARDED_FOR") && strcasecmp(getenv("HTTP_X_FORWARDED_FOR"), "unknown"))
		$ip = getenv("HTTP_X_FORWARDED_FOR");
		else if (getenv("REMOTE_ADDR") && strcasecmp(getenv("REMOTE_ADDR"), "unknown"))
		$ip = getenv("REMOTE_ADDR");
		else if (isset($_SERVER['REMOTE_ADDR']) && $_SERVER['REMOTE_ADDR'] && strcasecmp($_SERVER['REMOTE_ADDR'], "unknown"))
		$ip = $_SERVER['REMOTE_ADDR'];
		else
		$ip = ""; //Unknown IP Address
		return $ip;
	}
/*-------------------------------------------------------------*/
public  static function getCurrentPageURL() {
 $pageURL = 'http';
 if ($_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
 $pageURL .= "://";
 if ($_SERVER["SERVER_PORT"] != "80") {
  $pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
 } else {
  $pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
 }
 return $pageURL;
}

/*-------------------------------------------------------------*/

 public static function clean($str)
       {
		if($str!='')
		{
			$str = preg_replace("/\t/", "\\t", $str); 
			$str = preg_replace("/\r?\n/", "\\n", $str);
		}
		return $str;
      }
 /*--------------------------------------------------------------------------*/
   public static function cleandate($str)
   {
	if($str!='')
	{
		$str = preg_replace("/\t/", "\\t", $str); 
		$str = preg_replace("/\r?\n/", "\\n", $str);
		$str=str_replace("/","-",$str);
		$date = new DateTime($str);
		$date = $date->format('Y-m-d H:i:s');

	}
	return $date;
  }
  /*----------------------------------------------------------------------------*/
   public static function clean_enddate($str)
   {
	if($str!='')
	{
		$str = preg_replace("/\t/", "\\t", $str); 
		$str = preg_replace("/\r?\n/", "\\n", $str);
		$str=str_replace("/","-",$str);
		$date = new DateTime($str);
		$date->setTime(23, 59, 59);
		$date = $date->format('Y-m-d H:i:s');

	}
	return $date;
  }
/*----------------------------------------------------------------------------*/
 public static function guid(){
    
         mt_srand((double)microtime()*10000);//optional for php 4.2.0 and up.
        $charid = strtoupper(md5(uniqid(rand(), true)));
        $hyphen = chr(45);// "-"
        $uuid = //chr(123) "{"
                substr($charid, 0, 8).$hyphen
                .substr($charid, 8, 4).$hyphen
                .substr($charid,12, 4).$hyphen
                .substr($charid,16, 4).$hyphen
                .substr($charid,20,12);
                // .chr(125);"}"
        return $uuid;
	
}


/*----------------------------------------------------------------------------*/
public static function getguid()
{
    
         mt_srand((double)microtime()*10000);//optional for php 4.2.0 and up.
        $charid = strtoupper(md5(uniqid(rand(), true)));
        $hyphen = chr(45);// "-"
        $uuid = //chr(123) "{"
                substr($charid, 0, 8).$hyphen
                .substr($charid, 8, 4).$hyphen
                .substr($charid,12, 4).$hyphen
                .substr($charid,16, 4).$hyphen
                .substr($charid,20,12);
                // .chr(125);"}"
        return $uuid;
	
}

/*--------------------------------------------------------------------------------------*/
public  static function sendsms($urncode,$mobilenumber,$candidatename)
{

$msgurl ='http://smslane.com/vendorsms/pushsms.aspx?user=hirepro&password=HireProsms@001&msisdn=91'.$mobilenumber.'&sid=HREPRO&msg=Dear '.$candidatename.', Your URN Code is: '.$urncode.' Please use this code for your future reference.&fl=0&gwid=2';
echo "<iframe src='$msgurl' style='display:none'></iframe>";

}

/*----------------------------------------------------------------------------*/



}
?>
