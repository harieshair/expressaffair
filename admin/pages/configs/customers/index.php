<?php 
include_once($_SERVER['DOCUMENT_ROOT']."/eventconfig.php");
include_once(CLASSFOLDER."/dbconnection.php");
include_once(CLASSFOLDER."/customer.php");
$customer=new customerclass($dbconnection->dbconnector);
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
					<h3 class="box-title">Custromers</h3>
				</div>	
				<div class="box-body">
					<div id="example2_wrapper" class="dataTables_wrapper form-inline" role="grid">

						<?php
						$resultSet= $customer->getAllCustomers($page-1,$rows,null);
						$totalCustomers=$resultSet['totlaRows'];
						if($totalCustomers>0){ 
							$Items=$resultSet['items'];
							unset($resultSet);
							?>	
							<table id="customertable" class="table table-bordered table-hover dataTable" aria-describedby="example2_info">
								<thead><tr >
									<th>Id</th>
									<th>Name</th>
									<th>Email</th>
									<th >City</th>
									<th >Contact Number</th>
									<th >Created On</th>
								</tr>
							</thead> 
							<?php 
							foreach ($Items as $rowdata) { ?>
							<tr >
								<td ><?php echo $rowdata['id']; ?></td>
								<td ><?php echo $rowdata['name']; ?></td>			  
								<td><?php echo $rowdata['email'] ;?></td>
								<td><?php echo $rowdata['city'] ;?></td>
								<td><?php echo $rowdata['contact_number'] ;?></td>
								<td><?php echo $rowdata['contact_number'] ;?></td>

							</tr>	
							<?php 
						} ?>
					</table>
					<table class="table" style="width:100%;height:30px">
						<tr class="gridPaging"><td style="float:right">Total Records : <?php echo $totalCustomers;?> </td></tr>
					</table> 
					<?php 
				}
				else
					{ ?>
				<div class="alert alert-warning"><strong>Message!</strong><br> No Records Found.</div>
				<?php }
				?>

			</div>
		</div>
	</div>
</div>
</div>
</div>