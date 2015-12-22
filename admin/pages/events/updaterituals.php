  <?php 
  $ritualid=isset($_POST['postvalue'])?filter_input(INPUT_POST,'postvalue'):0;
  include_once(filter_input(INPUT_SERVER, 'DOCUMENT_ROOT', FILTER_SANITIZE_STRING)."/eventconfig.php");
  include_once(CLASSFOLDER."/dbconnection.php");
  include_once(CLASSFOLDER."/rituals.php");
  $rituals=new ritualclass($dbconnection->dbconnector);
  include_once(CLASSFOLDER."/catalogs.php");
  $catalog=new catalogclass($dbconnection->dbconnector);
  $servicecatalogs=$catalog->GetAllCatalogValues('Services');
  $ritualData=(!empty($ritualid))? $rituals->getRitualById($ritualid):array();    

  ?>
  <link href="../plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css" rel="stylesheet" type="text/css" />
  <form  id="update-ritualdetails" name="update-ritualdetails" action="" method="post" novalidate="novalidate">
    <input type="hidden" id="ritualid" name="ritualid" value="<?php  echo !empty($ritualid)?$ritualid:0; ?>" />
    <div class="box box-primary">
      <div class="box-body"> 
        <div class="row">
          <div class="form-group margin">
            <label><span class="text-error">*</span>Title</label>
            <input type="text"  id="title" name="title" value="<?php echo !empty($ritualData['title'])?$ritualData['title']:'';?>" maxlength="55" placeholder="Ritual Title" class="form-control" >
          </div>
          <div class="form-group margin">
            <label><span class="text-error">*</span> Description</label>        

            <div class='box-body pad'>              
            <textarea class="textarea" id="description" name ="description" placeholder="Place some text here" style="width: 100%; height: 140px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">
                <?php echo !empty($ritualData['description'])?$ritualData['description']:'';?>

              </textarea>            
            </div>
          </div>
          <div class="box box-warning ">
           <div class="box-header">
             <h3 class="box-title">Possible services</h3>
           </div><!-- /.box-header -->   
           <div class="box-body check-box-table">

            <div class="form-group margin">
              <table  class="table table-bordered table-striped check-box-table">
                <thead>
                  <tr>
                    <th><input type="checkbox" name ="parentritualservice" onchange="selectAllCheckboxchilds('parentritualservice','childritualservice')" /></th>
                    <th>Service Name</th>
                    <th></th>
                  </tr>
                </thead>
                <tbody id="servicetablebody">

                  <?php 
                  $selectedServices=!empty($ritualData['services'])?explode(",",$ritualData['services']):array();
                  foreach ($servicecatalogs as $servicecatalog) {
                    ?>
                    <tr><td>                 
                      <input type="checkbox" value="<?php echo $servicecatalog['id']; ?>"  name="childritualservice" id="serviceid" 
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
        <div class="savewizard">
          <div class="row">
            <div class="col-sm-7 " >
            </div>      
            <div class="col-sm-5">
              <button class="btn btn-primary pull-right"  type="submit">Save</button>           
              <a href="javascript:void(0);" onclick="resetform('update-ritualdetails');"  class="btn btn-primary pull-right">Reset</a>  
            </div>
          </div>
        </div>
      </div>
    </div>
  </form>

  <script src="../plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js" type="text/javascript"></script>
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
            $("#update-ritualdetails").validate({
              rules: {
                ritualtitle: "required",                    
                description:"required"                       
              },
              messages: {
                ritualtitle: "Please enter valid title",
                description: "Please enter description"                  
              },
              submitHandler: function(form) {
                saveRitualDetails();
              }
            });
          }
        }
        activatemultiselects=function(){
         $("#selectedservice").multiselect({
           includeSelectAllOption: true,
           enableCaseInsensitiveFiltering: true,
           maxHeight: 300      
         }); 
         if($("#hselectedservice").attr("mulitselectvalues"))
          $("#selectedservice").multiselect('select', $("#hselectedservice").attr("mulitselectvalues").split(","));
      }
    //when the dom has loaded setup form validation rules
    $(D).ready(function($) {
     activatemultiselects();
     JQUERY4U.UTIL.setupFormValidation();
   });

  })(jQuery, window, document);

</script>



