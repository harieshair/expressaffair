  <?php 
  if(!isset($_SESSION)){session_start();}
  $eventid=(isset($_POST['postvalue']))?$_POST['postvalue']:0;

  include_once($_SERVER['DOCUMENT_ROOT']."/eventconfig.php");
  include_once(CLASSFOLDER."/events.php");
  $event=new eventclass();
  $eventdata=(!empty($eventid))? $event->geteventbyid($eventid):array();    

  ?>
    <link href="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css" rel="stylesheet" type="text/css" />
  <style type="text/css">
      #update-eventdetails .form-group label.error {
        color: #FB3A3A;
        display: inline-block;   
        text-align: left;    
    }
</style>
<form  id="update-eventdetails" name="update-eventdetails" action="" method="post" novalidate="novalidate">
  <input type="hidden" id="eventid" name="eventid" value="<?php  echo !empty($eventid)?$eventid:0; ?>" />
  <div class="box box-primary">
      <div class="box-body"> 
        <div class="row">
          <div class="form-group margin">
              <label><span class="text-error">*</span> Event Name</label>
              <input type="text"  id="eventname" name="eventname" value="<?php echo !empty($eventdata['name'])?$eventdata['name']:'';?>" maxlength="25" placeholder="Login Name" class="form-control" >
          </div>
          <div class="form-group margin">
              <label><span class="text-error">*</span> Desscription</label>        

            <div class='box-body pad'>              
                <textarea class="textarea" id="description" name ="description" placeholder="Place some text here" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">
                  <?php echo !empty($eventdata['description'])?$eventdata['description']:'';?>

                </textarea>            
        </div>
    </div>

    <div class="col-lg-6">
        <div class="form-group margin">
          <label for="eventicon">Event Icon</label>
          <input type="file" id="profile_images">
          <p class="help-block">Upload event related Icon.</p>
      </div>
  </div>
  <div class="col-lg-6">
    <div class="form-group margin">
      <label for="eventimages">Event Images</label>
      <input type="file" id="profile_images">
      <p class="help-block">Upload event related Images.</p>
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



