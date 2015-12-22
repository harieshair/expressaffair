<?php
include_once($_SERVER['DOCUMENT_ROOT']."/eventconfig.php");
include_once(CLASSFOLDER."/dbconnection.php");
include_once(CLASSFOLDER."/common.php");
include_once(CLASSFOLDER."/catalogs.php");
$catalog = new catalogclass($dbconnection->dbconnector);

//ob_start("ob_gzhandler");
switch($_POST['action']){
	/*--------------------------------------------------------------*/
	case "getallcatalogvalues":
	$catalogmasterid = $_POST['catalogmasterid'];
	echo $catalog->getAllCatalogValuesByMasterId($catalogmasterid);
	break;
	/*--------------------------------------------------------------*/
	case "showmngcatalogpaging":
	$rows = $_POST['rows'];
	$page = $_POST['page'];
	$obj =isset($_POST['searchObj'])?json_decode($_POST['searchObj']):null;
	echo $catalog->showManageCatalogs($page,$rows,$obj);
	break;
	/*--------------------------------------------------------------*/
	case "savecatalogvalues":
	$catalogmasterid=$_POST['catalogmasterid'];
	$catalogmastername=$_POST['catalogmastername'];
	$description=$_POST['description'];
	$addedcatalogs=isset($_POST['addedcatalogs'])?json_decode($_POST['addedcatalogs']):null;
	$removedcatalogs=isset($_POST['removedcatalogs'])?$_POST['removedcatalogs']:null;
	$enabledcatalogs=isset($_POST['enabledcatalogs'])?$_POST['enabledcatalogs']:null;
	$disabledcatalogs=isset($_POST['disabledcatalogs'])?$_POST['disabledcatalogs']:null;
	$response= $catalog->updatecatalogmasterlist($catalogmasterid,$catalogmastername,$description,$addedcatalogs,$removedcatalogs,$enabledcatalogs,$disabledcatalogs);
	if(empty($response['Exception']))
		$response['Message']="Catalogs updated successfully";
	echo json_encode($response);
	break;
	/*--------------------------------------------------------------*/
	case "getallCatalogValuesNamesForDropDown":
	$catalogmasterid = $_POST['catalogmasterid'];
	$catalogvalues=$catalog->getallCatalogValuesNames($catalogmasterid);
	echo '<option vlaue="">Select</option>';
	if(!empty($catalogvalues)){
		foreach($catalogvalues as $values)
			echo '<option value="'.$values['id'].'">'.$values['catalog_value'].'</option>';
	}
	break;
	/*--------------------------------------------------------------*/
	case "getCatalogValuesByMasterName":
	$catalogmasterid = $_POST['catalogmasterid'];
	$catalogvalues=$catalog->getallCatalogValuesNames($catalogmasterid);
	echo '<option vlaue="">Select</option>';
	if(!empty($catalogvalues)){
		foreach($catalogvalues as $values)
			echo '<option value="'.$values['catalog_value_id'].'">'.$values['catalog_value_name'].'</option>';
	}
	break;
	/*--------------------------------------------------------------*/
	case "getAllCatalogValues":
	$catalogmasterName = $_POST['masterName'];
	$catalogvalues=$catalog->GetAllCatalogValues($catalogmasterName);
	echo json_encode($catalogvalues);
	break;
	/*--------------------------------------------------------------*/
}
