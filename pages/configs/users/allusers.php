<?php 
if(!isset($_SESSION)){session_start();}
/*if(!isset($_SESSION['hpadminloginstatus']) || $_SESSION['hpadminloginstatus']!="HPAdminLoggedIn")
{
	include_once("login_again.php");
	exit();
}
$navactive="createuser";*/

//$access=$_SESSION['action_list'];
include_once($_SERVER['DOCUMENT_ROOT']."/eventconfig.php");
include_once(CLASSFOLDER."/user.php");
$user=new userclass();
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
					<h3 class="box-title">User List</h3>
					<a title="Create User" class="btn btn-default pull-right btn-sm " href="javascript:void(0)" 
	onclick="getcontents('pages/configs/users/updateuser.php','content');" > <i class="glyphicon  glyphicon-plus-sign"></i>New User</a>
				</div>	
				<div class="box-body">
					<div id="example2_wrapper" class="dataTables_wrapper form-inline" role="grid">

						<?php
						$totalUsers= $user->getTotalUsers(null);
						if($totalUsers>0){ 
							if($totalUsers>=($page-1) * $rows){
								$userList= $user->showAllUsers($page,$rows,null);
								?>	
								<table id="usertable" class="table table-bordered table-hover dataTable" aria-describedby="example2_info">
									<thead><tr >
										<th>User Id</th>
										<th>Login Name</th>
										<th >User Name</th>
										<th >Email Id</th>
										<th >Contact Number</th>
										<th >Employee Id</th>				
										<th >User Type</th>
										<th >Status</th>	
									</tr></thead> 
									<?php 
									foreach ($userList as $rowdata) { ?>
									<tr >
										<td ><?php echo $rowdata['id']; ?></td>
										<td><a  title="Create User" href="javascript:void(0)" 
											onclick="getcontents('pages/configs/users/updateuser.php','content', <?php echo $rowdata['id']; ?>);"> 
											<?php  echo $rowdata['login_name']; ?></a></td>
											<td ><?php echo $rowdata['name']; ?></td>			  
											<td><?php echo $rowdata['email'] ;?></td>
											<td > <?php echo $rowdata['phone'];?> </td>
											<td>  <?php echo $rowdata['employeeid']; ?></td>
											<td ><?php  echo  $user->TypeOfUser->getvalue($rowdata['usertype']);?> </td>
											<td ><?php echo ($rowdata['status']==0)?'Active':'Inactive';?> </td>
										</tr>
										<?php 
									} ?>
								</table>
								<table class="table" style="width:100%;height:30px"><tr class="gridPaging"><td style="float:right">Total Records : <?php echo $totalUsers;?> </td></tr></table> 
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