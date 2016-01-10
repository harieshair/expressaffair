<?php
include_once(CLASSFOLDER . "/enums/commonenums.php");
class coordinatorclass {
    public $internalDB;
    function coordinatorclass($db) { // Constructor 
        $this->internalDB = $db;
    }
    function getCoordinatorById($coordinatorId){
	$resultSet= $this->internalDB->queryFirstRow("SELECT u.id,u.name,u.login_name,u.phone,u.email,u.usertype,u.status,
		u.employeeid,u.password,u.photo_id,u.roles,u.address,u.city,u.state,c.coord_explevel,c.is_third_party FROM users u INNER JOIN coordinator c ON u.id=c.user_id where u.id=$coordinatorId");
	return $resultSet;
    }    
}