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
          $locationcatalogs=$catalog->GetAllCatalogValues('Location'); 
          $vendordata=(!empty($vendorid))?$vendor->getvendorbyid($vendorid):array();
          ?>
          <style type="text/css">
            #update-vendorbasics .form-group label.error {
              color: #FB3A3A;
              display: inline-block;   
              text-align: left;    
            }
          </style>
          
          <form  id="update-vendorbasics" name="update-vendorbasics" action="" method="post" novalidate="novalidate">
            <input type="hidden" id="vendor_id" name="vendor_id" value="<?php  echo (!empty($vendorid))?$vendorid:0; ?>" />
            <div class="box box-primary">
              <div class="box-body"> 
                <div class="row">
                  <div class="col-lg-6">
                    <div class="form-group margin">
                      <label><span class="text-error">*</span>Name</label>
                      <input type="text"  id="name" name="name" value="<?php echo !empty($vendordata['name'])?$vendordata['name']:'';?>" maxlength="25" placeholder="Name" class="form-control" >
                    </div>
                  </div> 
                  <div class="col-lg-6">
                    <div class="form-group margin">
                      <label><span class="text-error">*</span>Name</label>
                      <input type="text"  id="name" name="name" value="<?php echo !empty($vendordata['name'])?$vendordata['name']:'';?>" maxlength="25" placeholder="Name" class="form-control" >
                    </div>
                  </div> 

                  <div class="col-lg-6">
                    <div class="form-group margin">
                      <label for="vedorprofile">Logo</label>
                      <input type="file" id="profile_images">
                      <p class="help-block">Logo</p>
                    </div>
                  </div>
                   <div class="col-lg-6">
                    <div class="form-group margin">
                      <label for="vedorprofile">Logo</label>
                      <input type="file" id="profile_images">
                      <p class="help-block">Logo</p>
                    </div>
                  </div>
                     <div class="col-lg-6">
                    <div class="form-group  margin">
                      <label >Conatct Person</label>
                      <input type="text" name="contact_person" id="contact_person" value="<?php echo !empty($vendordata['contact_person'])?$vendordata['contact_person']:'';?>" maxlength="30" placeholder="Conatct Person"  class="form-control"  >
                    </div>
                  </div>  
                  </div>        
                  <div class="col-lg-6">
                    <div class="form-group margin">
                      <label><span class="text-error">*</span> Contact Number</label>
                      <input type="text" name="phone1" id="phone1" value="<?php echo !empty($vendordata['phone1'])?$vendordata['phone1']:'';?>" maxlength="15" placeholder="Contact Number" class="form-control" >
                    </div>
                  </div>
                      <div class="col-lg-6">
                    <div class="form-group  margin">
                      <label >Alternate Number</label>              
                      <input type="text" name="phone3" id="phone3" value="<?php echo !empty($vendordata['phone3'])?$vendordata['phone3']:'';?>" maxlength="25" placeholder="Alternate Number" class="form-control" >
                    </div>
                  </div>
                  <div class="col-lg-6 ">
                    <div class="form-group  margin">
                      <label >Office Number</label>

                      <input type="text" name="phone2" id="phone2" value="<?php echo !empty($vendordata['phone2'])?$vendordata['phone2']:'';?>" maxlength="25" placeholder="Office Number" class="form-control" >
                    </div>
                  </div>
              
              
                </div>
              </div>
            </div>            
            <div class="box box-primary" id="div_vedorservice" style="display:none">
              <form id="form_vendorservice" name="form_vendorservice" action="" method="post" novalidate="novalidate">
                <div class="box-body"> 
                  <div class="row">
                    <div class="col-lg-6">
                      <label> State</label>
                      <div class="form-group margin">
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
                     <div class="col-lg-6" id="zonedropdown">
                      <label> Zone</label>
                      <div class="form-group margin">
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
                    <div class="col-lg-6" id="statedropdown">
                      <label> State</label>
                      <div class="form-group margin">
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
                   
                    <div class="col-lg-6">
                      <label> State</label>
                      <div class="form-group margin">
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
                <div class="row" > 
                 <a title="Create Community" class="btn btn-default pull-right btn-sm " href="javascript:void(0)" 
                  onclick="" > <i class="glyphicon  glyphicon-plus-sign"></i>Reset</a>
                  <a title="Create Community" class="btn btn-default pull-right btn-sm " href="javascript:void(0)" 
                  onclick="" > <i class="glyphicon  glyphicon-plus-sign"></i>Add & Next</a>
                </div>
              </div>
            </form>
          </div>
          <div class="savewizard">
            <div class="row">
              <div class="col-sm-2 " id="backtovendorbasic" style="display:none" >
                <a href="javascript:void(0);" class="btn btn-primary " onclick="$('#div_vedorservice').toggle(); $('#div_vendorbasic').toggle();$('#nexttovendorbasic').toggle();$('#backtovendorbasic').toggle();">Back</a>                                         
              </div>
              <div class="col-sm-4" >
               <button class="btn btn-primary pull-right"  type="submit" >Save As Draft</button>  
             </div>
             <div class="col-sm-4">
              <button class="btn btn-primary pull-right"  type="submit" >Submit</button>
              <a href="javascript:void(0);" onclick="resetform('update-vendorbasics');" class="btn btn-primary">Reset</a>                        
            </div>
            <div class="col-sm-2" id="nexttovendorbasic" >
             <a href="javascript:void(0);"  onclick="$('#div_vedorservice').toggle(); $('#div_vendorbasic').toggle();$('#nexttovendorbasic').toggle(); $('#backtovendorbasic').toggle();" class="btn btn-primary pull-right">Next</a>
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
                name: "required"
              },
              messages: {
                eventname: "Please enter valid community name"           
              },
              submitHandler: function(form) {
                savevendordetails();
              }
            });
          }
        }
    //when the dom has loaded setup form validation rules
    $(D).ready(function($) {

     $('#selectedzone').multiselect({
       includeSelectAllOption: true,
       enableCaseInsensitiveFiltering: true,
       maxHeight: 200      
     });    
     
     $('#selectedstate').multiselect({
      includeSelectAllOption: true,
      enableCaseInsensitiveFiltering: true,
      maxHeight: 200
    });   
     $('#selectedlocation').multiselect({
      includeSelectAllOption: true,
      enableCaseInsensitiveFiltering: true,
      maxHeight: 200
    });   
     $('#selectedevent').multiselect({
      includeSelectAllOption: true,
      enableCaseInsensitiveFiltering: true,
      maxHeight: 200
    });   
     <?php    if(count($selectedZone)>0){ ?>
      $('#selectedzone').multiselect('select', <?php echo json_encode($selectedZone); ?>);
      <?php } ?> 
      <?php    if(count($selectedState)>0){ ?>
       $('#selectedstate').multiselect('select', <?php echo json_encode($selectedState); ?>);
       <?php } ?>
       <?php    if(count($selectedEvent)>0){ ?>
         $('#selectedevent').multiselect('select', <?php echo json_encode($selectedEvent); ?>);
         <?php } ?>
         
         JQUERY4U.UTIL.setupFormValidation();
       });

        })(jQuery, window, document);
      </script>