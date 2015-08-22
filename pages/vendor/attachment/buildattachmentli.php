<?php
if(!isset($_SESSION)){session_start();}
if(isset($_POST['postvalue']))
  $attachmentid=$_POST['postvalue'];        
  if(empty($attachmentclass)  ){
include_once($_SERVER['DOCUMENT_ROOT']."/eventconfig.php");
$attachmentclass=new attachmentclass();  
$attachments=$attachmentclass->getallattachments($vendorid,$attachmentclass->entitytype->getkey("Vendor"));
$typeList=   $attachmentclass->attachmenttype->getlists();  
}
if(empty($attachment))
$attachment=(!empty($attachmentid))?$attachments->getattachmentbyid($attachmentid):array();
?>
<div class="box box-primary">
  <div class="box-header">
    <h3 class="box-title">Attachment</h3>
      
  </div>
  <div class="box-body"> 
    <div class="row">
      <div class="form-group margin">
        <label class="col-sm-6">Attachment Type</label>
        <label class="col-sm-4"><?php echo !empty($attachment['attachmenttype'])?$catalogArray[$attachment['attachmenttype']] :'';?></label>  
        <div class="col-sm-2">        
        <a href="javascript:void(0);"  onclick="deletelist('<?php echo $attachment['id']; ?>')" class="btn btn-primary pull-right"><i class="glyphicon  glyphicon-remove"></i></a>  
    <a href="javascript:void(0);"  onclick="editlist('<?php echo $attachment['id']; ?>')" class="btn btn-primary pull-right"><i class="glyphicon  glyphicon-edit"></i></a>
    </div> 
      </div>
      <div class="form-group margin">
        <label class="col-sm-6 ">File</label>
        <label class="col-sm-6"><?php echo $attachment['file_name'];?></label>          
      </div>      
    </div>
  </div>
</div>
