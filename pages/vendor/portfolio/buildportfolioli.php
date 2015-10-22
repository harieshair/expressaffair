<?php
if(!isset($_SESSION)){session_start();}
if(isset($_POST['postvalue']))
  $portfolioid=$_POST['postvalue'];        
  if(empty($vendor)  ){
include_once($_SERVER['DOCUMENT_ROOT']."/eventconfig.php");
include_once(CLASSFOLDER."/dbconnection.php");
include_once(CLASSFOLDER."/vendor.php");
$vendor=new vendorclass($dbconnection->dbconnector);
include_once(CLASSFOLDER."/catalogs.php");
$catalog=new catalogclass($dbconnection->dbconnector);          
$catalogArray=$catalog->GetAllCatalogValuesByMasterNames("PortfolioType");   
}
if(empty($portfolio))
$portfolio=(!empty($portfolioid))?$vendor->getportfoliobyid($portfolioid):array();
?>

<div class="box box-primary">
  <div class="box-header">
    <h3 class="box-title"><?php echo !empty($portfolio['portfoliotype'])?$catalogArray[$portfolio['portfoliotype']] :'';?></h3>
    <a href="javascript:void(0);"  onclick="deletelist('<?php echo $portfolio['id']; ?>')" class="btn btn-box-tool pull-right"><i class="fa fa-times"></i></a>  
    <a href="javascript:void(0);"  onclick="editlist('<?php echo $portfolio['id']; ?>')" class="btn btn-box-tool pull-right"><i class="fa fa-edit"></i></a>      
  </div>
  <div class="box-body"> 
    <div class="row">
      <div class="form-group margin">
        <label class="col-sm-6"><span class="pull-right">Portfolio Type:</span></label>
        <label class="col-sm-6"><?php echo !empty($portfolio['portfoliotype'])?$catalogArray[$portfolio['portfoliotype']] :'';?></label>          
      </div>
      <div class="form-group margin">
        <label class="col-sm-6 "><span class="pull-right">Link:</span></label>
        <label class="col-sm-6"><?php echo $portfolio['link'];?></label>          
      </div>
      <div class="form-group margin">
        <label class="col-sm-6 "><span class="pull-right">About Us:</span></label>
        <label class="col-sm-6"><?php echo $portfolio['aboutus'];?></label>          
      </div>     
    </div>
  </div>
</div>
