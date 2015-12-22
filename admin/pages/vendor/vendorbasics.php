<?php 
if(empty($vendor)){
  $vendorid=isset($_POST['postvalue'])?$_POST['postvalue']:null;          
  include_once($_SERVER['DOCUMENT_ROOT']."/eventconfig.php");
  include_once(CLASSFOLDER."/dbconnection.php");
  include_once(CLASSFOLDER."/vendor.php");
  $vendor=new vendorclass($dbconnection->dbconnector);   
  include_once(CLASSFOLDER."/catalogs.php");
  $catalog=new catalogclass($dbconnection->dbconnector);          
  $citycatalogs=$catalog->GetAllCatalogValues('City'); 
  $statecatalogs=$catalog->GetAllCatalogValues('State'); 
  $vendordata=(!empty($vendorid))?$vendor->getvendorbyid($vendorid):array();
  $catalogArray=array();
}
?>

<div>
  <ul class="list-container">
   <li class="li-edit" style="display:<?php echo (!empty($vendordata))?'none':'';?>">
    <div class="box box-primary">
      <div class="box-body"> 
        <form  id="update-vendorbasics" name="update-vendorbasics" class="form-horizontal" action="" method="post" novalidate="novalidate">
          <input type="hidden" id="vendorid" name="vendorid" value="<?php  echo (!empty($vendorid))?$vendorid:0; ?>" />
          <input type="hidden" id="entityid" name="entityid" value="<?php  echo (!empty($vendorid))?$vendorid:0; ?>" />
          <div class="row">
            <div class="form-group margin">
              <label class="col-sm-3 control-label"><span class="text-error">*</span>Title</label>
              <div class="col-sm-8" >
                <input type="text"  id="title" name="title" value="<?php echo !empty($vendordata['title'])?$vendordata['title']:'';?>" maxlength="25" placeholder="Name" class="form-control" >
              </div>
            </div>
            <div class="form-group margin">
              <label class="col-sm-3 control-label"><span class="text-error">*</span>Contact Person</label>
              <div class="col-sm-8" >
                <input type="text"  id="contactperson" name="contactperson" value="<?php echo $vendordata['contact_person'];?>" maxlength="25" placeholder="Contact Person" class="form-control" >
              </div>
            </div>

            <div class="form-group margin">
              <label class="col-sm-3 control-label"><span class="text-error">*</span>Mail Id</label>
              <div class="col-sm-8" >
                <input type="text"  id="email" name="email" value="<?php echo !empty($vendordata['email'])?$vendordata['email']:'';?>" maxlength="55" placeholder="Email" class="form-control" >
              </div>
            </div>
            <div class="form-group margin">
              <label class="col-sm-3 control-label"><span class="text-error">*</span>Contact Number1</label>
              <div class="col-sm-8" >
                <input type="text"  id="contactnumber1" name="contactnumber1" value="<?php echo $vendordata['contact_number1'];?>" maxlength="55" placeholder="Contact Number1" class="form-control" >
              </div>
            </div>
            <div class="form-group margin">
              <label class="col-sm-3 control-label"><span class="text-error">*</span>Contact  Number2</label>
              <div class="col-sm-8" >
                <input type="text"  id="officenumber" name="officenumber" value="<?php echo $vendordata['contact_number2'];?>" maxlength="55" placeholder="Office Number" class="form-control" >
              </div>
            </div>
            <div class="form-group margin">
              <label class="col-sm-3 control-label">State</label>
              <div class="col-sm-8" >
                <select id="city" name="city" class="form-control" onchange="loaddependentcombo('city','state');">
                 <?php
                 if(!empty($statecatalogs) && count($statecatalogs)>0){
                  foreach ($statecatalogs as $state) {
                    $catalogArray[$state['id']]=$state['catalog_value'];
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
              <div class="col-sm-8" >
                <select id="state" name="state" class="form-control">
                 <?php
                 if(!empty($citycatalogs) && count($citycatalogs)>0){
                  foreach ($citycatalogs as $city) {
                    $catalogArray[$city['id']]=$city['catalog_value'];
                    ?>            
                    <option value="<?php echo $city['id'] ;?>"><?php echo $city['catalog_value'] ;?></option>
                    <?php }
                  }
                  ?>
                </select>
              </div>
            </div>
            <div class="form-group margin">
              <label class="col-sm-3 control-label"><span class="text-error">*</span>Address1</label>
              <div class="col-sm-8" >
                <input type="text"  id="address1" name="address1" value="<?php echo $vendordata['address1'];?>" maxlength="100" placeholder="Address1" class="form-control" >
              </div>
            </div>
            <div class="form-group margin">
              <label class="col-sm-3 control-label"><span class="text-error">*</span>Pin Code</label>
              <div class="col-sm-6" >
                <input type="text"  id="pincode" name="pincode"  maxlength="100" placeholder="pincode" class="form-control" >
              </div>
            </div>
          </div>

          <div class="row">  
            <a href="javascript:void(0);"  id="submitbutton" class="btn btn-default pull-right">Submit</a>     
            <a href="javascript:void(0);"  id="saveandcontinuebutton" class="btn btn-default pull-right">Save & Continue</a>
            <a href="javascript:void(0);" onclick="resetform('update-vendorbasics');" class="btn btn-default pull-right">Reset</a>                        
          </div>     
        </form>
      </div> 
    </div>  
  </li>

  <li class="li-view" style="display:<?php echo (empty($vendordata))?'none':'';?>">

    <div class="box box-primary">
      <div class="box-header">
        <h3 class="box-title"><?php echo !empty($vendordata['title'])?$vendordata['title']:'';?></h3>
        <a href="javascript:void(0);"  onclick="editlist()" class="btn btn-box-tool pull-right"><i class="fa fa-edit"></i></a>      
      </div>
      <div class="box-body"> 
        <div class="row">
         <div class="form-group margin">
          <label class="col-sm-6 "><span class="pull-right">Contact Person:</span></label>
          <label class="col-sm-6"><?php echo $vendordata['contact_person'];?></label>          
        </div>
        <div class="form-group margin">
         <label class="col-sm-6"><span class="pull-right">Mail Id:</span></label>
         <label class="col-sm-6"><?php echo !empty($vendordata['email'])?$vendordata['email']:'';?></label>
       </div>

       <div class="form-group margin">
        <label class="col-sm-6 "><span class="pull-right">Contact Number1:</span></label>
        <label class="col-sm-6"><?php echo $vendordata['contact_number1'];?></label>          
      </div>

      <div class="form-group margin">
        <label class="col-sm-6 "><span class="pull-right">Contact Number2:</span></label>
        <label class="col-sm-6"><?php echo $vendordata['contact_number2'];?></label>          
      </div>

      <div class="form-group margin">
        <label class="col-sm-6 "><span class="pull-right">State:</span></label>
        <label class="col-sm-6"><?php echo !empty($vendordata['state'])?$catalogArray[$vendordata['state']] :'';?></label>          
      </div>  
      <div class="form-group margin">
        <label class="col-sm-6"><span class="pull-right">City:</span></label>
        <label class="col-sm-6"><?php echo !empty($vendordata['city'])?$catalogArray[$vendordata['city']] :'';?></label>          
      </div>

      <div class="form-group margin">
        <label class="col-sm-6 "><span class="pull-right">Address:</span></label>
        <label class="col-sm-6"><?php echo $vendordata['address1'];?></label>          
      </div>   
      <div class="form-group margin">
        <label class="col-sm-6 "><span class="pull-right">Pin Code:</span></label>
        <label class="col-sm-6"><?php echo $vendordata['pincode'];?></label>          
      </div>

    </div>
  </div>
</div>
</li>
</ul>
<div class="row">
 <a href="javascript:void(0);"  onclick="getwizardcontents('pages/vendor/services/','wizardcontent')" class="btn btn-default pull-right"><i class="glyphicon  glyphicon-next"></i>Next</a>                          
</div>
</div>

<script type="text/javascript">

 (function($,W,D)
 {
   var JQUERY4U = {};

   JQUERY4U.UTIL =
   {
    setupFormValidation: function()
    {
            //form validation rules
            $("#update-vendorbasics").validate({
              rules: {
                title:"required",
                email: {
                  required: true,
                  email: true
                },
                contactperson: "required",
                contactnumber1: "required",
                city: "required"
              },
              messages: {
                name: "Please enter valid Vendor name",
                email: "Please enter a valid email address" ,
                title:"Please enter valid title" ,
                contactperson: "Please enter contact name",
                contactnumber1: "please enter atleaset atleaset one contact number",
                city: "please select city"        
              }
            });
          }
        } 

        editlist=function(){
          $('.li-view').css("display","none");
          $('.li-edit').css("display","");
        }
    //when the dom has loaded setup form validation rules
    $(D).ready(function($) {         
     JQUERY4U.UTIL.setupFormValidation();     
     $('#submitbutton').on('click', function(){ 
      if($('#update-vendorbasics').valid()){
        savevendorbasicdetails("pages/vendor/vendorbasics.php");
      }
    });  
     $('#saveandcontinuebutton').on('click', function(){ 
      if($('#update-vendorbasics').valid()){
        savevendorbasicdetails("pages/vendor/services/");
      }
    });   
     
   });

  })(jQuery, window, document);
</script>