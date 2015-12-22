<?php 
include_once($_SERVER['DOCUMENT_ROOT']."/eventconfig.php");
include_once(CLASSFOLDER."/dbconnection.php");
include_once(CLASSFOLDER."/events.php");
$event=new eventclass($dbconnection->dbconnector);
?>
<div id="gridcontent" class ="content">

	<div class="box box-primary">
		<div class="box-body"> 
			<div class="row">
				<span>Under construction</span>
			</div>
		</div>
	</div>
</div>