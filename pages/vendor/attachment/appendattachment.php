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
<li class="li-edit" style="display:none" id="<?php echo $attachment['id']; ?>-edit">
          <div class="box box-primary">

            <div class="box-body"> 
              <form id="<?php echo $attachment['id']; ?>-form" name="<?php echo $attachment['id']; ?>-form" class="form-horizontal" action="" method="post" novalidate="novalidate">
              <input type="hidden" id="attachmentid" name="attachmentid" value="<?php  echo $attachment['id']; ?>" />
                <div class="row">
                  <?php include VIEWFOLDER."/composeattachments.php"; ?>
                      <div class="form-group margin">
              <label>About this</label>        

            <div class='box-body pad'>              
                <textarea class="textarea" id="description" name ="description" placeholder="Place some text here" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">
                  <?php echo !empty($attachment['description'])?$attachment['description']:'';?>

                </textarea>            
        </div>
    </div>
                  </div>
                </form>              
                <div class="row">          
                  <a href="javascript:void(0);"  onclick="saveeditform('<?php echo $portfolio['id']; ?>')" class="btn btn-primary pull-right">Save</a>      
                  <a href="javascript:void(0);"  onclick="submiteditform('<?php echo $portfolio['id']; ?>')" class="btn btn-primary pull-right">Save & Continue</a>
                  <a href="javascript:void(0);" onclick="canceleditform('<?php echo $portfolio['id']; ?>');" class="btn btn-primary pull-right">Cancel</a>                        
                </div>
              
            </div>
          </div>          
        </li>
        <li class="li-non-edit" id="<?php echo $attachment['id'] ?>-non-edit">
          <?php include "buildattachmentli.php"; ?>
        </li>