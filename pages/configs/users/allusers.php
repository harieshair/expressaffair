<?php 
if(!isset($_SESSION)){session_start();}
/*if(!isset($_SESSION['hpadminloginstatus']) || $_SESSION['hpadminloginstatus']!="HPAdminLoggedIn")
{
	include_once("login_again.php");
	exit();
}
$navactive="createuser";*/

//$access=$_SESSION['action_list'];
include_once($_SERVER['DOCUMENT_ROOT']."/eventconfig.php");
include_once(CLASSFOLDER."/user.php");
$user=new userclass();
$rows=20;
?>

</script>
<div class="actionWizard"><a title="Create User" class="btn btn-primary pull-right btn-xs " href="javascript:void(0)" onclick="getcontents('pages/configs/users/createuser.php','content');"><i class="glyphicon  glyphicon-plus-sign"></i>New User</a>
</div>
<div id="gridcontent" class ="content">
<?php
$page=0;
echo $user->showAllUsers($page,$rows,null);
?>   
<div class="pull-right"><a href="javascript:void(0);" id="backtotop" style="display:none" onclick="clicktotop()" class="btn btn-default-inverse btn-xs"><i class="glyphicon  glyphicon-arrow-up white"></i> Back to Top</a>
</div>  
</div><!--/row--><br />
