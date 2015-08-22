  <?php 
  if(!isset($_SESSION)){session_start();}
  if(isset($_POST['postvalue']))
  	$userid=$_POST['postvalue'];
  include_once($_SERVER['DOCUMENT_ROOT']."/eventconfig.php");
  include_once(CLASSFOLDER."/enums.php");
  $typeofuser=new TypeOfUser;
  $userstatus=new UserStatus;

  include_once(CLASSFOLDER."/user.php");
  $user=new userclass();
  if(!empty($userid)){
    $userdata=$user->getuserbyid($userid);    
  }
  else{
  	$userid=0;
    $userdata=array(
      'login_name'=>"",
      'name'=>"",
      'email'=>"",
      'phone'=>"",
      'usertype'=>"",
      'status'=>"",
      'employeeid'=>"",
      'password'=>""
      );
  }
  $assignedRoles=array();
  ?>
<style type="text/css">
  #update-userform .form-group label.error {
    color: #FB3A3A;
    display: inline-block;   
    text-align: left;    
}
</style>
  <form  id="update-userform" name="update-userform" action="" method="post" novalidate="novalidate">
  <input type="hidden" id="user_id" name="user_id" value="<?php  echo (!empty($userid))?$userid:0; ?>" />
    <div class="box box-primary">
      <div class="box-body"> 
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
          <div class="col-lg-6">
            <div class="form-group  margin">
              <label >Employee Id</label>    
              <input type="text" value="<?php echo $userdata['employeeid'];?>" id="employeeid" name="employeeid" maxlength="10" placeholder="Employee Id" class="form-control"/>
            </div>
          </div>
          <div class="col-lg-6">
            <div class="form-group  margin">
              <label>Type of User</label>
              <select class="form-control" name="usertype" id="usertype" >
                <?php $typeofuser=$userdata['usertype'];?>
                <option>Select type of user</option>
                <option value="1" <?php echo ($typeofuser==1)?'selected':''?>>Super Admin</option>
                <option value="2" <?php echo ($typeofuser==2)?'selected':''?>>Admin</option>
                <option value="3" <?php echo ($typeofuser==3)?'selected':''?>>Merchandiser</option>
                <option value="4" <?php echo ($typeofuser==4)?'selected':''?>>Vendor</option>
                <option value="5" <?php echo ($typeofuser==5)?'selected':''?>>Customer</option>
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
            <div class="col-lg-7">
              <label>Assign roles</label>
              <select multiple="1" class="form-control" name="role" id="role"  >
                <?php 

                $rolesResult=$user->internalDB->query("select  name,id from roles ");
                if(!empty($userid))
                  $assignedRoles=$user->internalDB->queryFirstColumn("select  role_id from user_role where user_id=$userid ");
                $liRole='';
                foreach($rolesResult as $row)
                {
                 if(in_array($row['id'],$assignedRoles)){
                  $liRole.='<li>'.$row['name'].'</li>';
                }
                else{
                  echo '<option value="'.$row['id'].'">'.$row['name'].'</option>';
                }
              }
              ?>
            </select>
            </div>
            <div class="col-lg-5"><ul id="roleList"><?php echo $liRole;?></ul></div>
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
 
    //when the dom has loaded setup form validation rules
    $(D).ready(function($) {
        JQUERY4U.UTIL.setupFormValidation();
    });
 
})(jQuery, window, document);
</script>



