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
$zonecatalogs=$catalog->GetAllCatalogValues('Zone');
$locationcatalogs=$catalog->GetAllCatalogValues('City'); 
$servicecatalogs=$catalog->GetAllCatalogValues('Services');
$categoryCatalogs=$catalog->GetAllCatalogValues('Service Category');
if(!empty($statecatalogs) && count($statecatalogs)>0){
  foreach($statecatalogs as $catalog)
    $catalogArray[$catalog['id']]=$catalog['catalog_value'];
}
if(!empty($zonecatalogs) && count($zonecatalogs)>0){
  foreach($zonecatalogs as $catalog)
    $catalogArray[$catalog['id']]=$catalog['catalog_value'];
}
if(!empty($locationcatalogs) && count($locationcatalogs)>0){
  foreach($locationcatalogs as $catalog)
    $catalogArray[$catalog['id']]=$catalog['catalog_value'];
}
if(!empty($servicecatalogs) && count($servicecatalogs)>0){
  foreach($servicecatalogs as $catalog)
    $catalogArray[$catalog['id']]=$catalog['catalog_value'];
}
if(!empty($categoryCatalogs) && count($categoryCatalogs)>0){
  foreach($categoryCatalogs as $catalog)
    $catalogArray[$catalog['id']]=$catalog['catalog_value'];
}
                  
$servicedata=(!empty($vendorid))?$vendor->getAllVendorServicesByVendorId($vendorid):array();
?>

<div class="row">          
  <input type="hidden" id="entityid" name="entityid" value="<?php  echo (!empty($vendorid))?$vendorid:0; ?>" />
  <a href="javascript:void(0);"  onclick="addmorelists('li-new')" class="btn btn-default pull-right"><i class="glyphicon  glyphicon-plus-sign"></i>Add More</a>      
</div>
<div>
  <ul class="list-container">
    <?php 
    if(!empty($servicedata) && count($servicedata)>0){
      foreach($servicedata as $service){
        include "appendservice.php";   
      }  
    }
    ?>

    <li class="li-new" style="display:<?php echo (!empty($servicedata) && count($servicedata)>0)?'none':'';?>">
      <div class="box box-primary">
        <div class="box-header">
          <h3 class="box-title">New Service</h3>                  
        </div>
        <div class="box-body"> 

          <form id="new-form" name="new-form" class="form-horizontal" action="" method="post" novalidate="novalidate">
            <input type="hidden" id="vendor_id" name="vendor_id"value="<?php  echo (!empty($vendorid))?$vendorid:0; ?>"    />
            <div class="row">
              <div class="col-sm-6">
               <div class="margin">
                <label><span class="text-error">*</span>Title</label>

                <input type="text"  id="title" name="title"  maxlength="25" placeholder="Title" class="form-control">

              </div>
            </div>
            <div class="col-sm-6">
              <div class="margin">
                <label > Service</label>

                <input type="hidden" id="hselectedservice_"   mulitselectvalues="">
                <select id="selectedservice" name="selectedservice" class="form-control">
                 <?php
                 if(!empty($servicecatalogs) && count($servicecatalogs)>0){
                  foreach ($servicecatalogs as $servicecatalog) {
                    ?>            

                    <option value="<?php echo $servicecatalog['id'] ;?>"><?php echo $servicecatalog['catalog_value'] ;?></option>
                    <?php }

                  }
                  ?>
                </select>

              </div>
            </div>
            <div class="col-sm-6">

              <div class="margin">
                <label class="control-label"> Location</label>

                <select id="selectedlocation" name="selectedlocation[]" multiple="multiple" class="form-control">
                 <?php
                 if(!empty($locationcatalogs) && count($locationcatalogs)>0){
                  foreach ($locationcatalogs as $locationcatalog) {                          ?>            

                  <option value="<?php echo $locationcatalog['id'] ;?>"><?php echo $locationcatalog['catalog_value'] ;?></option>
                  <?php }

                }
                ?>
              </select>

            </div>


            <div class="margin">
              <label > State</label>


              <select id="selectedstate" name="selectedstate[]" multiple="multiple" class="form-control">
               <?php
               if(!empty($statecatalogs) && count($statecatalogs)>0){
                foreach ($statecatalogs as $statecatalog) {
                  ?>            

                  <option value="<?php echo $statecatalog['id'] ;?>"><?php echo $statecatalog['catalog_value'] ;?></option>
                  <?php }

                }
                ?>
              </select>
            </div>
            <div class="margin">
              <label > Zone</label>
              
              <select id="selectedzone" name="selectedzone[]" multiple="multiple" class="form-control">
               <?php
               if(!empty($zonecatalogs) && count($zonecatalogs)>0){
                foreach ($zonecatalogs as $zonecatalog) {
                  ?>            

                  <option value="<?php echo $zonecatalog['id'] ;?>"><?php echo $zonecatalog['catalog_value'] ;?></option>
                  <?php }

                }
                ?>
              </select>
            </div>
            

          </div>
          <div class="col-sm-6">
            <div class="margin">
              <label class="control-label"> Description</label>
              <textarea id="description" name="description" style="height: 175px;" class="form-control"> </textarea>
            </div>
          </div>  
          <div class="col-sm-6">
            <div class="margin">
              <label class="control-label">Service Images</label>
              <input type="hidden" value="0" name="file_type" id="file_type_0">
              <input type="file" name="attachment_0" id="attachment_0"  onchange="uploadfiles('0');">
              <input type="hidden" value="" name="file_name" id="file_name_0"><br>            
              <div id="divexistingfile_0"  class="fileclass"> 
              </div>
            </div>
          </div> 
          <div class="col-sm-6">
            <div class="margin">
              <label class="control-label"> Price</label>
              <input type="text" id="price" name="price" class="form-control"/>
            </div>
          </div>
           <div class="col-sm-6">
            <div class="margin">
              <label class="control-label">Service Category</label>
              <select id="category" name="category" class="form-control">
               <?php
               if(!empty($categoryCatalogs) && count($categoryCatalogs)>0){
                foreach ($categoryCatalogs as $categoryCatalog) {
                  ?>            

                  <option value="<?php echo $categoryCatalog['id'] ;?>"><?php echo $categoryCatalog['catalog_value'] ;?></option>
                  <?php }

                }
                ?>
              </select>
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
 <a href="javascript:void(0);"  onclick="getwizardcontents('pages/vendor/portfolio/','wizardcontent')" class="btn btn-default "><i class="glyphicon  glyphicon-next"></i>Previous</a>                          
 <a href="javascript:void(0);"  onclick="getwizardcontents('pages/vendor/attachment/','wizardcontent')" class="btn btn-default pull-right"><i class="glyphicon  glyphicon-next"></i>Next</a>                          
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
      $('#'+formid).validate({
        rules: {
          title: "required",
          selectedevent:"required",
          selectedservice:"required",

        },
        messages: {
          title: "Please provid title to this service"   ,        
          selectedevent: "Please select required events",
          selectedservice: "Please select service(s)",
        }              
      });
    }
  }
    //when the dom has loaded setup form validation rules
    //when the dom has loaded setup form validation rules
    addmorelists=function(listclass){
      $('.'+listclass).css("display","block");
      activatemultiselects("","new-form");
      adjustwizardleftpanelsize();
    }
    editlist=function(listid){
      $('#'+listid+'-edit').css("display","block");
      $('#'+listid+'-non-edit').css("display","none");
      activatemultiselects(listid,listid+"-form");
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
        savevendorservices(listid,false,"",'pages/vendor/services/buildserviceli.php');
      }
    }
    submiteditform=function(listid){
      if($('#'+listid+'-form').valid()){
        savevendorservices(listid,false,'pages/vendor/attachment/index.php');
      }
    }
    savenewform= function(listid) { 
      if($('#'+listid+'-form').valid()){
        savevendorservices(listid,true,"",'pages/vendor/services/appendservice.php');
      }
    } 
    submitnewform= function(listid){ 
      if($('#'+listid+'-form').valid()){
        savevendorservices(listid,true,'pages/vendor/attachment/index.php');
      }
    }
    activatemultiselects=function(listid,formid){
     $("#"+formid +" #selectedzone").multiselect({
       includeSelectAllOption: true,
       enableCaseInsensitiveFiltering: true,
       maxHeight: 200      
     });    
     $("#"+formid +" #selectedstate").multiselect({
       includeSelectAllOption: true,
       enableCaseInsensitiveFiltering: true,
       maxHeight: 200      
     });    
     $("#"+formid +" #selectedlocation").multiselect({
       includeSelectAllOption: true,
       enableCaseInsensitiveFiltering: true,
       maxHeight: 200      
     }); 
     if(listid!=""){
      if($("#hselectedzones_"+listid).attr("mulitselectvalues"))
        $("#"+formid +" #selectedzone").multiselect('select', $("#hselectedzones_"+listid).attr("mulitselectvalues").split(","));
      if($("#hselectedstates_"+listid).attr("mulitselectvalues"))
        $("#"+formid +" #selectedstate").multiselect('select', $("#hselectedstates_"+listid).attr("mulitselectvalues").split(","));
      if($("#hselectedlocations_"+listid).attr("mulitselectvalues"))
        $("#"+formid +" #selectedlocation").multiselect('select', $("#hselectedlocations_"+listid).attr("mulitselectvalues").split(','),true);      
    }
  }
  $(D).ready(function($) {
    activatemultiselects("","new-form");
    JQUERY4U.UTIL.setupFormValidation("new-form"); 
  });

})(jQuery, window, document);
</script>