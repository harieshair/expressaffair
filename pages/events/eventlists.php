<?php 
if(!isset($_SESSION)){session_start();}
include_once($_SERVER['DOCUMENT_ROOT']."/eventconfig.php");
include_once(CLASSFOLDER."/dbconnection.php");
include_once(CLASSFOLDER."/events.php");
$events=new eventclass($dbconnection->dbconnector);
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
					<h3 class="box-title">Event List</h3>
						<a title="Update Event" class="btn btn-default pull-right btn-sm " href="javascript:void(0)" 
                    onclick="getcontents('pages/events/updateevents.php','content')" > <i class="glyphicon glyphicon-plus-sign"></i>Add New</a>
				</div>	
				<div class="box-body">
					<div id="example2_wrapper" class="dataTables_wrapper form-inline" role="grid">
						<?php
						$totalEvents= $events->getTotalEvents(null);
						if($totalEvents>0){ 
							if($totalEvents>=($page-1) * $rows){
								$eventlists= $events->getalleventlists($page,$rows,null);
								?>	
								<table id="eventtable" class="table table-bordered table-hover dataTable" aria-describedby="example2_info">
									<thead><tr >
										<th>Event Id</th>
										<th>Event Name</th>
										<th >Description</th>
										<th >Creatd On</th>
										<th >Icon</th>											
									</tr></thead> 
									<?php 
									foreach ($eventlists as $rowdata) { ?>
									<tr >
										<td ><?php echo $rowdata['id']; ?></td>
										<td><a  title="Edit Event" href="javascript:void(0)" 
											onclick="getcontents('pages/events/updateevents.php','content', <?php echo $rowdata['id']; ?>);"> 
											<?php  echo $rowdata['name']; ?></a></td>
											<td ><?php echo $events->closetags(substr($rowdata['description'],0,80)); ?></td>			  
											<td><?php echo $rowdata['created_on'] ;?></td>
											<td > <?php echo $rowdata['icons'];?> </td>											
										</tr>
										<?php 
									} ?>
								</table>
								<table class="table" style="width:100%;height:30px"><tr class="gridPaging"><td style="float:right">Total Records : <?php echo $totalEvents;?> </td></tr></table> 
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