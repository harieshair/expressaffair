<?php 
if(!isset($_SESSION)){session_start();}
include_once($_SERVER['DOCUMENT_ROOT']."/eventconfig.php");
include_once(CLASSFOLDER."/dbconnection.php");
include_once(CLASSFOLDER."/catalogs.php");
$catalog=new catalogclass($dbconnection->dbconnector);
$rows = 20;
$page = 0;
?>

<!--<script type="text/javascript" src="../scripts/catalogs.js"></script>-->
<div id="gridcontent" class ="content">
	<div class="row">
		<div class="col-xs-12">
			<div class="box">
				<div class="box-header">
					<a onclick="getcontents('pages/configs/catalogs/addupdatecatalogs.php','content')" class="btn btn-default pull-right btn-sm " title="Add New Catalog List"><i class="glyphicon  glyphicon-plus-sign"></i>New Catalog</a>
					<a onclick="Toggledivshow('catalogsearchdiv');" class="btn btn-default pull-right btn-sm " title="Search"><i class="glyphicon  glyphicon-search"></i> Search</a>						<h3 class="box-title">Catalog List</h3>
				</div>
				<div class="box-body">
					<div id="example2_wrapper" class="dataTables_wrapper form-inline" role="grid">		
						<?php
						$searchobj=null;
						$totalCatalogs= $catalog->getTotalCataolgs(null);
						if($totalCatalogs>0)
						{ 
							if($totalCatalogs>=($page-1) * $rows)
							{
								$catalolists= $catalog->GetAllCatalogList($page,$rows,null);
								?>	
								<table id="catalogtable" class="table table-bordered table-hover dataTable" aria-describedby="example2_info">

									<thead><tr >
										<th></th>
										<th>Catalog Id</th>
										<th >Catalog Name</th>
										<th >Description</th>
										<th>Modify</th>
									</tr></thead>
									<?php	
									foreach($catalolists as $rowdata)
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
											<?php
										}
										?>
									</table>
									<?php unset($searchobj,$obj,$result);  ?>
									<div class="row" ><div class="col-sm-12 well-sm  gridPaging"><div class="pull-right">Total Records : <?php echo $totalCatalogs; ?></div></div></div>
									<?php }
									else	{ ?>
									<div class="alert alert-warning"><strong>Message!</strong><br> No Records Found.</div>
									<?php }
								} 
								else { ?> 
								<div class="alert alert-warning"><strong>Message!</strong><br> No Records Found.</div>
								<?php }	?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>


		<script src="scripts/catalogs.js" type="text/javascript"></script>

