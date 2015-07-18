<?php
include_once($_SERVER['DOCUMENT_ROOT']."/d2dconfig.php");
session_start();
include_once(CLASSFOLDER."/common.php");
include_once(CLASSFOLDER."/catalogs.php");
$catalog = new catalogclass();

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
echo $catalog->updatecatalogmasterlist($catalogmasterid,$catalogmastername,$description,$addedcatalogs,$removedcatalogs,$enabledcatalogs,$disabledcatalogs);
break;
/*--------------------------------------------------------------*/
case "getallCatalogValuesNamesForDropDown":
$catalogmasterid = $_POST['catalogmasterid'];
$catalogvalues=$catalog->getallCatalogValuesNames($catalogmasterid);
echo '<option vlaue="">Select</option>';
if(!empty($catalogvalues)){
	foreach($catalogvalues as $values)
	echo '<option value="'.$values['catalog_value_id'].'">'.$values['catalog_value_name'].'</option>';
}
break;
/*--------------------------------------------------------------*/
}
