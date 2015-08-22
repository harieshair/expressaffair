<?php 
if(!isset($_SESSION)){session_start();}
if(isset($_POST['postvalue']))
  $vendorid=$_POST['postvalue'];          
include_once($_SERVER['DOCUMENT_ROOT']."/eventconfig.php");
include_once(CLASSFOLDER."/vendor.php");
$vendor=new vendorclass();   
include_once(CLASSFOLDER."/catalogs.php");
$catalog=new catalogclass();          
$locationcatalogs=$catalog->GetAllCatalogValues('City'); 
$yearcatalogs=$catalog->GetAllCatalogValues('Year'); 
$vendordata=(!empty($vendorid))?$vendor->getvendorbyid($vendorid):array();
?>
<style type="text/css">
  #update-vendorbasics .form-group label.error {
    color: #FB3A3A;
    display: inline-block;   
    text-align: left;    
  }
</style>

<form  id="update-vendorbasics" name="update-vendorbasics" class="form-horizontal" action="" method="post" novalidate="novalidate">
  <input type="hidden" id="vendorid" name="vendorid" value="<?php  echo (!empty($vendorid))?$vendorid:0; ?>" />
  <input type="hidden" id="entityid" name="entityid" value="<?php  echo (!empty($vendorid))?$vendorid:0; ?>" />
  <div class="box box-primary">
    <div class="box-body"> 
      <div class="row">

        <div class="form-group margin">
          <label class="col-sm-3 control-label"><span class="text-error">*</span>Name</label>
          <div class="col-sm-8" >
            <input type="text"  id="name" name="name" value="<?php echo !empty($vendordata['name'])?$vendordata['name']:'';?>" maxlength="25" placeholder="Name" class="form-control" >
          </div>
        </div>
        <div class="form-group margin">
          <label class="col-sm-3 control-label"><span class="text-error">*</span>Title</label>
          <div class="col-sm-8" >
            <input type="text"  id="title" name="title" value="<?php echo !empty($vendordata['title'])?$vendordata['title']:'';?>" maxlength="25" placeholder="Name" class="form-control" >
          </div>
        </div>

        <div class="form-group margin">
          <label class="col-sm-3 control-label"><span class="text-error">*</span>Email</label>
          <div class="col-sm-8" >
            <input type="text"  id="email" name="email" value="<?php echo !empty($vendordata['email'])?$vendordata['email']:'';?>" maxlength="55" placeholder="Email" class="form-control" >
          </div>
        </div>

        <div class="form-group margin">
          <label class="col-sm-3 control-label">Located At</label>
          <div class="col-sm-8" >
            <select id="location" name="location" class="form-control">
             <?php
             if(!empty($locationcatalogs) && count($locationcatalogs)>0){
              foreach ($locationcatalogs as $location) {
                ?>            
                <option value="<?php echo $location['id'] ;?>"><?php echo $location['catalog_value'] ;?></option>
                <?php }

              }
              ?>
            </select>
          </div>
        </div>
        <div class="form-group margin">
          <label class="col-sm-3 control-label">Leading By</label>
          <div class="col-sm-8" >
            <input type="text"  id="leadby" name="leadby" value="<?php echo !empty($vendordata['leadby'])?$vendordata['leadby']:'';?>" 
            maxlength="55" placeholder="Contact Person" class="form-control" >
          </div>
        </div>
        <div class="form-group margin">
          <label class="col-sm-3 control-label">Since</label>
          <div class="col-sm-8" >
            <select id="startedyear" name="startedyear" class="form-control">
             <?php
             if(!empty($yearcatalogs) && count($yearcatalogs)>0){
              foreach ($yearcatalogs as $yearcatalog) {
                ?>            
                <option value="<?php echo $yearcatalog['id'] ;?>"><?php echo $yearcatalog['catalog_value'] ;?></option>
                <?php }

              }
              ?>
            </select>
          </div>
        </div>

      </div> 
      <div class="row">  
        <a href="javascript:void(0);"  id="submitbutton" class="btn btn-primary pull-right">Submit</a>     
        <a href="javascript:void(0);"  id="saveandcontinuebutton" class="btn btn-primary pull-right">Save & Continue</a>
        <a href="javascript:void(0);" onclick="resetform('update-vendorbasics');" class="btn btn-primary pull-right">Reset</a>                        
      </div>
    </div> 
  </div>     
</form>
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
                name: "required",
                title:"required",
                email: {
                  required: true,
                  email: true
                }
              },
              messages: {
                name: "Please enter valid Vendor name",
                email: "Please enter a valid email address" ,
                title:"Please enter valid title"          
              }
            });
          }
        }
    //when the dom has loaded setup form validation rules
    $(D).ready(function($) {         
     JQUERY4U.UTIL.setupFormValidation();     
     $('#submitbutton').on('click', function(){ 
      if($('#update-vendorbasics').valid()){
        savevendorbasicdetails();
      }
    });  
      $('#saveandcontinuebutton').on('click', function(){ 
      if($('#update-vendorbasics').valid()){
        savevendorbasicdetails("pages/vendor/contacts.php");
      }
    });   
     
 });

  })(jQuery, window, document);
</script>