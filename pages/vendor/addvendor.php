        <?php 
        if(!isset($_SESSION)){session_start();}
        if(isset($_POST['postvalue']))
        	$vendorid=$_POST['postvalue'];
        include_once($_SERVER['DOCUMENT_ROOT']."/eventconfig.php");
        include_once(CLASSFOLDER."/vendor.php");
        $vendor=new vendorclass();
        if(!empty($vendorid)){
          $vendordata=$vendor->getvendorbyid($vendorid);
        }

        else{
        	$vendorid=0;
          $vendordata=array(
            'name'=>"",
            'phone1'=>"",
            'phone2'=>"",
            'phone3'=>"",
            'website'=>"",
            'contact_person'=>""      
            );
        }
        $assignedRoles=array();
        ?>
      <style type="text/css">
        #update-vendorbasics .form-group label.error {
          color: #FB3A3A;
          display: inline-block;   
          text-align: left;    
      }
      </style>
    <div id="div_vendorbasic">
        <form  id="update-vendorbasics" name="update-vendorbasics" action="" method="post" novalidate="novalidate">
        <input type="hidden" id="vendor_id" name="vendor_id" value="<?php  echo (!empty($vendorid))?$vendorid:0; ?>" />
          <div class="box box-primary">
            <div class="box-body"> 
              <div class="row">
                <div class="col-lg-6">
                  <div class="form-group margin">
                    <label><span class="text-error">*</span>Name</label>
                    <input type="text"  id="name" name="name" value="<?php echo $vendordata['name'];?>" maxlength="25" placeholder="Name" class="form-control" >
                  </div>
                </div>           
                <div class="col-lg-6">
                  <div class="form-group margin">
                    <label><span class="text-error">*</span> Contact Number</label>
                    <input type="text" name="phone1" id="phone1" value="<?php echo $vendordata['phone1'];?>" maxlength="15" placeholder="Contact Number" class="form-control" >
                  </div>
                </div>
                <div class="col-lg-6 ">
                  <div class="form-group  margin">
                    <label >Office Number</label>

                    <input type="text" name="phone2" id="phone2" value="<?php echo $vendordata['phone2'];?>" maxlength="25" placeholder="Office Number" class="form-control" >
                  </div>
                </div>
                <div class="col-lg-6">
                  <div class="form-group  margin">
                    <label >Alternate Number</label>              
                        <input type="text" name="phone3" id="phone3" value="<?php echo $vendordata['phone3'];?>" maxlength="25" placeholder="Alternate Number" class="form-control" >
                  </div>
                </div>
              
                        <div class="col-lg-6">
                <div class="form-group margin">
                        <button class="btn bg-maroon btn-flat margin"  id="btn_selectservice" onclick="selectEventServices();" selectedservice="" >Select Services</button>
                         <label id="selectedservices"></label>                        
                        </div>
                        </div>
                <div class="col-lg-6">
                  <div class="form-group  margin">
                    <label >Conatct Person</label>
                    <input type="text" name="contact_person" id="contact_person" value="<?php echo $vendordata['contact_person'];?>" maxlength="30" placeholder="Conatct Person"  class="form-control"  >
                  </div>
                </div>
                  <div class="col-lg-6">
                <div class="form-group margin">
                          <label for="vedorprofile">File input</label>
                          <input type="file" id="profile_images">
                          <p class="help-block">Example block-level help text here.</p>
                        </div>
                        </div>
                </div>
            <div class="savewizard">
              <div class="row">
                <div class="col-sm-5 " >
                <a href="javascript:void(0);" onclick="savevendorasdraft();" class="btn btn-primary pull-right">Save As Draft</a>
                </div>
                <div class="col-sm-2">
                <a href="javascript:void(0);" onclick="submitvendor();" id="submitvendor" class="btn btn-primary">Submit</a>
                </div>
         
                <div class="col-sm-5">
                <button class="btn btn-primary pull-right"  type="submit">Next</button>           
                 <a href="javascript:void(0);" onclick="resetform('update-vendorbasics');" id="btnresetuser" class="btn btn-primary pull-right">Reset</a>  
                </div>
              </div>
            </div>
          </div>
        </div>
      </form>
      </div>
      <div id="div_vedorservice" style="display:none">
          <form  id="form_vedorservice" name="form_vedorservice" action="" method="post" novalidate="novalidate">    
          <div class="box box-primary">
            <div class="box-body"> 
              <div class="row">
                <div class="col-lg-6">
                  <div class="form-group margin">
                    <label><span class="text-error">*</span>Name</label>
                    <input type="text"  id="name" name="name" value="<?php echo $vendordata['name'];?>" maxlength="25" placeholder="Name" class="form-control" >
                  </div>
                </div>
                <div class="col-lg-6">
                  <div class="form-group margin">
                    <label><span class="text-error">*</span> Contact Number</label>
                    <input type="text" name="phone1" id="phone1" value="<?php echo $vendordata['phone1'];?>" maxlength="15" placeholder="Contact Number" class="form-control" >
                  </div>
                </div>
                <div class="col-lg-6 ">
                  <div class="form-group  margin">
                    <label ><span class="text-error">*</span> Office Number</label>

                    <input type="text" name="phone2" id="phone2" value="<?php echo $vendordata['phone2'];?>" maxlength="25" placeholder="Office Number" class="form-control" >
                  </div>
                </div>
                <div class="col-lg-6">
                  <div class="form-group  margin">
                    <label > <span class="text-error">*</span> Alternate Number</label>              
                        <input type="text" name="phone3" id="phone3" value="<?php echo $vendordata['phone3'];?>" maxlength="25" placeholder="Alternate Number" class="form-control" >
                  </div>
                </div>
                <div class="col-lg-6">
                  <div class="form-group  margin">
                    <label >Conatct Person</label>
                    <input type="text" name="contact_person" id="contact_person" value="<?php echo $vendordata['contact_person'];?>" maxlength="30" placeholder="Conatct Person"  class="form-control"  >
                  </div>
                </div>
                </div>
            <div class="savewizard">
              <div class="row">
                <div class="col-sm-5 " >
                <a href="javascript:void(0);" onclick="backvedordetails('div_vendorbasic','div_vedorservice');" class="btn btn-primary pull-right">Save As Draft</a>
                <a href="javascript:void(0);" onclick="savevendorasdraft();" class="btn btn-primary pull-right">Save As Draft</a>
                </div>
                <div class="col-sm-2">
                <a href="javascript:void(0);" onclick="submitvendor();" id="submitvendor" class="btn btn-primary">Submit</a>
                </div>
         
                <div class="col-sm-5">
                <button class="btn btn-primary pull-right"  type="submit">Next</button>           
                 <a href="javascript:void(0);" onclick="resetform('update-vendorbasics');" id="btnresetuser" class="btn btn-primary pull-right">Reset</a>  
                </div>
              </div>
            </div>
          </div>
        </div>
      </form>

      </div>



