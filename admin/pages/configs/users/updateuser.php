  <?php 
  $userid=isset($_POST['postvalue'])?$_POST['postvalue']:null;
  include_once($_SERVER['DOCUMENT_ROOT']."/eventconfig.php");
  include_once(CLASSFOLDER."/dbconnection.php");
  include_once(CLASSFOLDER."/enums/userenums.php");
  $typeofuser=new TypeOfUser;
  $userstatus=new UserStatus;
  include_once(CLASSFOLDER."/user.php");
  $user=new userclass($dbconnection->dbconnector);
  $userdata=!empty($userid)?$user->getuserbyid($userid):array();   
  $attachment=!empty($userid)?$user->getUserAttachments($userid):array();   
  $rolesResult=$user->internalDB->query("select  name,id from roles ");
  ?>
</style>
<div>
  
    <div class="li-view" style="display:<?php echo (empty($userdata))?'none':'';?>">
      <div class="box box-primary">
        <div class="box-header">
          <h3 class="box-title"><?php echo !empty($userdata['name'])?$userdata['name']:'';?> Details</h3>
          <a href="javascript:void(0);"  onclick="editlist()" class="btn btn-box-tool pull-right"><i class="fa fa-edit"></i></a>      
        </div>
        <div class="box-body"> 
          <div class="row">
            <div class="form-group margin">
              <label class="col-sm-6"><span class="pull-right"> Full Name:</span></label>
              <label class="col-sm-6"><?php echo !empty($userdata['name'])?$userdata['name']:'';?></label>
            </div>
            <div class="form-group margin">
              <label class="col-sm-6"><span class="pull-right"> Email Id:</span></label>
              <label class="col-sm-6"><?php echo !empty($userdata['email'])?$userdata['email']:'';?></label>
            </div>
            <div class="form-group margin">
              <label class="col-sm-6"><span class="pull-right"> Contact Number:</span></label>
              <label class="col-sm-6"><?php echo !empty($userdata['phone'])?$userdata['phone']:'';?></label>
            </div>
            <div class="form-group margin">
              <label class="col-sm-6"><span class="pull-right"> Type Of User:</span></label>
              <label class="col-sm-6"><?php echo !empty($userdata['usertype'])?$userdata['usertype']:'';?></label>
            </div>
            <div class="form-group margin">
              <label class="col-sm-6"><span class="pull-right"> Roles Assigned:</span></label>
              <label class="col-sm-6">
                <?php 
                if(!empty($userdata['roles'])){
                 $roles= explode(",",$userdata['roles']);
                 foreach ($roles as $role) {
                   echo $rolesResult[$role].",";
                 }
               }
               else echo "N/A" ;      
               ?>
             </label>
           </div>
             <div class="form-group margin">
              <label class="col-sm-6"><span class="pull-right">Profile Picture:</span></label>
              <label class="col-sm-6 user-header">
              <img src="<?php echo !empty($attachment['file_path'])?$attachment['file_path']:'images/anonymous.jpg';?>" class="img-circle profile-image" class="user-image" alt="User Image">
              </label>
            </div>
         </div>
       </div>
     </div>
   </div>
   <div class="li-edit" style="display:<?php echo (!empty($userdata))?'none':'';?>">
     <div class="box box-primary">
      <div class="box-body">         
        <form  id="update-userform" name="update-userform" action="" method="post" novalidate="novalidate">
          <input type="hidden" id="entity_id" name="entity_id" value="<?php  echo (!empty($userid))?$userid:0; ?>" /> 
          <div class="row">
            <div class="col-lg-6">
              <div class="form-group margin">
                <label><span class="text-error">*</span> Login Name</label>
                <input type="text"  id="login_name" name="login_name" value="<?php echo $userdata['login_name'];?>" maxlength="25" placeholder="Login Name" class="form-control" onBlur="chkempty(this.id,this.value)">
              </div>
            </div>
            <?php 
            if(empty($userid)){ ?>
            <div class="col-lg-6">
              <div class="form-group margin">
                <label><span class="text-error">*</span> Password</label>
                <input type="password" name="password" id="password" value="<?php echo $userdata['password'];?>" maxlength="25" placeholder="Password" class="form-control" onBlur="chkempty(this.id,this.value)">
              </div>
            </div>
            <?php } ?>
            <div class="col-lg-6 ">
              <div class="form-group  margin">
                <label ><span class="text-error">*</span> Full Name</label>

                <input type="text" name="name" id="name" value="<?php echo $userdata['name'];?>" maxlength="25" placeholder="Full Name" class="form-control" onBlur="chkempty(this.id,this.value)">
              </div>
            </div>
            <div class="col-lg-6">
              <div class="form-group  margin">
                <label > <span class="text-error">*</span> Email Id</label>
                <input type="hidden" id="isemailexists" name="isemailexists" value="0" />
                <input type="text" name="email" id="email" value="<?php echo $userdata['email'];?>" placeholder="Email Id" maxlength="35" class="form-control" onBlur="checkeusermailavailability(this.value,this.id,<?php echo $userid; ?>)">
              </div>
            </div>
            <div class="col-lg-6">
              <div class="form-group  margin">
                <label >Conatct Number</label>
                <input type="text" name="phone" id="phone" value="<?php echo $userdata['phone'];?>" maxlength="14" placeholder="Conatct Number"  class="form-control" onkeypress="return numbervalidation(event);" >
              </div>
            </div>
            <!--<div class="col-lg-6">
              <div class="form-group  margin">
                <label >Employee Id</label>    
                <input type="text" value="<?php echo $userdata['employeeid'];?>" id="employeeid" name="employeeid" maxlength="10" placeholder="Employee Id" class="form-control"/>
              </div>
            </div>-->
            <div class="col-lg-6">
              <div class="form-group  margin">
                <label>Type of User</label>
                <select class="form-control" name="usertype" id="usertype" >
                  <?php $typeofuser=$userdata['usertype'];?>
                  <option>Select type of user</option>
                  <option value="1" <?php echo ($typeofuser==1)?'selected':''?>>Super Admin</option>
                  <option value="2" <?php echo ($typeofuser==2)?'selected':''?>>Admin</option>
                  <option value="3" <?php echo ($typeofuser==3)?'selected':''?>>Vendor</option>
                  <option value="4" <?php echo ($typeofuser==4)?'selected':''?>>Customer</option>
                  <option value="5" <?php echo ($typeofuser==5)?'selected':''?>>Circle User</option>
                </select>
              </div>
            </div>
            <div class="col-lg-6">
             <div class="form-group margin">
               <label>User Status:</label>
               <label class="form-control" > 
                <input type="radio" class="flat-red" name="status"  id="status" value="0" 
                <?php echo ($userdata['status']==0)?' checked ':'';?> />
                Active                   
                <input type="radio" class="flat-red" name="status" id="status" value="1"
                <?php echo ($userdata['status']==1)?' checked ':'';?>  />
                Inactive
              </label>                    
            </div>
          </div>
          <div class="col-lg-6">
            <div class="form-group  margin">
              <label>Assign roles</label>
              <input type="hidden" id="hselectedroles" mulitselectvalues="<?php echo !empty($userdata['roles'])?$userdata['roles']:''; ?>">
              <select id="roles" name="roles[]" multiple="multiple" class="form-control">
               <?php               
               foreach ($rolesResult as $row) { ?>            
               <option value="<?php echo $row['id'] ;?>"><?php echo $row['name'] ;?></option>
               <?php }
             ?>
           </select>
         </div>
       </div>
        <div class="col-lg-6">
       <div class="form-group margin">
        <input type="hidden" id="file_type_" name="file_type" value="0">
        <label class="col-sm-3 control-label"><span class="text-error">*</span>Attach Profile</label>
        <div class="col-sm-8" >

          <input type="file" name="attachment_<?php  echo !empty($attachment)?$attachment['id']:''; ?>" id="attachment_<?php  echo !empty($attachment)?$attachment['id']:''; ?>" 
          onchange="uploadfiles('<?php  echo !empty($attachment)?$attachment['id']:''; ?>');" >
          <input type="hidden" value="<?php  echo !empty($attachment)?$attachment['file_name']:''; ?>" name="file_name" id="file_name_<?php  echo !empty($attachment)?$attachment['id']:''; ?>"><br>            
          <div id="divexistingfile_<?php  echo !empty($attachment)?$attachment['id']:''; ?>"  class="fileclass"> <?php
            if(!empty($attachment)){ ?>
            <a style="cursor:pointer;color:#0000CC;"><?php print $attachment['file_name'] ;?></a>
            <a  style="cursor: pointer" class="fa fa-times" 
            onclick="removefilefromattachment('divexistingfile_<?php  echo !empty($attachment)?$attachment['id']:''; ?>,'oldattachment_<?php  echo !empty($attachment)?$attachment['id']:''; ?>')" 
            title="Remove file"></a>|
            <a onclick="showfilecontent('<?php  print '/'.$attachment['file_path']; ?>');" title="View file" ><i class ="fa fa-eye"></i></a>|
            <a href="attachments/downloadfiles.php?filelocation=<?php  print '/'.$attachment['file_path']; ?>"><i class ="fa fa-download"></i></a>
            <?php
          }

          ?></div>
        </div>
      </div>
      </div>
    </div>


    <div class="savewizard">
      <div class="row">
        <div class="col-sm-7 " id="submituser_div">
          <?php  if($userid==0) { ?>
          <span class="btn btn-primary pull-right"><input type="checkbox" id="inviteuserbymail" name="inviteuserbymail"  />Invite user by Mail</span>
          <?php } ?>

        </div>      
        <div class="col-sm-5">
          <button class="btn btn-primary pull-right"  type="submit">Save</button>           
          <a href="javascript:void(0);" onclick="resetuserform();" id="btnresetuser" class="btn btn-primary pull-right">Reset</a>  
        </div>
      </div>  
    </div>
  </form>
</div>
</div>
</div>
</div>
<script type="text/javascript">
  (function($,W,D)
  {
    var JQUERY4U = {};

    JQUERY4U.UTIL =
    {
      setupFormValidation: function()
      {
            //form validation rules
            $("#update-userform").validate({
              rules: {
                login_name: "required",                    
                name:"required",
                usertype:"required",
                email: {
                  required: true,
                  email: true
                },
                password: {
                  required: true,
                  minlength: 5
                }                    
              },
              messages: {
                login_name: "Please enter user loginname",
                name: "Please enter user name",
                password: {
                  required: "Please provide a password",
                  minlength: "Your password must be at least 5 characters long"
                },
                email: "Please enter a valid email address"
              },
              submitHandler: function(form) {
                saveuserform();
              }
            });
          }
        }
            $("#roles").multiselect({
       includeSelectAllOption: true,
       enableCaseInsensitiveFiltering: true,
       maxHeight: 200      
     }); 
 editlist=function(){
        $('.li-view').css("display","none");
        $('.li-edit').css("display","");
      }
    //when the dom has loaded setup form validation rules
    $(D).ready(function($) {
      JQUERY4U.UTIL.setupFormValidation();
      if($("#hselectedroles").attr("mulitselectvalues"))
        $("#roles").multiselect('select', $("#hselectedroles").attr("mulitselectvalues")); 
    });

  })(jQuery, window, document);
</script>



