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
$statecatalogs=$catalog->GetAllCatalogValues('State'); 
$citycatalogs=$catalog->GetAllCatalogValues('City');
$catalogArray=$catalog->GetAllCatalogValuesByMasterNames("City,State");
$contactsdata=(!empty($vendorid))?$vendor->getallvendorcontactsbyvendorid($vendorid):array();
?>

<div class="row">          
  <input type="hidden" id="entityid" name="entityid" value="<?php  echo (!empty($vendorid))?$vendorid:0; ?>" />
  <a href="javascript:void(0);"  onclick="addmorelists('li-new')" class="btn btn-default pull-right"><i class="glyphicon  glyphicon-plus-sign"></i>Add More</a>      
</div>
<div>
  <ul class="list-container">
    <?php 
    if(!empty($contactsdata) && count($contactsdata)>0){
      foreach($contactsdata as $contact){
        include "appendcontact.php";   
      }  
    }
    ?>

    <li class="li-new" style="display:<?php echo (!empty($contactsdata) && count($contactsdata)>0)?'none':'';?>">
      <div class="box box-primary">
        <div class="box-header">
          <h3 class="box-title">New Contact</h3>                  
        </div>
        <div class="box-body"> 
          <form id="new-form" name="new-form" class="form-horizontal" action="" method="post" novalidate="novalidate">
            <input type="hidden" id="vendorid" name="vendorid" value="<?php  echo (!empty($vendorid))?$vendorid:0; ?>" />
            <div class="row">
              <div class="form-group margin">
                <label class="col-sm-3 control-label"><span class="text-error">*</span>Contact Person</label>
                <div class="col-sm-6" >
                  <input type="text"  id="contactperson" name="contactperson" maxlength="25" placeholder="Contact Person" class="form-control" >
                </div>
              </div>
              <div class="form-group margin">
                <label class="col-sm-3 control-label"><span class="text-error">*</span>Title</label>
                <div class="col-sm-6" >
                  <input type="text"  id="title" name="title" maxlength="25" placeholder="Title" class="form-control" >
                </div>
              </div>

              <div class="form-group margin">
                <label class="col-sm-3 control-label"><span class="text-error">*</span>Contact Number</label>
                <div class="col-sm-6" >
                  <input type="text"  id="contactnumber1" name="contactnumber1" maxlength="55" placeholder="Contact Number1" class="form-control" >
                </div>
              </div>

              <div class="form-group margin">
                <label class="col-sm-3 control-label"><span class="text-error">*</span>Office  Number</label>
                <div class="col-sm-6" >
                  <input type="text"  id="officenumber" name="officenumber" maxlength="55" placeholder="Office Number" class="form-control" >
                </div>
              </div>
              <div class="form-group margin">
                <label class="col-sm-3 control-label"><span class="text-error">*</span>Address</label>
                <div class="col-sm-6" >
                  <input type="text"  id="address1" name="address1"  maxlength="100" placeholder="Address" class="form-control" >
                </div>
              </div>


              <div class="form-group margin">
                <label class="col-sm-3 control-label">State</label>
                <div class="col-sm-6" >
                  <select id="city" name="city" class="form-control" onchange="loaddependentcombo('city','state');">
                   <?php
                   if(!empty($statecatalogs) && count($statecatalogs)>0){
                    foreach ($statecatalogs as $state) {
                      ?>            
                      <option value="<?php echo $state['id'] ;?>"><?php echo $state['catalog_value'] ;?></option>
                      <?php }
                    }
                    ?>
                  </select>
                </div>
              </div>
              <div class="form-group margin">
                <label class="col-sm-3 control-label">City</label>
                <div class="col-sm-6" >
                  <select id="state" name="state" class="form-control">
                   <?php
                   if(!empty($citycatalogs) && count($citycatalogs)>0){
                    foreach ($citycatalogs as $city) {
                      ?>            
                      <option value="<?php echo $city['id'] ;?>"><?php echo $city['catalog_value'] ;?></option>
                      <?php }
                    }
                    ?>
                  </select>
                </div>
              </div>
              <div class="form-group margin">
                <label class="col-sm-3 control-label"><span class="text-error">*</span>Pin Code</label>
                <div class="col-sm-6" >
                  <input type="text"  id="pincode" name="pincode"  maxlength="100" placeholder="Address2" class="form-control" >
                </div>
              </div>
            </div>
            <div class="row">          
              <a href="javascript:void(0);" onclick="savenewcontact('new');" class="btn btn-default pull-right">Save</a>      
              <a href="javascript:void(0);"  onclick="submitnewcontact('new');" class="btn btn-default pull-right">Save & Continue</a>
              <a href="javascript:void(0);"  onclick="cancelnewform('new');" class="btn btn-default pull-right">Cancel</a>                        
            </div>
          </form>
        </div>
      </div>      
    </li>
  </ul>  
  <div class="row">
    <a href="javascript:void(0);"  onclick="getwizardcontents('pages/vendor/vendorbasics.php','wizardcontent')" class="btn btn-default "><i class="glyphicon  glyphicon-next"></i>Previous</a>                          
    <a href="javascript:void(0);"  onclick="getwizardcontents('pages/vendor/portfolio/','wizardcontent')" class="btn btn-default pull-right"><i class="glyphicon  glyphicon-next"></i>Next</a>                          
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
                title: "required",
                contactperson: "required",
                contactnumber1: "required",
                city: "required"
              },
              messages: {
                title: "Please enter contact title",
                contactperson: "Please enter contact name",
                contactnumber1: "please enter atleaset atleaset one contact number",
                city: "please select city"

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
        savevendorcontactdetails(listid,false,"",'pages/vendor/contact/buildcontactli.php');
      }
    }
    submiteditform=function(listid){
      if($('#'+listid+'-form').valid()){
        savevendorcontactdetails(listid,false,'pages/vendor/portfolio/index.php');
      }
    }
    savenewcontact= function(listid) { 
      if($('#'+listid+'-form').valid()){
        savevendorcontactdetails(listid,true,"",'pages/vendor/contact/appendcontact.php');
      }
    } 
    submitnewcontact= function(listid){ 
      if($('#'+listid+'-form').valid()){
        savevendorcontactdetails(listid,true,'pages/vendor/portfolio/index.php');
      }
    }
    $(D).ready(function($) {         
      JQUERY4U.UTIL.setupFormValidation("new-form");
  });  
  })(jQuery, window, document);

</script>