<?php 
if(!isset($_SESSION)){session_start();}
include_once($_SERVER['DOCUMENT_ROOT']."/d2dconfig.php");
include_once(CLASSFOLDER."/catalogs.php");
$catalog=new catalogclass();
$rows = 20;
$page = 0;
?>

<!--<script type="text/javascript" src="../scripts/catalogs.js"></script>-->
<div class="actionWizard">
<a onclick="getcontents('pages/catalogs/addupdatecatalogs.php','content')" class="btn btn-primary pull-right btn-xs" title="Add New Catalog List"><i class="glyphicon  glyphicon-plus-sign"></i>New Catalog</a>
<a onclick="Toggledivshow('catalogsearchdiv');" class="btn  btn-primary pull-right btn-xs" title="Search"><i class="glyphicon  glyphicon-search"></i> Search</a>
</div>
<div id="gridcontent" class ="content">

<?php
$searchobj=null;
echo $catalog->showManageCatalogs(0,$rows,$searchobj);
?>     
</div>
<script src="scripts/catalogs.js" type="text/javascript"></script>

