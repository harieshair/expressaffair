<?php 
if(!isset($_SESSION)){session_start();}
include_once($_SERVER['DOCUMENT_ROOT']."/d2dconfig.php");
include_once(CLASSFOLDER."/catalogs.php");
$catalog=new catalogclass();
$rows = 20;
$page = 0;
?>

<!--<script type="text/javascript" src="../scripts/catalogs.js"></script>-->
<section class="content" id="content">
<div class="row alert alert-info well-sm">
<div class="col-md-4" style="float:left;"><b>Settings</b>/ <span class="muted"><b>Catalog Management</b></span></div>
<div class="col-md-5"> <span id="gridaction_response"></span></div>
<div class="col-md-2"><a onclick="getcontents('pages/catalogs/addupdatecatalogs.php','content')" class="btn btn-default-inverse btn-xs" title="Add New Catalog List"><i class="glyphicon  glyphicon-plus-sign"></i>New Catalog</a></div>
<div class="col-md-1"><a onclick="Toggledivshow('catalogsearchdiv');" class="btn btn-default-inverse btn-xs" title="Search"><i class="glyphicon  glyphicon-search"></i> Search</a></div>
</div>

<?php include_once("catalogsearchpane.php"); ?>

<div id="content" class="content" >
<?php
$searchobj=null;
echo $catalog->showManageCatalogs(0,$rows,$searchobj);

?>     
</div>
</section>
<script src="scripts/catalogs.js" type="text/javascript"></script>

