<?php
if(!isset($_SESSION)){session_start();}
if(isset($_POST['postvalue']))
  $serviceid=$_POST['postvalue'];        
if(empty($vendor)  ){
  include_once($_SERVER['DOCUMENT_ROOT']."/eventconfig.php");
  include_once(CLASSFOLDER."/dbconnection.php");
  include_once(CLASSFOLDER."/vendor.php");
  $vendor=new vendorclass($dbconnection->dbconnector);   
  include_once(CLASSFOLDER."/catalogs.php");
  $catalog=new catalogclass($dbconnection->dbconnector);
  $catalogArray=$catalog->GetAllCatalogValuesByMasterNames("State,Zone,City,Services,Service Category");                
}
if(empty($service))
  $service=(!empty($serviceid))?$vendor->getvendorservicebyid($serviceid):array();
if(empty($attachments))
$attachments=!empty($serviceid)?$vendor->getAllAttachmentsByEntityId($serviceid,VENDORSERVICE):null;
?>
<div class="box box-primary">
  <div class="box-header">
    <h3 class="box-title"><?php echo !empty($service['title'])?$service['title']:'';?></h3>
    <a href="javascript:void(0);"  onclick="deletelist('<?php echo $service['id']; ?>')" class="btn btn-box-tool pull-right"><i class="fa fa-times"></i></a>  
    <a href="javascript:void(0);"  onclick="editlist('<?php echo $service['id']; ?>')" class="btn btn-box-tool pull-right"><i class="fa fa-edit"></i></a>      
  </div>
  <div class="box-body"> 
    <div class="row">
     <div class="col-sm-6">
      <label class="col-sm-6 "><span class="pull-right">Title:</span></label>
      <label class="col-sm-6"><?php echo $service['title']; ?>  </label>          
    </div>
    <div class="col-sm-6">
      <label class="col-sm-6 "><span class="pull-right">Service:</span></label>
      <label class="col-sm-6">
        <?php 
        if(!empty($service['service_id'])){
          echo $catalogArray[$service["service_id"]] ;
        }  
        else echo "N/A";
        ?>   
      </label>          
    </div>
    <div class="col-sm-6">  
      <div class="col-sm-12">
        <label class="col-sm-6 "><span class="pull-right">Location:</span></label>
        <label class="col-sm-6"> 
         <?php 
         if(!empty($service['locations'])){
           $locations= explode(",",$service['locations']);
           foreach ($locations as $location) {
             echo $catalogArray[$location];
           }
         } 
         else echo "N/A";
         ?> </label>          
       </div>          
       <div class="col-sm-12">
        <label class="col-sm-6 "><span class="pull-right">State:</span></label>
        <label class="col-sm-6">
          <?php 
          if(!empty($service['states'])){
           $states= explode(",",$service['states']);
           foreach ($states as $state) {
             echo $catalogArray[$state] ;
           }
         } 
         else echo "N/A";
         ?>   </label>          
       </div>  
       <div class="col-sm-12">
        <label class="col-sm-6 "><span class="pull-right">Zone:</span></label>
        <label class="col-sm-6">
          <?php 
          if(!empty($service['zones'])){
           $zones= explode(",",$service['zones']);
           foreach ($zones as $zone) {
            echo $catalogArray[$zone] ;
          }
        }  
        else echo "N/A";
        ?>   
      </label>          
    </div>
  </div>
   <div class="col-sm-6">
      <label class="col-sm-6 "><span class="pull-right">Description:</span></label>
      <label class="col-sm-6"><?php echo $service['description'];?>       </label>          
    </div>
      <div class="col-sm-6 ">
      <label class="col-sm-6 "><span class="pull-right">Service Image:</span></label>
      <label class="col-sm-6"> <?php if(!empty($attachments)){
          $files=array();
          foreach ($attachments as $attachment) {
            echo $attachment['file_name'].',';
          }
          }?>    </label>          
    </div>
     <div class="col-sm-6">
      <label class="col-sm-6 "><span class="pull-right">Price:</span></label>
      <label class="col-sm-6"><?php echo $service['price'];?>       </label>          
    </div>
     <div class="col-sm-6">
      <label class="col-sm-6 "><span class="pull-right">Service Category:</span></label>
      <label class="col-sm-6"><?php echo !empty($service['service_category'])?$catalogArray[$service['service_category']]:'';?></label>          
    </div>
</div>
</div>
</div>
