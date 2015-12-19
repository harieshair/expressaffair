 <?php 
 include_once($_SERVER['DOCUMENT_ROOT']."/eventconfig.php");
 include_once(CLASSFOLDER."/dbconnection.php");
 include_once(CLASSFOLDER."/communities.php");
 $community=new communityclass($dbconnection->dbconnector);
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
 					<h3 class="box-title">Community List</h3>
 					<a title="Create Community" class="btn btn-default pull-right btn-sm " href="javascript:void(0)" 
 					onclick="getcontents('pages/events/updatecommunities.php','content');" > <i class="glyphicon  glyphicon-plus-sign"></i>Add new community</a>
 				</div>	
 				<div class="box-body">
 					<div id="example2_wrapper" class="dataTables_wrapper form-inline" role="grid">
 						<?php
 						$totlaCommunities= $community->getTotalCommunities(null);
 						if($totlaCommunities>0){ 
 							if($totlaCommunities>=($page-1) * $rows){
 								include_once(CLASSFOLDER."/catalogs.php");
 								$catalog=new catalogclass($dbconnection->dbconnector);
 								$catalogArray=$catalog->GetAllCatalogValuesByMasterNames("State,Zone");
 								$communitylist= $community->getallcommunityLists($page,$rows,null);
 								?>	
 								<table id="communitytable" class="table table-bordered table-hover dataTable" aria-describedby="example2_info">
 									<thead><tr >
 										<th>Community Id</th>
 										<th>Name</th>
 										<th >States</th>
 										<th >Zones</th>
 										<th >Created On</th>											
 									</tr></thead> 
 									<?php 
 									foreach ($communitylist as $rowdata) { ?>
 									<tr >
 										<td ><?php echo $rowdata['id']; ?></td>
 										<td><a  title="Edit Community" href="javascript:void(0)" 
 											onclick="getcontents('pages/events/updatecommunities.php','content', <?php echo $rowdata['id']; ?>);"> 
 											<?php  echo $rowdata['name']; ?></a></td>
 											<td><?php 
 												if(!empty($rowdata['states'])){
 													$statearray=explode(",", $rowdata['states']);
 													foreach ($statearray as $state) {
 														echo $catalogArray[$state].',';
 													}
 												}
 												?>
 											</td>
 											<td > <?php 
 												if(!empty($rowdata['zones'])){
 													$zonearray=explode(",", $rowdata['zones']);
 													foreach ($zonearray as $zone) {
 														echo $catalogArray[$zone].',';
 													}
 												}
 												?></td>	
 												<td><?php echo $rowdata['created_on'] ;?></td>										
 											</tr>
 											<?php 
 										} ?>
 									</table>
 									<table class="table" style="width:100%;height:30px"><tr class="gridPaging"><td style="float:right">Total Records : <?php echo $totlaCommunities;?> </td></tr></table> 
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
