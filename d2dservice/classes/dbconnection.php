<?php
include_once(CLASSFOLDER."/db_config.php");
include_once(CLASSFOLDER."/dbCon.php"); 
class dbconnection 
{
	//extends GlobalCache
	public $internalDB = null;
public function __construct() // Constructor 
{
	//$this->ALIAS=$alias;
	//$this->oCache=new GlobalCache;
	$this->internalDB = new MeekroDB(DBSERVER,DBUSER,DBPWD,DBNAME,DBPORT);
	
}

/*----------------------------------------------------------------------------------------*/
public function createlog($message){
	$ip=$this->GetIP();
	$this->internalDB->insert('site_log', array(
  'uid' =>isset($_SESSION['userid'])?$_SESSION['userid']:0,
  'log_date' => date("Y-m-d H:i:s"),
  'log_ip' => $ip,
  'message' => $message  
	  ));
}
/*----------------------------------------------------------------------------------------*/
 function GetIP()
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
/*----------------------------------------------------------------------------------------*/
}
?>