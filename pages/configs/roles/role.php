<?php 
if(!isset($_SESSION)){session_start();}

include_once($_SERVER['DOCUMENT_ROOT']."/d2dconfig.php");
include_once(CLASSFOLDER."/role.php");
$role=new roleclass();
?>
<div class="actionWizard"><a title="Create Role" class="btn btn-primary pull-right btn-xs" href="javascript:void(0)" onclick="getcontents('pages/configs/roles/createrole.php','content');"><i class="glyphicon  glyphicon-plus-sign"></i>New Role</a>
</div>
<div id="gridcontent" class ="content">
<?php
$page=0;
echo $role->showAllRoles();
?>   
<div class="pull-right"><a href="javascript:void(0);" id="backtotop" style="display:none" onclick="clicktotop()" class="btn btn-default-inverse btn-xs"><i class="glyphicon  glyphicon-arrow-up white"></i> Back to Top</a>
</div>  
</div><!--/row--><br />