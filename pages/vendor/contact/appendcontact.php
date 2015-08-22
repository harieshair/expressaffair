<?php
if(!isset($_SESSION)){session_start();}
if(isset($_POST['postvalue']))
  $contactid=$_POST['postvalue'];        
  if(empty($vendor)  ){
include_once($_SERVER['DOCUMENT_ROOT']."/eventconfig.php");
include_once(CLASSFOLDER."/vendor.php");
$vendor=new vendorclass();   
include_once(CLASSFOLDER."/catalogs.php");
$catalog=new catalogclass();          
$statecatalogs=$catalog->GetAllCatalogValues('State'); 
$citycatalogs=$catalog->GetAllCatalogValues('City');
$catalogArray=$catalog->GetAllCatalogValuesByMasterNames("'City','State'");
}
if(empty($contact))
$contact=(!empty($contactid))?$vendor->getcontactsbyid($contactid):array();
?>
<li class="li-edit" style="display:none" id="<?php echo $contact['id']; ?>-edit">
          <div class="box box-primary">

            <div class="box-body"> 
              <form id="<?php echo $contact['id']; ?>-form" name="<?php echo $contact['id']; ?>-form" class="form-horizontal" action="" method="post" novalidate="novalidate">
              <input type="hidden" id="contactid" name="contactid" value="<?php  echo $contact['id']; ?>" />
                <div class="row">
                  <div class="form-group margin">
                    <label class="col-sm-3 control-label"><span class="text-error">*</span>Contact Person</label>
                    <div class="col-sm-6" >
                      <input type="text"  id="contactperson" name="contactperson" value="<?php echo $contact['contactperson'];?>" maxlength="25" placeholder="Contact Person" class="form-control" >
                    </div>
                  </div>
                  <div class="form-group margin">
                    <label class="col-sm-3 control-label"><span class="text-error">*</span>Title</label>
                    <div class="col-sm-8" >
                      <input type="text"  id="title" name="title" value="<?php echo $contact['title'];?>" maxlength="25" placeholder="Title" class="form-control" >
                    </div>
                  </div>

                  <div class="form-group margin">
                    <label class="col-sm-3 control-label"><span class="text-error">*</span>Contact Number1</label>
                    <div class="col-sm-8" >
                      <input type="text"  id="contactnumber1" name="contactnumber1" value="<?php echo $contact['contactnumber1'];?>" maxlength="55" placeholder="Contact Number1" class="form-control" >
                    </div>
                  </div>

                  <div class="form-group margin">
                    <label class="col-sm-3 control-label"><span class="text-error">*</span>Office  Number</label>
                    <div class="col-sm-8" >
                      <input type="text"  id="officenumber" name="officenumber" value="<?php echo $contact['officenumber'];?>" maxlength="55" placeholder="Office Number" class="form-control" >
                    </div>
                  </div>
                  <div class="form-group margin">
                    <label class="col-sm-3 control-label"><span class="text-error">*</span>Address1</label>
                    <div class="col-sm-8" >
                      <input type="text"  id="address1" name="address1" value="<?php echo $contact['address1'];?>" maxlength="100" placeholder="Address1" class="form-control" >
                    </div>
                  </div>


                  <div class="form-group margin">
                    <label class="col-sm-3 control-label">State</label>
                    <div class="col-sm-8" >
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
                    <div class="col-sm-8" >
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
                </div>               
                <div class="row">          
                  <a href="javascript:void(0);"  onclick="saveeditform('<?php echo $contact['id']; ?>')" class="btn btn-primary pull-right">Save</a>      
                  <a href="javascript:void(0);"  onclick="submiteditform('<?php echo $contact['id']; ?>')" class="btn btn-primary pull-right">Save & Continue</a>
                  <a href="javascript:void(0);" onclick="canceleditform('<?php echo $contact['id']; ?>');" class="btn btn-primary pull-right">Cancel</a>                        
                </div>
              </form>
            </div>
          </div>          
        </li>
        <li class="li-non-edit" id="<?php echo $contact['id'] ?>-non-edit">
          <?php include "buildcontactli.php"; ?>
        </li>