<?php
if(!isset($_SESSION)){session_start();}
if(isset($_POST['postvalue']))
  $portfolioid=$_POST['postvalue'];        
  if(empty($vendor)  ){
include_once($_SERVER['DOCUMENT_ROOT']."/eventconfig.php");
include_once(CLASSFOLDER."/dbconnection.php");
include_once(CLASSFOLDER."/vendor.php");
$vendor=new vendorclass($dbconnection->dbconnector);
include_once(CLASSFOLDER."/catalogs.php");
$catalog=new catalogclass($dbconnection->dbconnector);          
$catalogArray=$catalog->GetAllCatalogValuesByMasterNames("PortfolioType");   
}
if(empty($portfolio))
$portfolio=(!empty($portfolioid))?$vendor->getportfoliobyid($portfolioid):array();
?>
<li class="li-edit" style="display:none" id="<?php echo $portfolio['id']; ?>-edit">
          <div class="box box-primary">

            <div class="box-body"> 
              <form id="<?php echo $portfolio['id']; ?>-form" name="<?php echo $portfolio['id']; ?>-form" class="form-horizontal" action="" method="post" novalidate="novalidate">
              <input type="hidden" id="portfolioid" name="portfolioid" value="<?php  echo $portfolio['id']; ?>" />
                <div class="row">
                  <div class="form-group margin">
                    <label class="col-sm-3 control-label"><span class="text-error">*</span>Portfolio Type</label>
                     <div class="col-sm-8" >
                      <select id="portfoliotype" name="portfoliotype" class="form-control">
                       <?php
                       if(!empty($portfoliocatalog) && count($portfoliocatalog)>0){
                        foreach ($portfoliocatalog as $key->$value) {
                          ?>            
                          <option value="<?php echo $key ;?>"><?php echo $value ;?></option>
                          <?php }
                        }
                        ?>
                      </select>
                   </div>
                   </div>
                  <div class="form-group margin">
                    <label class="col-sm-3 control-label"><span class="text-error">*</span>Link</label>
                    <div class="col-sm-8" >
                      <input type="text"  id="link" name="link" value="<?php echo $portfolio['link'];?>" maxlength="25" placeholder="Title" class="form-control" >
                    </div>
                  </div>
                  <div class="form-group margin">
                    <label class="col-sm-3 control-label"><span class="text-error">*</span>About Us</label>
                    <div class="col-sm-8" >
                      <input type="text"  id="aboutus" name="aboutus" value="<?php echo $portfolio['aboutus'];?>" maxlength="25" placeholder="Title" class="form-control" >
                    </div>
                  </div>                 
                  </div>
                </form>              
                <div class="row">          
                  <a href="javascript:void(0);"  onclick="saveeditform('<?php echo $portfolio['id']; ?>')" class="btn btn-primary pull-right">Save</a>      
                  <a href="javascript:void(0);"  onclick="submiteditform('<?php echo $portfolio['id']; ?>')" class="btn btn-primary pull-right">Save & Continue</a>
                  <a href="javascript:void(0);" onclick="canceleditform('<?php echo $portfolio['id']; ?>');" class="btn btn-primary pull-right">Cancel</a>                        
                </div>
              
            </div>
          </div>          
        </li>
        <li class="li-non-edit" id="<?php echo $portfolio['id'] ?>-non-edit">
          <?php include "buildportfolioli.php"; ?>
        </li>