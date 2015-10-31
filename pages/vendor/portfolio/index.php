<?php 
if(!isset($_SESSION)){session_start();}
if(isset($_POST['postvalue']))
  $vendorid=$_POST['postvalue'];          
include_once($_SERVER['DOCUMENT_ROOT']."/eventconfig.php");
include_once(CLASSFOLDER."/dbconnection.php");
include_once(CLASSFOLDER."/vendor.php");
$vendor=new vendorclass($dbconnection->dbconnector);   
include_once(CLASSFOLDER."/catalogs.php");
$catalog=new catalogclass($dbconnection->dbconnector);          
$catalogArray=$catalog->GetAllCatalogValuesByMasterNames("PortfolioType");
$portfoliodata=(!empty($vendorid))?$vendor->getallvendorportfolio($vendorid):array();
?>

<div class="row">          
  <input type="hidden" id="entityid" name="entityid" value="<?php  echo (!empty($vendorid))?$vendorid:0; ?>" />
  <a href="javascript:void(0);"  onclick="addmorelists('li-new')" class="btn btn-default pull-right"><i class="glyphicon  glyphicon-plus-sign"></i>Add More</a>      
</div>
<div>
  <ul class="list-container">
    <?php 
    if(!empty($portfoliodata) && count($portfoliodata)>0){
      foreach($portfoliodata as $portfolio){
        include "appendportfolio.php";   
      }  
    }
    ?>

    <li class="li-new" style="display:<?php echo (!empty($portfoliodata) && count($portfoliodata)>0)?'none':'';?>">
      <div class="box box-primary">
        <div class="box-header">
          <h3 class="box-title">New Portfolio</h3>                  
        </div>
        <div class="box-body"> 
          <form id="new-form" name="new-form" class="form-horizontal" action="" method="post" novalidate="novalidate">
            <input type="hidden" id="vendorid" name="vendorid"  value="<?php  echo (!empty($vendorid))?$vendorid:0; ?>"  />
            <div class="row">
              <div class="form-group margin">
                <label class="col-sm-3 control-label"><span class="text-error">*</span>Portfolio Type</label>
                <div class="col-sm-8" >
                  <select id="portfoliotype" name="portfoliotype" class="form-control">
                   <?php
                   if(!empty($portfoliocatalog) && count($portfoliocatalog)>0){
                    foreach ($portfoliocatalog as $key->$value) {
                      ?>            
                      <option value="<?php echo $key;?>"><?php echo $value ;?></option>
                      <?php }
                    }
                    ?>
                  </select>
                </div>
              </div>
              <div class="form-group margin">
                <label class="col-sm-3 control-label"><span class="text-error">*</span>Link</label>
                <div class="col-sm-8" >
                  <input type="text"  id="link" name="link"  maxlength="25" placeholder="Title" class="form-control" >
                </div>
              </div>
              <div class="form-group margin">
                <label class="col-sm-3 control-label"><span class="text-error">*</span>About Us</label>
                <div class="col-sm-8" >
                  <input type="text"  id="aboutus" name="aboutus"  maxlength="25" placeholder="Title" class="form-control" >
                </div>
              </div>                 
              </div>            
            <div class="row">          
              <a href="javascript:void(0);" onclick="savenewform('new');" class="btn btn-default pull-right">Save</a>      
              <a href="javascript:void(0);"  onclick="submitnewform('new');" class="btn btn-default pull-right">Save & Continue</a>
              <a href="javascript:void(0);"  onclick="cancelnewform('new');" class="btn btn-default pull-right">Cancel</a>                        
            </div>
          </form>
        </div>
      </div>
    </li>
</ul>  
<div class="row">
<a href="javascript:void(0);"  onclick="getwizardcontents('pages/vendor/contact/','wizardcontent')" class="btn btn-default "><i class="glyphicon  glyphicon-next"></i>Previous</a>                          
  <a href="javascript:void(0);"  onclick="getwizardcontents('pages/vendor/services/','wizardcontent')" class="btn btn-default pull-right"><i class="glyphicon  glyphicon-next"></i>Next</a>                          
  <a href="javascript:void(0);"  onclick="addmorelists('li-new')" class="btn btn-default pull-right"><i class="glyphicon  glyphicon-plus-sign"></i>Add More</a>      
  
</div>
</div> 

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
    //when the dom has loaded setup form validation rules
    addmorelists=function(listclass){
      $('.'+listclass).css("display","block");
      adjustwizardleftpanelsize();
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
      adjustwizardleftpanelsize();
    }
    saveeditform=function(listid){
      if($('#'+listid+'-form').valid()){
        savevendorportfoliodetails(listid,false,"",'pages/vendor/portfolio/buildportfolioli.php');
      }
    }
    submiteditform=function(listid){
      if($('#'+listid+'-form').valid()){
        savevendorportfoliodetails(listid,false,'pages/vendor/services/index.php');
      }
    }
    savenewform= function(listid) { 
      if($('#'+listid+'-form').valid()){
        savevendorportfoliodetails(listid,true,"",'pages/vendor/portfolio/appendportfolio.php');
      }
    } 
    submitnewform= function(listid){ 
      if($('#'+listid+'-form').valid()){
        savevendorportfoliodetails(listid,true,'pages/vendor/services/index.php');
      }
    }
    $(D).ready(function($) {         
      JQUERY4U.UTIL.setupFormValidation("new-form");
    });  
  })(jQuery, window, document);

</script>