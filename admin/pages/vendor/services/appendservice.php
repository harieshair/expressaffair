<?php
if(empty($vendor)  ){
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
}
if(isset($_POST['postvalue']))
  $serviceid=$_POST['postvalue']; 
if(empty($service))
  $service=(!empty($serviceid))?$vendor->getvendorservicebyid($serviceid):array();
else
  $serviceid=$service['id'];
$attachments=$vendor->getAllAttachmentsByEntityId($serviceid,VENDORSERVICE);
?>


<li class="li-edit" style="display:none" id="<?php echo $service['id']; ?>-edit">
  <div class="box box-primary">

    <div class="box-body"> 
      <form id="<?php echo $service['id']; ?>-form" name="<?php echo $service['id']; ?>-form" class="form-horizontal" action="" method="post" novalidate="novalidate">
        <input type="hidden" id="vserviceid" name="vserviceid" value="<?php  echo $serviceid; ?>" />
        <input type="hidden" id="serviceid" name="serviceid" value="<?php  echo $service['service_id']; ?>" />
        <input type="hidden" id="vendor_id" name="vendor_id" value="<?php  echo $service['vendor_id']; ?>" />
        <div class="row">

         <div class="col-sm-2">

          <label class="control-label pull-right margin"><span class="text-error">*</span>Title:</label>
        </div>
        <div class="col-sm-4">
         <div class="margin">
          <input type="text"  id="title" name="title"  maxlength="25" placeholder="Title" class="form-control"
          value="<?php  echo !empty($service['title'])?$service['title']:''; ?>" >
        </div>
      </div>

      <div class="col-sm-2">

        <label class="control-label pull-right margin"> Service</label>   </div>
        <div class="col-sm-4">
          <div class="margin">       
            <select id="selectedservice" name="selectedservice"  class="form-control">
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
        <div class="col-sm-2"> 
          <label class="control-label pull-right margin"> Location:</label>   
        </div>
        <div class="col-sm-4">
          <div class="margin">      
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
      <div class="col-sm-2">
        <label class="control-label pull-right margin"> State:</label>
      </div>
      <div class="col-sm-4">
        <div class="margin">
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
      <div class="col-sm-2">
        <label class="control-label pull-right margin" > Zone</label>
      </div>
      <div class="col-sm-4">
        <div class="margin">
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
      
      <div class="col-sm-2">      
        <label class="control-label pull-right margin"> Price:</label></div>
        <div class="col-sm-4">
          <div class="margin">
            <input type="text" id="price" name="price" value="<?php echo !empty($service['price'])?$service['price']:''; ?> " class="form-control"/>
          </div>
        </div>
        <div class="col-sm-2">
          <label class="control-label pull-right margin">Category:</label></div>
          <div class="col-sm-4">
            <div class="margin">
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

          <div class="col-sm-12 ">
            <div class="form-group margin">
             <div class="col-sm-3">  
               <label  class="control-label pull-right margin" >Service Files:</label>
             </div>
             <div class="col-sm-9">
              <input type="hidden" value="0" name="file_type" id="file_type_<?php echo $serviceid;?>">
              <input type="file" class="form-control" name="attachment_<?php echo $serviceid;?>[]" id="attachment_<?php echo $serviceid;?>"  onchange="uploadmultiplefiles('<?php echo $service['id']; ?>');"  multiple >
              <?php 
              $files=array();
              if(!empty($attachments)){
                foreach ($attachments as $attachment) {
                  $files[]=$attachment['file_name'];
                }
              }?>
              <input type="hidden" value="<?php  echo ($files!=array())?implode(',',$files):''; ?>" name="file_name" id="file_name_<?php echo $serviceid;?>"><br>            

            </div>
          </div>
        </div>
        <div  class="col-sm-12 margin"  >
          <div class="box box-default box-solid">
           <div class="box-header with-border">                  
             <div class="col-sm-3">  
              <span>Profile Picture</span>
            </div>
            <div class="col-sm-7">
              <span>File Name</span>
            </div>
            <div class="col-sm-2">
              <span>Remove</span>
            </div>
          </div>
          <div class="box-body multi-attachment-view" id="divexistingfile_<?php echo $serviceid;?>">            
            <?php
            if(!empty($attachments)){
              foreach ($attachments as $attachment) {    
                $filenamewithoutextension=strstr($attachment['file_name'], '.', true)
                ?>  
                <div class="row " id="attachmentdiv_<?php echo $serviceid.'_'.$filenamewithoutextension; ?>" >
                  <div class="col-sm-3 ele-centered">  
                    <input type="radio" value="<?php echo $attachment['file_name']; ?>" <?php echo $attachment['is_profile_file']==1?' checked ':''; ?>id="rd_ismasterimage" name="rd_ismasterimage">
                  </div>
                  <div class="col-sm-7">
                    <a class="attachment-anchor" id="view_<?php print $filenamewithoutextension ;?>" href="attachments/downloadfiles.php?filelocation=<?php  echo '/'.$attachment['file_path']; ?>" ><?php echo $attachment['file_name'] ;?></a>
                  </div>
                  <div class="col-sm-2">
                    <a  style="cursor: pointer" class="pull-left" id="remove_attachment" onclick="removefilefromattachmentdiv('attachmentdiv_<?php echo $serviceid.'_'.$filenamewithoutextension; ?>','file_name_<?php echo $serviceid;?>','<?php echo $attachment['file_name'] ;?>')"  ><i class="fa fa-times-circle"></i></a>
                  </div>
                </div>
                <?php
              } 
            }

            ?>
          </div>        
        </div>
      </div>

      <div class="col-sm-12 margin">
        <label class="control-label"> Description</label>
        <textarea id="description" name="description" style="height: 175px;" class="form-control"><?php echo !empty($service['description'])?$service['description']:''; ?> </textarea>
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