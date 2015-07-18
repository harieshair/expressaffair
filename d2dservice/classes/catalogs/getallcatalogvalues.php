<?php
	$sql ="SELECT count(id) FROM catalog_value ";
	$whrqury=" where catalogmaster_id =$catalogmasterid ";
	$sql.=$whrqury;
	$totcount = $this->internalDB->queryFirstField($sql);
	if($totcount>0)
	{
		//$pages=ceil($totcount/$rows);
//		$page = $page == "" ? 0 : $page;
//		$start=$page * $rows;
		$searchqury="SELECT id,catalog_value,catalogvalue_id from  catalog_value ".$whrqury;
		$result = $this->internalDB->query("$searchqury ORDER BY id asc ");//LIMIT $start, $rows
	?>
	<div class="row"><div class="col-md-1"></div><div class="col-md-10 "><div class="row gridHeaderch1">
    <div class="col-md-1"><strong>Value Id</strong></div>
    <div class="col-md-2">Value Name</div>
	<div class="col-md-2">Parent</div>
	</div>
    <div class="row"><div class="col-md-12 catalogvalugrid">
    
	<?php	foreach($result as $rowdata)
	{
	?>
		<div class="row">
		<div class="col-md-1"><?php echo $rowdata['id'];?></div>
  		<div class="col-md-2"><?php echo $rowdata['catalog_value'];?></div>
   		<div class="col-md-2"><?php echo $rowdata['catalogvalue_id'];?></div>
		</div>
   <?php } ?></div></div></div></div>
	<?php } else
		echo '<div class="alert"><strong>Message!</strong><br> No Records Found.</div>';
	
	?>