<?php
if(!isset($_SESSION)){session_start();}
if(isset($_POST['postvalue']))
  $serviceid=$_POST['postvalue'];        
if(empty($vendor)  ){
  include_once($_SERVER['DOCUMENT_ROOT']."/eventconfig.php");
  include_once(CLASSFOLDER."/vendor.php");
  $vendor=new vendorclass();   
  include_once(CLASSFOLDER."/catalogs.php");
  $catalog=new catalogclass();
  include_once(CLASSFOLDER."/events.php");
  $event=new eventclass();
  $statecatalogs=$catalog->GetAllCatalogValues('State');
  $zonecatalogs=$catalog->GetAllCatalogValues('Zone');
  $locationcatalogs=$catalog->GetAllCatalogValues('Location'); 
  $eventnames=$event->getAllEventNames();  
  $catalogArray=$catalog->GetAllCatalogValuesByMasterNames("'State','Zone','Location'");      
}
if(empty($service))
  $service=(!empty($serviceid))?$vendor->getvendorservicebyid($serviceid):array();
?>
<div class="box box-primary">
  <div class="box-header">
    <h3 class="box-title"><?php echo !empty($service['title'])?$service['title']:'';?></h3>
    <a href="javascript:void(0);"  onclick="deletelist('<?php echo $service['id']; ?>')" class="btn btn-primary pull-right"><i class="glyphicon  glyphicon-remove"></i></a>  
    <a href="javascript:void(0);"  onclick="editlist('<?php echo $service['id']; ?>')" class="btn btn-primary pull-right"><i class="glyphicon  glyphicon-edit"></i></a>      
  </div>
  <div class="box-body"> 
    <div class="row">
      <div class="form-group margin">
        <label class="col-sm-6">Events</label>
        <label class="col-sm-6"><?php 
          if(!empty($service['events'])){
           $events= explode(",",$service['events']);
           foreach ($events as $event) {
             echo $eventnames[$event['id']] ;
           }
         }
         else echo "N/A" ;      
         ?>

       </label>          
     </div>
     <div class="form-group margin">
      <label class="col-sm-6 ">Zone</label>
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
   <div class="form-group margin">
    <label class="col-sm-6 ">State</label>
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
   <div class="form-group margin">
    <label class="col-sm-6 ">Location</label>
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
 </div>
</div>
</div>

