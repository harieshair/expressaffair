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
include_once(CLASSFOLDER."/vendor.php");
$vendor=new vendorclass();
$rows=20;
?>

</script>
<div id="gridcontent" class ="content">

<form  id="update-userform" name="update-userform" action="" method="post" novalidate="novalidate">
  <input type="hidden" id="user_id" name="user_id" value="<?php  echo (!empty($userid))?$userid:0; ?>" />
    <div class="box box-primary">
      <div class="box-body"> 
        <div class="row">
        <span>Under construction</span>
        </div>
        </div>
        </div>
        </form>
        </div>
<?php
$page=0;
//echo $user->showallvendor($page,$rows,null);
?>   
 
