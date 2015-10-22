<?php
if(!isset($_SESSION)){session_start();}
if(isset($_POST['postvalue']))
  $contactid=$_POST['postvalue'];        
if(empty($vendor)  ){
  include_once($_SERVER['DOCUMENT_ROOT']."/eventconfig.php");
  include_once(CLASSFOLDER."/dbconnection.php");
  include_once(CLASSFOLDER."/vendor.php");
  $vendor=new vendorclass($dbconnection->dbconnector);   
  include_once(CLASSFOLDER."/catalogs.php");
  $catalog=new catalogclass($dbconnection->dbconnector);          
  $statecatalogs=$catalog->GetAllCatalogValues('State'); 
  $citycatalogs=$catalog->GetAllCatalogValues('City');
  $catalogArray=$catalog->GetAllCatalogValuesByMasterNames("City,State");
}
if(empty($contact))
  $contact=(!empty($contactid))?$vendor->getcontactsbyid($contactid):array();
?>

<div class="box box-primary">
  <div class="box-header">
    <h3 class="box-title"><?php echo $contact['title'];?></h3>
    <a href="javascript:void(0);"  onclick="deletelist('<?php echo $contact['id']; ?>')" class="btn btn-box-tool pull-right"><i class="fa fa-times"></i></a>  
    <a href="javascript:void(0);"  onclick="editlist('<?php echo $contact['id']; ?>')" class="btn btn-box-tool pull-right"><i class="fa fa-edit"></i></a>      
  </div>
  <div class="box-body"> 
    <div class="row">
      <div class="form-group margin">
        <label class="col-sm-6"><span class="pull-right">Title:</span></label>
        <label class="col-sm-6"><?php echo $contact['title'];?></label>          
      </div>
      <div class="form-group margin">
        <label class="col-sm-6 "><span class="pull-right">Contact Person:</span></label>
        <label class="col-sm-6"><?php echo $contact['contactperson'];?></label>          
      </div>
      <div class="form-group margin">
        <label class="col-sm-6 "><span class="pull-right">Contact Number1:</span></label>
        <label class="col-sm-6"><?php echo $contact['contactnumber1'];?></label>          
      </div>

      <div class="form-group margin">
        <label class="col-sm-6 "><span class="pull-right">Office Number:</span></label>
        <label class="col-sm-6"><?php echo $contact['officenumber'];?></label>          
      </div>
      <div class="form-group margin">
        <label class="col-sm-6 "><span class="pull-right">Address:</span></label>
        <label class="col-sm-6"><?php echo $contact['address1'];?></label>          
      </div>

      <div class="form-group margin">
        <label class="col-sm-6 "><span class="pull-right">State:</span></label>
        <label class="col-sm-6"><?php echo !empty($contact['state'])?$catalogArray[$contact['state']] :'';?></label>          
      </div>  
      <div class="form-group margin">
        <label class="col-sm-6"><span class="pull-right">City:</span></label>
        <label class="col-sm-6"><?php echo !empty($contact['city'])?$catalogArray[$contact['city']] :'';?></label>          
      </div>   
      <div class="form-group margin">
        <label class="col-sm-6 "><span class="pull-right">Pin Code:</span></label>
        <label class="col-sm-6"><?php echo $contact['pincode'];?></label>          
      </div>
    </div>
  </div>
</div>
