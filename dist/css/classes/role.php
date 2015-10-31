	<?php
	include_once(CLASSFOLDER."/enums.php");
	class roleclass {

public $internalDB;	
	/*-------------------------------------------------------------*/
	function roleclass($db) // Constructor 
	{
		$this->internalDB=$db;
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
