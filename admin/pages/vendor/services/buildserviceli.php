<?php
$serviceid=isset($_POST['postvalue'])?$_POST['postvalue']:null;        
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
      <label class="col-sm-6 "><p class="pull-right">Title:</p></label>
      <span class="col-sm-6"><?php echo $service['title']; ?>  </span>          
    </div>
    <div class="col-sm-6">
      <label class="col-sm-6 "><p class="pull-right">Service:</p></label>
      <span class="col-sm-6">
        <?php 
        if(!empty($service['service_id'])){
          echo $catalogArray[$service["service_id"]] ;
        }  
        else echo "N/A";
        ?>   
      </span>          
    </div>
    <div class="col-sm-6">  
      <label class="col-sm-6 "><p class="pull-right">Location:</p></label>
      <span class="col-sm-6"> 
       <?php 
       if(!empty($service['locations'])){
         $locations= explode(",",$service['locations']);
         foreach ($locations as $location) {
           echo $catalogArray[$location];
         }
       } 
       else echo "N/A";
       ?> </span>          
     </div>          
     <div class="col-sm-6">
      <label class="col-sm-6 "><p class="pull-right">State:</p></label>
      <span class="col-sm-6">
        <?php 
        if(!empty($service['states'])){
         $states= explode(",",$service['states']);
         foreach ($states as $state) {
           echo $catalogArray[$state] ;
         }
       } 
       else echo "N/A";
       ?>   </span>          
     </div>  
     <div class="col-sm-6">
      <label class="col-sm-6 "><p class="pull-right">Zone:</p></label>
      <span class="col-sm-6">
        <?php 
        if(!empty($service['zones'])){
         $zones= explode(",",$service['zones']);
         foreach ($zones as $zone) {
          echo $catalogArray[$zone] ;
        }
      }  
      else echo "N/A";
      ?>   
    </span>          
  </div>
  <div class="col-sm-6">
    <label class="col-sm-6 "><p class="pull-right">Price:</p></label>
    <span class="col-sm-6"><?php echo $service['price'];?>       </span>          
  </div>
  <div class="col-sm-6">
    <label class="col-sm-6 "><p class="pull-right">Category:</p></label>
    <span class="col-sm-6"><?php echo !empty($service['service_category'])?$catalogArray[$service['service_category']]:'';?></span>          
  </div>    
  <div class="col-sm-12 ">
    <label >Attachments:</label>
    <?php 
    if(!empty($attachments)){
      $files=array();
      foreach ($attachments as $attachment) { ?>
      <a class="attachment-anchor" href="../attachments/downloadfiles.php?filelocation=<?php  echo '../'.$attachment['file_path']; ?>" ><?php echo $attachment['file_name'] ;?></a> 
      <a  onclick="previewfile('<?php  echo "../".$attachment['file_path']; ?>')" ><i class="fa fa-th-large"></i></a>            

    <?php  }
    } ?>        
  </div>
</div>
</div>
</div>