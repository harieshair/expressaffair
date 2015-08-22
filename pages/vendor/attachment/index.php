<?php 
if(!isset($_SESSION)){session_start();}
if(isset($_POST['postvalue']))
  $vendorid=$_POST['postvalue'];          
include_once($_SERVER['DOCUMENT_ROOT']."/eventconfig.php");
include_once(CLASSFOLDER."/attachments.php");
$attachmentclass=new attachmentclass();  
$attachments=$attachmentclass->getallattachments($vendorid,$attachmentclass->entitytype->getkey("Vendor"));
$typeList=   $attachmentclass->attachmenttype->getlists();
?>
<style type="text/css">
  .form-group label.error {
    color: #FB3A3A;
    display: inline-block;   
    text-align: left;    
  }
</style>
<div class="row">          
  <input type="hidden" id="entityid" name="entityid" value="<?php  echo (!empty($vendorid))?$vendorid:0; ?>" />
  <a href="javascript:void(0);"  onclick="addmorelists('li-new')" class="btn btn-default pull-right"><i class="glyphicon  glyphicon-plus-sign"></i>Add More</a>      
</div>
<div>
  <ul class="list-container">
    <?php 
    if(!empty($attachments) && count($attachments)>0){
      foreach($attachments as $attachment){
        include "appendattachment.php";   
      }  
    }
    ?>

    <li class="li-new" style="display:<?php echo (!empty($attachments) && count($attachments)>0)?'none':'';?>">
      <div class="box box-primary">
        <div class="box-header">
          <h3 class="box-title">New Attachment</h3>                  
        </div>
        <div class="box-body"> 
          <form id="new-form" name="new-form" class="form-horizontal" action="" method="post" novalidate="novalidate">
            <input type="hidden" id="vendorid" name="vendorid"  />
            <div class="row">
            <?php 
            $attachment=array();
             include VIEWFOLDER."/composeattachments.php";
             ?>
              
              </div>            
            <div class="row">          
              <a href="javascript:void(0);" onclick="savenewform('new');" class="btn btn-default pull-right">Save</a>      
              <a href="javascript:void(0);"  onclick="cancelnewform('new');" class="btn btn-default pull-right">Cancel</a>                        
            </div>
          </form>
        </div>
      </div>
    </li>
</ul>  
<div class="row">
  <a href="javascript:void(0);"  onclick="getwizardcontents('pages/vendor/services/index.php','wizardcontent')" class="btn btn-default"><i class="glyphicon  glyphicon-next"></i>Previous</a>                          
  <a href="javascript:void(0);"  onclick="addmorelists('li-new')" class="btn btn-default pull-right"><i class="glyphicon  glyphicon-plus-sign"></i>Add More</a>      
  
</div>
</div> 
<script src="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js" type="text/javascript"></script>
<script type="text/javascript">
  (function($,W,D)
  {
    var JQUERY4U = {};

    JQUERY4U.UTIL =
    {
      setupFormValidation: function(formid)
      {
            //form validation rules
            $('#'+formid).validate({
              rules: {
                aboutus: "required"                
              },
              messages: {
                aboutus: "Please enter about us"               
              }              
            });
          }
        }
    addmorelists=function(listclass){
      $('.'+listclass).css("display","block");
    }
    editlist=function(listid){
      $('#'+listid+'-edit').css("display","block");
      $('#'+listid+'-non-edit').css("display","none");
      JQUERY4U.UTIL.setupFormValidation(listid+"-form");  
    }
    canceleditform=function(listid){
      resetform(listid+'-form');
      $('#'+listid+'-edit').css("display","none");
      $('#'+listid+'-non-edit').css("display","block");       
    }
    cancelnewform=function(listid){
      resetform(listid+'-form');
      $('.li-new').css("display","none");
    }
    saveeditform=function(listid){
      if($('#'+listid+'-form').valid()){
        savevendorattachments(listid,false,"",'pages/vendor/attachment/buildportfolioli.php');
      }
    }
    savenewform= function(listid) { 
      if($('#'+listid+'-form').valid()){
        savevendorattachments(listid,true,"",'pages/vendor/attachment/appendportfolio.php');
      }
    } 

    $(D).ready(function($) {         
      JQUERY4U.UTIL.setupFormValidation("new-form");
    });  
  })(jQuery, window, document);

</script>