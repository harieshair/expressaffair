<?php 
include_once($_SERVER['DOCUMENT_ROOT']."/eventconfig.php");
include_once(CLASSFOLDER."/dbconnection.php");
include_once(CLASSFOLDER."/rituals.php");
$rituals=new ritualclass($dbconnection->dbconnector);
$searchObject=isset($_POST['postvalue'])?$_POST['postvalue']:null;
if(!empty($searchObject)){
	$rows=$searchObject['rows'];
	$page=$searchObject['page'];
}
else{
	$rows=20;
	$page=1;
}
?>

<div id="gridcontent" class ="content">
	<div class="row">
		<div class="col-xs-12">
			<div class="box">
				<div class="box-header">
					<h3 class="box-title">Ritual List</h3>
						<a title="Update Event" class="btn btn-default pull-right btn-sm " href="javascript:void(0)" 
                    onclick="getcontents('pages/events/updaterituals.php','content')" > <i class="glyphicon glyphicon-plus-sign"></i>Add New</a>
				</div>	
				<div class="box-body">
					<div id="example2_wrapper" class="dataTables_wrapper form-inline" role="grid">
						<?php
						$totalRituals= $rituals->getTotalRituals(null);
						if($totalRituals>0){ 
							if($totalRituals>=($page-1) * $rows){
								$rituallists= $rituals->getallRitualLists($page,$rows,null);
								?>	
								<table id="eventtable" class="table table-bordered table-hover dataTable" aria-describedby="example2_info">
									<thead><tr >
										<th>Seq No</th>
										<th>Title</th>
										<th >Description</th>
										<th> Services</th>																					
									</tr></thead> 
									<?php 
									foreach ($rituallists as $rowdata) { ?>
									<tr >
										<td ><?php echo $rowdata['id']; ?></td>
										<td><a  title="Edit Event" href="javascript:void(0)" 
											onclick="getcontents('pages/events/updaterituals.php','content', <?php echo $rowdata['id']; ?>);"> 
											<?php  echo $rowdata['title']; ?></a></td>
											<td ><?php echo $rowdata['description']; ?></td>
											<td > <?php echo $rowdata['services'];?> </td>											
										</tr>
										<?php 
									} ?>
								</table>
								<table class="table" style="width:100%;height:30px"><tr class="gridPaging"><td style="float:right">Total Records : <?php echo $totalRituals;?> </td></tr></table> 
								<?php 
							}
							else
								{ ?>
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