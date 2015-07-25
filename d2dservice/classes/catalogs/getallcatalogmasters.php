	<?php
		$sql ="SELECT count(id) FROM catalog_master ";
		$whrqury=' where name is not null ';
		if($searchobj!=null){
			$whrqury.=!empty($searchobj->catalogmasterid)?" and catalog_master_id=$searchobj->catalogmasterid ":'';
			$whrqury.=!empty($searchobj->catalogmastername)?" and catalog_master_name like '%$searchobj->catalogmastername%' ":'';
			$whrqury.=!empty($searchobj->description)?" and catalog_master_description like '%$searchobj->description%' ":'';
			$whrqury.=!empty($searchobj->code)?" and catalog_master_code like '%$searchobj->code%' ":'';
		}
		$sql.=$whrqury;
		$totcount = $this->internalDB->queryFirstField($sql);
		if($totcount>0)
		{
			$pages=ceil($totcount/$rows);
			$page = $page == "" ? 0 : $page;
			$start=$page * $rows;
			$searchqury="SELECT id,name,description from  catalog_master ".$whrqury;
			$result = $this->internalDB->query("$searchqury ORDER BY id ASC LIMIT $start, $rows");
		?>
		<div class="row">
			<div class="col-xs-12">
				<div class="box">
					<div class="box-header">
						<h3 class="box-title">Catalog List</h3>
					</div>
					<div class="box-body">
						<div id="example2_wrapper" class="dataTables_wrapper form-inline" role="grid">						
	<table id="catalogtable" class="table table-bordered table-hover dataTable" aria-describedby="example2_info">

		<thead><tr >
							<th></th>
			<th>Catalog Id</th>
			<th >Catalog Name</th>
			<th >Description</th>
			<th>Modify</th>
			</tr></thead>
		<?php	foreach($result as $rowdata)
		{
		?>
			<tr>
			<td><a id="anchorcataloghierarchical_<?php echo $rowdata['id'];?>" 
				onclick="showcataloghierarchical(<?php echo $rowdata['id']; ?>);" href="javascript:void(0);" class="btn glyphicon glyphicon-plus inverse"></a></td>
			<td><?php echo $rowdata['id'];?></td>
	   		<td ><?php echo $rowdata['name'];?></td>
	   		<td ><?php echo $rowdata['description'];?></td>
	   		
			<td><a href="javascript:void(0);" title="Add/Update" onClick="getcontents('pages/configs/catalogs/addupdatecatalogs.php','content',<?php echo $rowdata['id'];?>)" ><i class="glyphicon  glyphicon-pencil"></i></a></td>
			</tr>
	        <tr id="catalogvaluestr_<?php echo $rowdata['id']; ?>" style="display:none"> </tr>
	   <?php } ?></table>
		<?php unset($searchobj,$obj,$result);  ?>
		<div class="row" ><div class="col-sm-12 well-sm  gridPaging"><div class="pull-right">Total Records : <?php echo $totcount; ?></div></div></div>
		<?php } else
			echo '<div class="alert"><strong>Message!</strong><br> No Records Found.</div>';
		
		?>