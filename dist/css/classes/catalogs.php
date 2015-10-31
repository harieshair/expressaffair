<?php
class catalogclass  {
	public $internalDB;	
	/*-------------------------------------------------------------*/
function catalogclass($db) // Constructor 
{
	$this->internalDB=$db;
}
/*----------------------------------------------------------------------------*/
function saveCatalogValuesIntoCache(){
	$result=include "catalogs/savecatalogvalues.php";
	return $result;
}
/*----------------------------------------------------------------------------*/
function add_quotes($str) {
    return sprintf("'%s'", $str);
}
function GetAllCatalogValuesByMasterNames($masternames){
	$catalogarray=array();
	$catalogvalues=$this->internalDB->query("SELECT id,catalog_value FROM catalog_value c where catalogmaster_id in (select id from catalog_master where name in ('".implode("','", explode(',', $masternames))."'))"); 
	foreach($catalogvalues as $catalog)
		$catalogarray[$catalog['id']]=$catalog['catalog_value'];
	return $catalogarray;
}

/*----------------------------------------------------------------------------*/
function GetAllCatalogValues($mastername){
	$catalogvalues=$this->internalDB->query("SELECT id,catalog_value FROM catalog_value c where catalogmaster_id=(select id from catalog_master where name='$mastername')"); 

	return $catalogvalues;
}
/*-------------------------------------------------------------------------------------------------*/
function getCatalogValuesById($catalogid){
	if(!empty($catalogid)){
		$ret=$this->internalDB->queryFirstField("select catalog_value from catalog_value where id=$catalogid");
		return $ret;
	}
	return '';
}
/*-------------------------------------------------------------------------------------------------*/
function getallCatalogMastaersNames(){
	$ret=$this->internalDB->query("select name,id from catalog_master where name <> '' and name is not null");
	return $ret;
}
/*-------------------------------------------------------------------------------------------------*/
function getallCatalogValuesNames($catalogmasterid){
	$ret=$this->internalDB->query("select id,catalog_value from  catalog_value 
		where catalogmaster_id=$catalogmasterid and catalog_value <> '' and catalog_value is not null");
	return $ret;
}
/*-------------------------------------------------------------------------------------------------*/
function getcatalogValueByValueId($valueid){
	return $this->internalDB->queryFirstField("select catalog_value from catalog_value where id=$valueid");
}
/*-------------------------------------------------------------------------------------------------*/
function getCatalogMasterById($catalogmasterid){
	$ret=$this->internalDB->queryFirstRow("select name ,description from catalog_master where id=$catalogmasterid");
	return $ret;
}
/*-------------------------------------------------------------------------------------------------*/
function getCatalogValuesByMasterId($catalogmasterid){
	$ret=$this->internalDB->query("select id,catalog_value,catalogvalue_id from catalog_value where catalogmaster_id=$catalogmasterid order by id");
	return $ret;
}
/*-------------------------------------------------------------------------------------------------*/
function GetAllCatalogList($page,$rows,$searchobj){
	$returnvalue=include 'catalogs/getallcatalogmasters.php';
	return $returnvalue;
}
function getTotalCataolgs($searchobj){
	$returnvalue=include 'catalogs/getcatalogstotalcount.php';
	return $returnvalue;
}
/*-------------------------------------------------------------------------------------------------*/
private function catalogpagination($totcount,$page,$rows,$obj)
{
	$returnvalue=include 'catalogs/cataloggridpagination.php';
	return $returnvalue;
}
/*-------------------------------------------------------------------------------------------------*/
public function getAllCatalogValuesByMasterId($catalogmasterid){
	$returnvalue=include 'catalogs/getallcatalogvalues.php';
}
/*-------------------------------------------------------------------------------------------------*/
public function updatecatalogmasterlist($catalogmasterid,$catalogmastername,$description,$addedcatalogs,$removedcatalogs,$enabledcatalogs,$disabledcatalogs){
	$response=array();
	$affectedrows=0;
	try{	
		$temp = commonclass::to_ist(commonclass::to_gmt(time()));
		$createdon=date("y-m-d H:i:s",$temp);
		$catalogmasterid=(empty($catalogmasterid))?$this->addNewCatalogmaster($catalogmastername,$description,$createdon):$catalogmasterid;
		if(!empty($removedcatalogs)){
			$affectedrows=$this->removecatalogvalues($removedcatalogs);
		}
		if(!empty($addedcatalogs)){
			$affectedrows=$this->addNewcatalogvalues($addedcatalogs,$catalogmasterid,$createdon);
		}
		if(!empty($enabledcatalogs)){
			$affectedrows=$this->enablecatalogvalues($enabledcatalogs);
		}
		if(!empty($disabledcatalogs)){
			$affectedrows=$this->disablecatalogvalues($disabledcatalogs);
		}
	}
	catch(Exception $ex){
		$response['Exception']=$ex->getMessage();
	}
	return $response;
	($affectedrows>0)?$response['Id']=$catalogmasterid:$response['Exception']="Error in saving Catalogs";
	return $response;
}
/*-------------------------------------------------------------------------------------------------*/
private function addNewCatalogmaster($masterName,$description,$createdon){
	$this->internalDB->insert('catalog_master',array(
		'name'=>$masterName,
		'description'=>$description,
		'created_on'=>$createdon));
	return $this->internalDB->insertId();
}
/*------------------------------------------------------------------------------------------------*/
private function addNewcatalogvalues($catalogvalues,$masterid,$createdon){
	$bulkinsert=array();
	try{
		foreach($catalogvalues as $value){
			$bulkinsert[]=array(
				'catalogmaster_id'=>$masterid,
				'catalog_value'=>$value->catalogvaluename,
				'catalogvalue_id'=>!empty($value->parentid)?$value->parentid:null,
				'created_on'=>$createdon);
		}
		if(!empty($bulkinsert))
			$this->internalDB->insert("catalog_value",$bulkinsert);
		return $this->internalDB->affectedRows();
	}
	catch(Exception $ex){
		throw new Exception($ex->getMessage(), 1);
	}
}
/*------------------------------------------------------------------------------------------------*/
private function removecatalogvalues($removedcatalogs){
	try{
		$this->internalDB->query("DELETE FROM catalog_value where id in (".$removedcatalogs.")");
		return $this->internalDB->affectedRows();
	}
	catch(Exception $ex){
		throw new Exception($ex->getMessage(), 1);	
	}
}
/*------------------------------------------------------------------------------------------------*/
private function enablecatalogvalues($enabledcatalogs){
	try{
		$this->internalDB->query("update catalog_value set is_disabled=0 where id in (".$enabledcatalogs.")");
		return $this->internalDB->affectedRows();
	}
	catch(Exception $ex){
		throw new Exception($ex->getMessage(), 1);	
	}
}
/*------------------------------------------------------------------------------------------------*/
private function disablecatalogvalues($disabledcatalogs){
	try{
		$this->internalDB->query("update catalog_value set is_disabled=1 where id in (".$disabledcatalogs.")");
		return $this->internalDB->affectedRows();
	}
	catch(Exception $ex){
		throw new Exception($ex->getMessage(), 1);	
	}
}


/*------------------------------------------------------------------------------------------------*/
}