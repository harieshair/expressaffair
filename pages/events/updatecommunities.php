  <?php 
  if(!isset($_SESSION)){session_start();}
  $communityid=(isset($_POST['postvalue']))?$_POST['postvalue']:0;

  include_once($_SERVER['DOCUMENT_ROOT']."/eventconfig.php");
  include_once(CLASSFOLDER."/communities.php");
  $community=new communityclass();
  include_once(CLASSFOLDER."/catalogs.php");
  $catalog=new catalogclass();
  include_once(CLASSFOLDER."/events.php");
  $event=new eventclass();
  $communitydata=(!empty($communityid))? $community->getcommunitybyid($communityid):array();    
  $selectedState=(!empty($communityid))? $community->getSelectedState($communityid):array();  
  $selectedZone=(!empty($communityid))? $community->getSelectedZone($communityid):array();  
  $selectedEvents=(!empty($communityid))? $event->getSelectedEventByCommunityId($communityid):array();  
  ?>
 
  <form  id="update-communitydetails" name="update-communitydetails" action="" method="post" novalidate="novalidate">
    <input type="hidden" id="communityid" name="communityid" value="<?php  echo !empty($communityid)?$communityid:0; ?>" />
    <div class="box box-primary">
      <div class="box-body"> 
        <div class="row">
         <div class="form-group margin">
          <label><span class="text-error">*</span> Community Name</label>
          <input type="text"  id="eventname" name="name" value="<?php echo !empty($communitydata['name'])?$communitydata['name']:'';?>" maxlength="25" placeholder="Login Name" class="form-control" >
        </div>

      </div>
      <div class="row">
        <div class="col-lg-6">      

         <label> Community zone/State configuration:</label>
         <div class="form-group margin">
           <input type="radio" class="flat-red" name="iszone"  id="iszone"  onchange="$('#zonedropdown').toggle(); $('#statedropdown').toggle();" value="0" 
           <?php echo ((isset($communitydata['iszone']) && $communitydata['iszone']!=1) || !isset($communitydata['iszone']))?' checked ':''; ?> />
           Zone                   
           <input type="radio" class="flat-red" name="iszone" id="iszone" onchange="$('#zonedropdown').toggle(); $('#statedropdown').toggle();" value="1"
           <?php echo (isset($communitydata['iszone']) && $communitydata['iszone']==1)?' checked ':''; ?>   />
           State 
         </div>                      
       </div>
       <div class="col-lg-6" id="zonedropdown"  
       style="<?php echo ((isset($communitydata['iszone']) && $communitydata['iszone']!=1) || !isset($communitydata['iszone']))?'':'display:none'; ?>" >
       <div class="form-group margin">
         <label>Zone</label>         
         <select id="selectedzone" name="selectedzone[]" multiple="multiple" class="form-control">
           <?php
           $zoneCatalogs=$catalog->GetAllCatalogValues('Zone');
           if(!empty($zoneCatalogs) && count($zoneCatalogs)>0){
            foreach ($zoneCatalogs as $zoneCatalog) {
              ?>
              <option value="<?php echo $zoneCatalog['id'] ;?>"><?php echo $zoneCatalog['catalog_value'] ;?></option>
              <?php }

            }
            ?>
          </select>
        </div>
      </div>
      <div class="col-lg-6" id="statedropdown" 
      style="<?php echo (isset($communitydata['iszone']) && $communitydata['iszone']==1)?'':'display:none'; ?>" >
      <label> State</label>
      <div class="form-group margin">
        <select id="selectedstate" name="selectedstate[]" multiple="multiple" class="form-control">
         <?php
         $statecatalogs=$catalog->GetAllCatalogValues('State');
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
  </div>

  <div class="box">
    <div class="box-header">
     <i class="ion ion-clipboard"></i>
     <h3 class="box-title">Pick community Events</h3>
   </div><!-- /.box-header -->
   <div class="box-body">
    <table  class="table table-bordered table-striped">
      <thead>
        <tr>
          <th><input type="checkbox" name ="parentcommunityevent" onchange="selectAllCheckboxchilds('parentcommunityevent','childcommunityevent')" /></th>
          <th>Event Name</th>
          <th></th>
        </tr>
      </thead>
      <tbody id="eventtablebody">

        <?php 
        $eventnames=$event->getAllEventNames();
        if(!empty($eventnames) && count($eventnames)){
          foreach ($eventnames as $eventname) {
            ?>
            <tr><td>                 
              <input type="checkbox" value="<?php echo $eventname['id']; ?>"  name="childcommunityevent" id="eventid" 
              <?php echo in_array($eventname['id'],$selectedEvents)?' checked ': ''; ?>/>
            </td>
            <td>
              <span class="text"><?php echo $eventname['name']; ?></span>                                   
            </td>
            <td></td></tr>
            <?php }
          }
          ?>                   
        </tbody>
      </table>
    </div>      
  </div>
</div>
<div class="savewizard">
  <div class="row">
    <div class="col-sm-9 " >
    </div>      
    <div class="col-sm-1">
      <button class="btn btn-primary pull-right"  type="submit">Save</button>    </div>   
      <div class="col-sm-1">    
        <a href="javascript:void(0);" onclick="resetform('update-communitydetails');" class="btn btn-primary">Reset</a>  </div>
        <div class="col-sm-1">
          <a href="javascript:void(0);" onclick="getcontents('pages/events/communities.php','content')" class="btn btn-primary">Close</a> </div>
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
            $("#update-communitydetails").validate({
              rules: {
                name: "required"
              },
              messages: {
                eventname: "Please enter valid community name"           
              },
              submitHandler: function(form) {
                savecommunitydetails();
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
     <?php    if(count($selectedZone)>0){ ?>
      $('#selectedzone').multiselect('select', <?php echo json_encode($selectedZone); ?>);
       <?php } ?> 
       <?php    if(count($selectedState)>0){ ?>
         $('#selectedstate').multiselect('select', <?php echo json_encode($selectedState); ?>);
         <?php } ?>

         $('#eventtable').dataTable({
          "bPaginate": false,
          "bLengthChange": true,
          "bFilter": true,
          "bSort": false,
          "bInfo": true,
          "bAutoWidth": false
        });
         JQUERY4U.UTIL.setupFormValidation();
       });

  })(jQuery, window, document);
</script>