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
	<div class="row" >
    <div class="col-md-12 gridPaging">
    <div class="row_fluid" id="catalogmastertable" page="<?php echo $page; ?>">
    <div class="col-md-2"> Total Records : <?php echo $totcount;?> </div>
	<div class="col-md-1"><a class="glyphicon  glyphicon-refresh inverse" title="Refresh" href="javascript:void(0)" onclick="showmngcatalogpaging(<?php echo $page; ?>);"></a></div>
	<div class="col-md-1"><div style="float:left; display:inline">
    <select onchange="showmngcatalogpaging(0)" name="rows" id="rows" class="input-sm">
    <option value="20">20</option>
    <option value="50">50</option>
    <option value="75">75</option>
    <option value="100">100</option>
    </select></div></div>
	<div class="col-md-8"><span class="pagination pagination-mini"><ul class="pagination pagination-sm"> <?php echo $this->catalogpagination($totcount,$page,$rows,$searchobj);?>
	 </ul></span></div>
      </div>
     </div>
     </div>

	<div class="row" style="border: 1px solid #ABBFD3;"><div class="col-md-12 "><div class="row well-sm  gridHeader">
    <div class="col-md-1"><span class="btn"></span></div>
    <div class="col-md-1"><strong>Catalog Id</strong></div>
    <div class="col-md-2">Catalog Name</div>
	<div class="col-md-3">Description</div>	
  	<div class="col-md-1">Modify</div>
	</div>
	<?php	foreach($result as $rowdata)
	{
	?>
		<div class="row show-grid gridrow">
		<div class="col-md-1"><a id="anchorcataloghierarchical_<?php echo $rowdata['id'];?>" 
			onclick="showcataloghierarchical(<?php echo $rowdata['id']; ?>);" href="javascript:void(0);" class="btn glyphicon glyphicon-plus inverse"></a></div>
		<div class="col-md-1"><?php echo $rowdata['id'];?></div>
   		<div class="col-md-2"><?php echo $rowdata['name'];?></div>
   		<div class="col-md-3"><?php echo $rowdata['description'];?></div>
   		
		<div class="col-md-1"><a href="javascript:void(0);" title="Add/Update" onClick="getcontents('pages/catalogs/addupdatecatalogs.php','content',<?php echo $rowdata['id'];?>)" ><i class="glyphicon  glyphicon-pencil"></i></a></div>
		</div>
        <div class="row" id="catalogvaluestr_<?php echo $rowdata['id']; ?>" style="display:none"> </div>
   <?php } ?></div></div>
	<?php unset($searchobj,$obj,$result);  ?>
	<div class="row" ><div class="col-sm-12 well-sm  gridPaging"><div class="pull-right">Total Records : <?php echo $totcount; ?></div></div></div>
	<?php } else
		echo '<div class="alert"><strong>Message!</strong><br> No Records Found.</div>';
	
	?>