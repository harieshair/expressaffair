<?php
require_once("rest.inc.php");
include_once($_SERVER['DOCUMENT_ROOT']."/eventconfig.php");
include_once(CLASSFOLDER."/catalogs.php");
class catalogapi extends REST 
{

	public function __construct()
	{
		parent::__construct();// Init parent contructor
		$this->catalog = new catalogclass();
	}


//Public method for access api.
//This method dynmically call the method based on the query string
	public function processApi()
	{
		$func = strtolower(trim(str_replace("/","",$_REQUEST['rquest'])));
		if((int)method_exists($this,$func) > 0)
			$this->$func();
		else
			$this->response('',404); 
// If the method not exist with in this class, response would be "Page not found".
	}

	private function getCatalogsByMaterName()
	{
		if($this->get_request_method() != "POST")
		{
			$this->response('',406);
		}
		if(!empty($this->_request['mastername'])){		
			$result=$this->catalog->GetAllCatalogValues($this->_request['mastername']);
			$this->response($this->json($result),200);
		}
	}

//Encode array into JSON
	private function json($data)
	{
		if(is_array($data)){
			return json_encode($data);
		}
	}

}
// Initiiate Library
$api = new catalogapi;
$api->processApi();
?>