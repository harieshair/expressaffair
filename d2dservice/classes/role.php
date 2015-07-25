	<?php
	include_once(CLASSFOLDER."/dbconnection.php");
	include_once(CLASSFOLDER."/enums.php");
	$dbconnect=null;
	class roleclass extends dbconnection {


		/*-------------------------------------------------------------*/
	function roleclass() // Constructor 
	{
		parent::__construct();
	}
	/* -----------------------------------------------------------------------------*/
	function CreateRole($roleName)
	{
		$response=array();		
		$oldRoleId=$this->internalDB->queryFirstField("SELECT id FROM roles where name ='$roleName'");		
		if($oldRoleId==null){
			$this->internalDB->insert('roles',array(
				'name'=>$roleName));
			$response['id']=$this->internalDB->insertId();
			return $response;
		}
		else{
			 $response['Exception']='Specified role name already exists';
			 return $response;
			}
	}
	/*---------------------------------------------------------------*/
	function showAllRoles(){	
		$sql="SELECT * FROM roles ";
		$rolelist = $this->internalDB->query("$sql");
		$table ='<div class="row">
		<div class="col-xs-12">
			<div class="box">
				<div class="box-header">
					<h3 class="box-title">Roles</h3>
				</div>
				<div class="box-body">
					<div id="example2_wrapper" class="dataTables_wrapper form-inline" role="grid"><div class="row"><div class="col-xs-6"></div><div class="col-xs-6"></div></div>';	

					$table .= '<table id="example2" class="table table-bordered table-hover dataTable" aria-describedby="example2_info">
					<thead><tr >
						<th> Id</th>
						<th >Role Name</th>		
					</tr></thead>';
					if(count($rolelist)>0){
						foreach ($rolelist as $rowdata) {
							$table .= '<tr ><td >'.$rowdata['id'].'</td>';
							$table .= '<td>'.$rowdata['name'].'</td>';			 
							$table .= '</tr>';
						}
						$table .="</table>";
					}
					else
					{
						$table ='<div class="alert alert-warning"><strong>Message!</strong><br> No Records Found.</div>';
					}		
					return $table;	
				}
			}
