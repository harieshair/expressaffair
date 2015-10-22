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
$locationcatalogs=$catalog->GetAllCatalogValues('City'); 
$vendordata=(!empty($vendorid))?$vendor->getvendorbyid($vendorid):array();
?>

<div>
  <ul class="list-container">
    <li class="li-view" style="display:<?php echo (empty($vendordata))?'none':'';?>">

      <div class="box box-primary">
        <div class="box-header">
          <h3 class="box-title"><?php echo !empty($vendordata['title'])?$vendordata['title']:'';?></h3>
          <a href="javascript:void(0);"  onclick="editlist()" class="btn btn-box-tool pull-right"><i class="fa fa-edit"></i></a>      
        </div>
        <div class="box-body"> 
          <div class="row">
            <div class="form-group margin">
              <label class="col-sm-6"><span class="pull-right">Name:</span></label>
              <label class="col-sm-6"><?php echo !empty($vendordata['name'])?$vendordata['name']:'';?></label>
            </div>
            <div class="form-group margin">
             <label class="col-sm-6"><span class="pull-right">Mail Id:</span></label>
             <label class="col-sm-6"><?php echo !empty($vendordata['email'])?$vendordata['email']:'';?></label>
           </div>

         </div>
       </div>
     </div>
   </li>

   <li class="li-edit" style="display:<?php echo (!empty($vendordata))?'none':'';?>">
    <div class="box box-primary">
      <div class="box-body"> 
        <form  id="update-vendorbasics" name="update-vendorbasics" class="form-horizontal" action="" method="post" novalidate="novalidate">
          <input type="hidden" id="vendorid" name="vendorid" value="<?php  echo (!empty($vendorid))?$vendorid:0; ?>" />
          <input type="hidden" id="entityid" name="entityid" value="<?php  echo (!empty($vendorid))?$vendorid:0; ?>" />
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
              <label class="col-sm-3 control-label"><span class="text-error">*</span>Mail Contact</label>
              <div class="col-sm-8" >
                <input type="text"  id="email" name="email" value="<?php echo !empty($vendordata['email'])?$vendordata['email']:'';?>" maxlength="55" placeholder="Email" class="form-control" >
              </div>
            </div>

        <!--<div class="form-group margin">
          <label class="col-sm-3 control-label">Located</label>
          <div class="col-sm-8" >
            <select id="location" name="location" class="form-control">
             <?php
             //if(!empty($locationcatalogs) && count($locationcatalogs)>0){
              //foreach ($locationcatalogs as $location) {
                ?>            
                <option value="<?php echo $location['id'] ;?>"><?php echo $location['catalog_value'] ;?></option>
                <?php //}  }   ?>
            </select>
          </div>
        </div>-->

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
</ul>
<div class="row">
 <a href="javascript:void(0);"  onclick="getwizardcontents('pages/vendor/contact/','wizardcontent')" class="btn btn-default pull-right"><i class="glyphicon  glyphicon-next"></i>Next</a>                          
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
        savevendorbasicdetails("pages/vendor/contact/");
      }
    });   
     
   });

  })(jQuery, window, document);
</script>