<?php 
if(!isset($_SESSION)){session_start();}
if(isset($_POST['postvalue']))
  $vendorid=$_POST['postvalue'];          
include_once($_SERVER['DOCUMENT_ROOT']."/eventconfig.php");
include_once(CLASSFOLDER."/dbconnection.php");
include_once(CLASSFOLDER."/vendor.php");
$vendorclass=new vendorclass($dbconnection->dbconnector);  
include_once(CLASSFOLDER."/catalogs.php");
$catalog=new catalogclass($dbconnection->dbconnector);
$catalogArray=$catalog->GetAllCatalogValuesByMasterNames("Services");
$attachments=$vendorclass->getallvendorattachments($vendorid);
$typeList=   $vendorclass->AttachmentType->getlists();                    
?>

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
            <input type="hidden" id="vendor_id" name="vendor_id" value="<?php  echo (!empty($vendorid))?$vendorid:0; ?>" />
            <div class="row">
             <div class="form-group margin">
              <label class="col-sm-3 control-label"> Services</label>
              <div class="col-sm-8">           
                <select id="selectedservice" name="selectedservice[]" multiple="multiple" class="form-control">
                 <?php
                 if(!empty($servicecatalogs) && count($servicecatalogs)>0){
                  foreach ($servicecatalogs as $key->$value) {
                    ?>            

                    <option value="<?php echo $key ;?>"><?php echo $value ;?></option>
                    <?php }

                  }
                  ?>
                </select>
              </div>
            </div>
            <?php 
            $attachment=array();
            include VIEWFOLDER."/composeattachments.php";
            ?>
            <div class="form-group margin">
              <label class="col-sm-3 control-label">About this</label>        

              <div class="col-sm-8" >              
                <textarea class="textarea" id="description" name ="description" placeholder="Place some text here" style="width: 100%; height: 120px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">
                </textarea>            
              </div>
            </div>
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
                selecedservice: "required" ,
                oldattachment:"required",
                attachmenttype:"required",
              },
              messages: {
                selecedservice: "Please select service(s)"  ,
                oldattachment:"Please upload file",
                attachmenttype:"Please select attachment type"           
              }              
            });
          }
        }
     //when the dom has loaded setup form validation rules
    //when the dom has loaded setup form validation rules
    addmorelists=function(listclass){
      $('.'+listclass).css("display","block");
      activatemultiselects("","new-form");
      //enabletexteditor("","new-form");
    }
    editlist=function(listid){
      $('#'+listid+'-edit').css("display","block");
      $('#'+listid+'-non-edit').css("display","none");
      activatemultiselects(listid,listid+"-form");
      //enabletexteditor(listid,listid+"-form");
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
        savevendorattachments(listid,false,'pages/vendor/attachment/appendattachment.php');
      }
    }  
    savenewform= function(listid) { 
      if($('#'+listid+'-form').valid()){
        savevendorattachments(listid,true,'pages/vendor/attachment/appendattachment.php');
      }
    } 

    activatemultiselects=function(listid,formid){
      $("#"+formid +" #selectedservice").multiselect({
       includeSelectAllOption: true,
       enableCaseInsensitiveFiltering: true,
       maxHeight: 200      
     }); 
      if(listid!=""){
       f($("#hselectedservice_"+listid).attr("mulitselectvalues"))
       $("#"+formid +" #selectedservice").multiselect('select', $("#hselectedzones_"+listid).attr("mulitselectvalues").split(","));
     }
   }
   enabletexteditor=function(listid,formid){
    $("#"+formid +" .textarea").wysihtml5();
  }

  $(D).ready(function($) {   
    activatemultiselects("","new-form");
    //enabletexteditor("","new-form");       
    JQUERY4U.UTIL.setupFormValidation("new-form");
  });  
})(jQuery, window, document);

</script>