<?php
  $attachmentid=isset($_POST['postvalue'])?$_POST['postvalue']:null;        
if(empty($vendorclass)  ){
  include_once($_SERVER['DOCUMENT_ROOT']."/eventconfig.php");
  include_once(CLASSFOLDER."/dbconnection.php");
  include_once(CLASSFOLDER."/vendor.php");
  $vendorclass=new vendorclass($dbconnection->dbconnector);  
  include_once(CLASSFOLDER."/catalogs.php");
  $catalog=new catalogclass($dbconnection->dbconnector);
  $catalogArray=$catalog->GetAllCatalogValuesByMasterNames("Services"); 
  $typeList=   $vendorclass->AttachmentType->getlists(); 
}
if(empty($attachment))
  $attachment=(!empty($attachmentid))?$vendorclass->getvendorattachment($attachmentid):array();
?>
<div class="box box-primary">
  <div class="box-header">
    <h3 class="box-title  col-sm-10">Attachment</h3>
 <div class="col-sm-2">        
        <a href="javascript:void(0);"  onclick="deletelist('<?php echo $attachment['id']; ?>')" class="btn btn-box-tool pull-right"><i class="fa fa-times"></i></a>  
        <a href="javascript:void(0);"  onclick="editlist('<?php echo $attachment['id']; ?>')" class="btn btn-box-tool pull-right"><i class="fa fa-edit"></i></a>
      </div> 
  </div>
  <div class="box-body"> 
    <div class="row">
      <div class="form-group margin">
        <label class="col-sm-6 "><span class="pull-right">Services:</span></label>
        <label class="col-sm-6">
          <?php 
          if(!empty($attachment['services'])){
           $zones= explode(",",$attachment['services']);
           foreach ($zones as $selectedservice) {
            echo $catalogArray[$selectedservice] ;
          }
        }  
        else echo "N/A";
        ?>   
      </label>
               
    </div>
    <div class="form-group margin">
      <label class="col-sm-6"><span class="pull-right">Attachment Type:</span></label>
      <label class="col-sm-6"><?php echo isset($attachment['file_type'])?$vendorclass->AttachmentType->getvalue($attachment['file_type']) :'';?></label>  

    </div>
    <div class="form-group margin">
      <label class="col-sm-6 "><span class="pull-right">File:</span></label>
      <label class="col-sm-6"><?php echo $attachment['file_name'];?>
        <span>
         <a  href="javascript:void(0)" onclick="showfilecontent('<?php  echo HTTPAPPLICATIONROOT.'/'.$attachment['file_path']; ?>');" title="View" ><i class ="fa fa-eye"></i></a>|
         <a href="attachments/downloadfiles.php?filelocation=<?php  echo '/'.$attachment['file_path']; ?>"><i class ="fa fa-download"></i></a>
       </span>
     </label>          
   </div>      
   <div class="form-group margin">
    <label class="col-sm-6 "><span class="pull-right">Description:</span></label>
    <label class="col-sm-6"><?php echo $attachment['description'];?></label>          
  </div>      
</div>
</div>
</div>