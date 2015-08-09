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

  ?>
  <style type="text/css">
    #update-communitydetails .form-group label.error {
      color: #FB3A3A;
      display: inline-block;   
      text-align: left;    
    }
  </style>
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
          <div class="form-group margin">
           <label><span class="text-error">*</span>  Community zone/State configuration</label>
<div class="form-group margin">
           <input type="radio" class="flat-red" name="iszone"  id="iszone"  onclick="loadeventconfiguration('zone',communityid)" value="0" 
           <?php echo (isset($communitydata['iszone']) && $communitydata['iszone']==1)?' checked ':'';?> />
           Zone                   
           <input type="radio" class="flat-red" name="iszone" id="iszone" value="1"
           <?php echo (isset($communitydata['iszone']) && $communitydata['iszone']==0)?' checked ':'';?>  />
           State 
           </div>             
         </div> 
       </div>
       <div class="col-lg-6" id="zonedropdown" >
       <label><span class="text-error">*</span> Zone</label>
       <div class="form-group margin">
        <select id="zonemultiselect" name="zonemultiselect[]" multiple="multiple">
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
      <div class="col-lg-6" id="statedropdown" >
        <label><span class="text-error">*</span> State</label>
        <div class="form-group margin">
        <select id="statemultiselect" name="statemultiselect[]" multiple="multiple">
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

    <div class="box box-primary">
      <div class="box-header">
        <i class="ion ion-clipboard"></i>
        <h3 class="box-title">Pick community Events</h3>                
      </div>
      <div class="box-body">
        <ul class="todo-list" id ="communityevents">
          <?php 
          $eventnames=$event->getAllEventNames();
          if(!empty($eventnames) && count($eventnames)){
            foreach ($eventnames as $eventname) {
              ?>
              <li>                  
                <input type="checkbox" value="<?php echo $eventname['id']; ?>" name="eventid" id="eventid"/>
                <span class="text"><?php echo $eventname['name']; ?></span>                                   
              </li> 
              <?php }
            }
            ?>                   
          </ul>
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

      $('zonemultiselect').multiselect({
        includeSelectAllOption: true,
        enableFiltering: true
      });    
      $('statemultiselect').multiselect({
        includeSelectAllOption: true,
        enableFiltering: true
      });    
      JQUERY4U.UTIL.setupFormValidation();
    });

  })(jQuery, window, document);
</script>