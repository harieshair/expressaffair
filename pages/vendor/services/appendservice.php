<?php
if(!isset($_SESSION)){session_start();}
if(isset($_POST['postvalue']))
  $serviceid=$_POST['postvalue'];        
if(empty($vendor)  ){
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
}
if(empty($service))
  $service=(!empty($serviceid))?$vendor->getvendorservicebyid($serviceid):array();
?>


<li class="li-edit" style="display:none" id="<?php echo $service['id']; ?>-edit">
  <div class="box box-primary">

    <div class="box-body"> 
      <form id="<?php echo $service['id']; ?>-form" name="<?php echo $service['id']; ?>-form" class="form-horizontal" action="" method="post" novalidate="novalidate">
        <input type="hidden" id="serviceid" name="serviceid" value="<?php  echo $service['id']; ?>" />
        <input type="hidden" id="vendor_id" name="vendor_id" value="<?php  echo $service['vendor_id']; ?>" />
        <div class="row">
         
           <div class="form-group margin">
            <label class="col-sm-3 control-label"><span class="text-error">*</span>Title</label>
            <div class="col-sm-8" >
              <input type="text"  id="title" name="title"  maxlength="25" placeholder="Title" class="form-control"
              value="<?php  echo !empty($service['title'])?$service['title']:''; ?>" >
            </div>
          </div>
          
        <div class="form-group margin">
        <label class="col-sm-3 control-label"> Event</label>
          <div class="col-sm-8">
           <input type="hidden" id="hselectedevents_<?php echo $service['id']; ?>" 
           mulitselectvalues="<?php echo !empty($service['events'])?$service['events']:''; ?>">
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
            <input type="hidden" id="hselectedzones_<?php echo $service['id']; ?>" 
            mulitselectvalues="<?php echo !empty($service['zones'])?$service['zones']:''; ?>">
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
            <input type="hidden" id="hselectedstates_<?php echo $service['id']; ?>" 
            mulitselectvalues="<?php echo !empty($service['states'])?$service['states']:''; ?>">
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
            <input type="hidden" id="hselectedlocations_<?php echo $service['id']; ?>" 
            mulitselectvalues="<?php echo !empty($service['locations'])?$service['locations']:''; ?>">
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
      <a href="javascript:void(0);"  onclick="saveeditform('<?php echo $service['id']; ?>')" class="btn btn-primary pull-right">Save</a>  <a href="javascript:void(0);"  onclick="submiteditform('<?php echo $service['id']; ?>')" class="btn btn-primary pull-right">Save & Continue</a>
      <a href="javascript:void(0);" onclick="canceleditform('<?php echo $service['id']; ?>');" class="btn btn-primary pull-right">Cancel</a>                        
    </div>
  </form>
</div>
</div>          
</li>
<li class="li-non-edit" id="<?php echo $service['id'] ?>-non-edit">
  <?php include "buildserviceli.php"; ?>
</li>