<?php
$attachmentid=isset($_POST['postvalue'])?$_POST['postvalue']:null;        
if(empty($vendorclass)  ){
  include_once($_SERVER['DOCUMENT_ROOT']."/eventconfig.php");
  include_once(CLASSFOLDER."/dbconnection.php");
  include_once(CLASSFOLDER."/vendor.php");
  $vendorclass=new vendorclass($dbconnection->dbconnector);  
  include_once(CLASSFOLDER."/catalogs.php");
  $catalog=new catalogclass($dbconnection->dbconnector);
  $catalogArray=$catalog->GetAllCatalogValuesByMasterNames("Services"); 
  $typeList=   $vendorclass->AttachmentType->getlists(); 
}
if(empty($attachment))
  $attachment=(!empty($attachmentid))?$vendorclass->getvendorattachment($attachmentid):array();
?>
<li class="li-edit" style="display:none" id="<?php echo $attachment['id']; ?>-edit">
  <div class="box box-primary">

    <div class="box-body"> 
      <form id="<?php echo $attachment['id']; ?>-form" name="<?php echo $attachment['id']; ?>-form" class="form-horizontal" action="" method="post" novalidate="novalidate">
        <input type="hidden" id="primarykey" name="primarykey" value="<?php  echo $attachment['id']; ?>" />
        <div class="row">
         <div class="form-group margin">
          <label class="col-sm-3 control-label"> Services</label>
          <div class="col-sm-8">
            <input type="hidden" id="hselectedservice_<?php echo $attachment['id']; ?>" 
            mulitselectvalues="<?php echo !empty($attachment['services'])?$attachment['services']:''; ?>">
            <select id="selectedservice" name="selectedservice[]" multiple="multiple" class="form-control">
             <?php
             if(!empty($servicecatalogs) && count($servicecatalogs)>0){
              foreach ($catalogArray as $key->value) {
                ?>            

                <option value="<?php echo $key ;?>"><?php echo $value ;?></option>
                <?php }

              }
              ?>
            </select>
          </div>
        </div>
        <?php include VIEWFOLDER."/composeattachments.php"; ?>

        <div class="form-group margin">
          <label class="col-sm-3 control-label">About this</label>        

          <div class="col-sm-8" >              
            <textarea class="textarea" id="description" name ="description" placeholder="Place some text here" style="width: 100%; height: 120px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">
              <?php echo !empty($attachment['description'])?$attachment['description']:'';?>
            </textarea>            
          </div>
        </div>

      </div>
    </form>              
    <div class="row">          
    <a href="javascript:void(0);"  onclick="saveeditform('<?php echo $attachment['id']; ?>')" class="btn btn-default pull-right">Save</a>      
      <a href="javascript:void(0);"  onclick="submiteditform('<?php echo $attachment['id']; ?>')" class="btn btn-default pull-right">Save & Continue</a>
      <a href="javascript:void(0);" onclick="canceleditform('<?php echo $attachment['id']; ?>');" class="btn btn-default pull-right">Cancel</a>                        
    </div>

  </div>
</div>          
</li>
<li class="li-non-edit" id="<?php echo $attachment['id'] ?>-non-edit">
  <?php include "buildattachmentli.php"; ?>
</li>