<?php 
if(!isset($_SESSION)){session_start();}
if(isset($_POST['postvalue']))
 $vendorid=$_POST['postvalue'];
include_once($_SERVER['DOCUMENT_ROOT']."/eventconfig.php");
include_once(CLASSFOLDER."/vendor.php");
$vendor=new vendorclass();   
include_once(CLASSFOLDER."/catalogs.php");
$catalog=new catalogclass();
include_once(CLASSFOLDER."/events.php");
$event=new eventclass();
$statecatalogs=$catalog->GetAllCatalogValues('State');
$zonecatalogs=$catalog->GetAllCatalogValues('Zone');
$locationcatalogs=$catalog->GetAllCatalogValues('Location'); 
$eventnames=$event->getAllEventNames();  
$catalogArray=$catalog->GetAllCatalogValuesByMasterNames("'State','Zone','Location'");          
$servicedata=(!empty($vendorid))?$vendor->getallvendorservices($vendorid):array();
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
            <input type="hidden" id="vendorid" name="vendorid"value="<?php  echo (!empty($vendorid))?$vendorid:0; ?>"    />
            <div class="row">
             <div class="form-group margin">
              <label class="col-sm-3 control-label"><span class="text-error">*</span>Title</label>
              <div class="col-sm-8" >
                <input type="text"  id="title" name="title"  maxlength="25" placeholder="Title" class="form-control">
              </div>
            </div>
            
            <div class="form-group margin">
              <label class="col-sm-3 control-label"> Event</label>
              <div class="col-sm-8" >
                <select id="selectedevent" name="selectedevent[]" multiple="multiple" class="form-control">
                 <?php
                 if(!empty($eventnames) && count($eventnames)>0){
                  foreach ($eventnames as $eventname) {
                    ?>            
                    <option value="<?php echo $eventname['id'] ;?>"><?php echo $eventname['name'] ;?></option>
                    <?php }

                  }
                  ?>
                </select>
              </div>
            </div>
            <div class="form-group margin">
              <label class="col-sm-3 control-label"> Zone</label>
              <div class="col-sm-8">
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
            <div class="form-group margin">
              <label class="col-sm-3 control-label"> State</label>
              <div class="col-sm-8">

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
            </div>

            <div class="form-group margin">
              <label class="col-sm-3 control-label"> Location</label>
              <div class="col-sm-8">
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
 <a href="javascript:void(0);"  onclick="getwizardcontents('pages/vendor/portfolio/index.php','wizardcontent')" class="btn btn-default "><i class="glyphicon  glyphicon-next"></i>Previous</a>                          
 <a href="javascript:void(0);"  onclick="getwizardcontents('pages/vendor/attachment/index.php','wizardcontent')" class="btn btn-default pull-right"><i class="glyphicon  glyphicon-next"></i>Next</a>                          
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
          events:"required",

        },
        messages: {
          title: "Please provid title to this service"   ,        
          events: "Please select required events" ,
        }              
      });
    }
  }
    //when the dom has loaded setup form validation rules
    //when the dom has loaded setup form validation rules
    addmorelists=function(listclass){
      $('.'+listclass).css("display","block");
      activatemultiselects("","new-form");
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
     $("#"+formid +" #selectedevent").multiselect({
       includeSelectAllOption: true,
       enableCaseInsensitiveFiltering: true,
       maxHeight: 200      
     }); 
     if(listid!=""){
       if($("#hselectedevents_"+listid).attr("mulitselectvalues"))
        $("#"+formid +" #selectedevent").multiselect('select', $("#hselectedevents_"+listid).attr("mulitselectvalues"));
      if($("#hselectedzones_"+listid).attr("mulitselectvalues"))
        $("#"+formid +" #selectedzone").multiselect('select', $("#hselectedzones_"+listid).attr("mulitselectvalues"));
      if($("#hselectedstates_"+listid).attr("mulitselectvalues"))
        $("#"+formid +" #selectedstate").multiselect('select', $("#hselectedstates_"+listid).attr("mulitselectvalues"));
      if($("#hselectedlocations_"+listid).attr("mulitselectvalues"))
        $("#"+formid +"#selectedlocation").multiselect('select', $("#hselectedlocations_"+listid).attr("mulitselectvalues"));      
    }
  }
  $(D).ready(function($) {
    activatemultiselects("","new-form");
    JQUERY4U.UTIL.setupFormValidation("new-form");    
  });

})(jQuery, window, document);
</script>