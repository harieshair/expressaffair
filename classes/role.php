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
		return $rolelist;	
				}
			}
