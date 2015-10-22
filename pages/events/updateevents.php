  <?php 
  if(!isset($_SESSION)){session_start();}
  $eventid=(isset($_POST['postvalue']))?$_POST['postvalue']:0;

  include_once($_SERVER['DOCUMENT_ROOT']."/eventconfig.php");
  include_once(CLASSFOLDER."/dbconnection.php");
  include_once(CLASSFOLDER."/events.php");
  $event=new eventclass($dbconnection->dbconnector);
  $eventdata=(!empty($eventid))? $event->geteventbyid($eventid):array();    
  include_once(CLASSFOLDER."/rituals.php");
  $rituals=new ritualclass($dbconnection->dbconnector);
  $ritualtitles=$rituals->getAllRitualNames(); 
  include_once(CLASSFOLDER."/catalogs.php");
  $catalog=new catalogclass($dbconnection->dbconnector);
  $servicecatalogs=$catalog->GetAllCatalogValues('Services');
  $attachments=!empty($eventid)?$event->getAllEventAttachments($eventid):null;
  ?>
  <link href="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css" rel="stylesheet" type="text/css" />
  <form  id="update-eventdetails" name="update-eventdetails" action="" method="post" novalidate="novalidate">
    <input type="hidden" id="eventid" name="eventid" value="<?php  echo !empty($eventid)?$eventid:0; ?>" />
    <div class="box box-primary">
      <div class="box-body"> 
        <div class="row">
          <div class="col-lg-6">
            <div class="row">
              <div class="col-lg-12">
                <div class="form-group margin">
                  <label><span class="text-error">*</span> Event Name</label>
                  <input type="text"  id="eventname" name="eventname" value="<?php echo !empty($eventdata['name'])?$eventdata['name']:'';?>" maxlength="25" placeholder="Login Name" class="form-control" >
                </div>
              </div>


              <div class="col-lg-12">
                <div class="form-group margin">
                  <label for="eventicon">Event Icon</label>
                  <input type="file" id="event_icons">
                  <p class="help-block">Upload event related Icon.</p>
                </div>
              </div>
              <div class="col-lg-12">
                <div class="form-group margin">
                  <label for="eventimages">Event Images</label>
                  <input type="hidden" value="0" name="file_type" id="file_type">
                  <input type="file" name="attachment[]" id="attachment"  onchange="uploadmultiplefiles();"  multiple >
                  <?php 
                  $files=array();
                  if(!empty($attachments)){
                  foreach ($attachments as $attachment) {
                    $files[]=$attachment['file_name'];
                  }
                  }?>
                  <input type="hidden" value="<?php  echo ($files!=array())?implode(',',$files):''; ?>" name="file_name" id="file_name"><br>            
                  <div id="divexistingfile"  class="fileclass"> 
                  <?php
                    if(!empty($attachments)){
                    foreach ($attachments as $attachment) {    ?>                                  
                    <a style="cursor:pointer;color:#0000CC;" id="view_<?php print $attachment['file_name'] ;?>" href="attachments/downloadfiles.php?filelocation=<?php  print '/'.$attachment['file_path']; ?>" ><?php print $attachment['file_name'] ;?></a>
                    <a  style="cursor: pointer" class="fa fa-times" id="remove_<?php print $attachment['file_name'] ;?>" onclick="removefilefromattachment('<?php print $attachment['file_name'] ;?>','file_name')"  title="Remove file"></a>
                    <?php
                     } 
                  }

                  ?></div>
                </div>
              </div>
            </div>
          </div>
          
          <div class="col-lg-6">
           <div class="form-group margin">
            <label><span class="text-error">*</span> Desscription</label>        

            <div class='box-body pad'>              
              <textarea class="textarea" id="description" name ="description" placeholder="Place some text here" style="width: 100%; height: 140px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">
                <?php echo !empty($eventdata['description'])?$eventdata['description']:'';?>

              </textarea>            
            </div>
          </div>
        </div>
        <div class="col-lg-6">
          <div class="box box-warning">
           <div class="box-header">
             <h3 class="box-title">Rituals related to events</h3>
           </div><!-- /.box-header -->         
           <div class="box-body check-box-table"> 
            <div class="form-group margin">
              <table  class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th><input type="checkbox" name ="parenteventritual" onchange="selectAllCheckboxchilds('parenteventritual','childeventrituals')" /></th>
                    <th>Ritual Name</th>
                    <th></th>
                  </tr>
                </thead>
                <tbody id="ritualtablebody">

                  <?php 
                  $selectedRituals=!empty($eventdata['rituals'])?explode(",",$eventdata['rituals']):array();
                  foreach ($ritualtitles as $key => $value) {
                    ?>
                    <tr><td>                 
                      <input type="checkbox" value="<?php echo $key; ?>"  name="childeventrituals" id="ritualid" 
                      <?php echo in_array($key,$selectedRituals)?' checked ': ''; ?>/>
                    </td>
                    <td>
                      <span class="text"><?php echo $value; ?></span>                                   
                    </td>
                    <td></td></tr>
                    <?php }
                    ?>                   
                  </tbody>
                </table>
              </div>      
            </div>
          </div>
        </div>
        <div class="col-lg-6">

         <div class="box box-warning ">
           <div class="box-header">
             <h3 class="box-title">Services related to events</h3>
           </div><!-- /.box-header -->   
           <div class="box-body check-box-table">

            <div class="form-group margin">
              <table  class="table table-bordered table-striped check-box-table">
                <thead>
                  <tr>
                    <th><input type="checkbox" name ="parenteventservice" onchange="selectAllCheckboxchilds('parenteventservice','childeventservice')" /></th>
                    <th>Service Name</th>
                    <th></th>
                  </tr>
                </thead>
                <tbody id="servicetablebody">

                  <?php 
                  $selectedServices=!empty($eventdata['services'])?explode(",",$eventdata['services']):array();
                  foreach ($servicecatalogs as $servicecatalog) {
                    ?>
                    <tr><td>                 
                      <input type="checkbox" value="<?php echo $servicecatalog['id']; ?>"  name="childeventservice" id="serviceid" 
                      <?php echo in_array($servicecatalog['id'],$selectedServices)?' checked ': ''; ?>/>
                    </td>
                    <td>
                      <span class="text"><?php echo $servicecatalog['catalog_value']; ?></span>                                   
                    </td>
                    <td></td></tr>
                    <?php }
                    ?>                   
                  </tbody>
                </table>
              </div>      
            </div>
          </div>
        </div>



      </div>
      <div class="savewizard">
        <div class="row">
          <div class="col-sm-7 " >
          </div>      
          <div class="col-sm-5">
            <button class="btn btn-primary pull-right"  type="submit">Save</button>           
            <a href="javascript:void(0);" onclick="resetuserform();" id="btnresetuser" class="btn btn-primary pull-right">Reset</a>  
          </div>
        </div>
      </div>
    </div>
  </div>
</form>

<script src="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js" type="text/javascript"></script>
<script type="text/javascript">

  (function($,W,D)
  {
   $(".textarea").wysihtml5();
   var JQUERY4U = {};

   JQUERY4U.UTIL =
   {
    setupFormValidation: function()
    {
            //form validation rules
            $("#update-eventdetails").validate({
              rules: {
                eventname: "required",                    
                description:"required"                       
              },
              messages: {
                eventname: "Please enter valid event name",
                description: "Please enter description"                  
              },
              submitHandler: function(form) {
                saveeventdetails();
              }
            });
          }
        }      
    //when the dom has loaded setup form validation rules
    $(D).ready(function($) {

      JQUERY4U.UTIL.setupFormValidation();
    });

  })(jQuery, window, document);

</script>



