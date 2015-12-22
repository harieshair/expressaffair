<?php 
include_once($_SERVER['DOCUMENT_ROOT']."/eventconfig.php");
include_once(CLASSFOLDER."/dbconnection.php");
include_once(CLASSFOLDER."/role.php");
$role=new roleclass($dbconnection->dbconnector);
?>
<div id="gridcontent" class ="content">
	<div class="row">
		<div class="col-xs-12">
			<div class="box">
				<div class="box-header">
					<h3 class="box-title">Roles</h3>
					<a title="Create Role" class="btn btn-primary pull-right btn-xs" href="javascript:void(0)" onclick="getcontents('pages/configs/roles/createrole.php','content');"><i class="glyphicon  glyphicon-plus-sign"></i>New Role</a>
				</div>
				<div class="box-body">
					<div id="example2_wrapper" class="dataTables_wrapper form-inline" role="grid"><div class="row"><div class="col-xs-6"></div><div class="col-xs-6"></div></div>
					<?php
					$page=0;
					$roles =$role->showAllRoles();

					if(!empty($roles) && count($roles)>0 ){ ?>
					<table id="example2" class="table table-bordered table-hover dataTable" aria-describedby="example2_info">
						<thead><tr >
							<th> Id</th>
							<th >Role Name</th>		
						</tr></thead>
						<?php
						foreach ($roles as $rowdata) {?>
						<tr ><td ><?php echo $rowdata['id']; ?></td>
							<td><?php echo $rowdata['name'] ;?></td>
						</tr>
						<?php } ?>
					</table>

					<?php	}

					else
						{ ?>
					<div class="alert alert-warning"><strong>Message!</strong><br> No Records Found.</div>
					<?php } ?>   
				</div>
			</div>
		</div>
	</div>
</div>
</div>



