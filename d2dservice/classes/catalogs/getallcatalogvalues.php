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
	<div class="row">
	<div class="col-xs-1"></div>
			<div class="col-xs-10">										
	<table>
		<tr><thead>
	<th><strong>Value Id</strong></th>
    <th> Name</th>
	<th>Parent</th>
	</thead></tr>
    
	<?php	foreach($result as $rowdata)
	{
	?>
		<tr>
		<td><?php echo $rowdata['id'];?></td>
  		<td><?php echo $rowdata['catalog_value'];?></td>
   		<td><?php echo $rowdata['catalogvalue_id'];?></td>
		</tr>
   <?php } ?></table></div></div>
	<?php }
	 else
		echo '<div class="alert"><strong>Message!</strong><br> No Records Found.</div>';
	
	?>