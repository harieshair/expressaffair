<?php 
$vendorid=isset($_POST['postvalue'])?$_POST['postvalue']:null;          
include_once($_SERVER['DOCUMENT_ROOT']."/eventconfig.php");
include_once(CLASSFOLDER."/dbconnection.php");
include_once(CLASSFOLDER."/vendor.php");
$vendor=new vendorclass($dbconnection->dbconnector);   
include_once(CLASSFOLDER."/catalogs.php");
$catalog=new catalogclass($dbconnection->dbconnector);          
$citycatalogs=$catalog->GetAllCatalogValues('City'); 
$statecatalogs=$catalog->GetAllCatalogValues('State'); 
if(empty($vendordata))
  $vendordata=(!empty($vendorid))?$vendor->getvendorbyid($vendorid):array();
$catalogArray=array();
?>

<section class="content-header">
          <h1 class="ele-centered">
            <?php echo $vendordata['title'] ; ?>
            <small> Details:            </small>  </h1>        
        </section>
<div class="row">
	<div class="col-xs-12">
		<div class="col-lg-3 wizardleft"><?php include_once "wizardleftbar.php"; ?></div>
		<div class="col-lg-9 wizardright" id="wizardcontent"><?php include_once "vendorbasics.php"; ?></div>
	</div>
</div>



