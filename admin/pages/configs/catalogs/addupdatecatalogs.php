<?php 
$catalogmasterid=isset($_POST['postvalue'])?$_POST['postvalue']:0;;
include_once($_SERVER['DOCUMENT_ROOT']."/eventconfig.php");
include_once(CLASSFOLDER."/dbconnection.php");
include_once(CLASSFOLDER."/catalogs.php"); 
$catalog = new catalogclass($dbconnection->dbconnector);
?>
<style type="text/css">
#catalogvaluelist td{ text-align:center;}
#catalogvaluelist {border-collapse:collapse;
     border: 1px solid #B4A2A2; }
</style>
<script type="text/javascript">
$(document).ready(function(){
addedcatalogs=[];
removedcatalogs=[];
did=0;
});
</script>

<?php 
if(empty($catalogmasterid))
	include_once("newcatalogmaster.php");
else
	include_once("editcatalogmaster.php");
?>




