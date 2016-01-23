<?php
include_once(CLASSFOLDER . "/dbconnection.php");
include_once(CLASSFOLDER . "/coordinator.php");

class coordinatorservice {

    public $internalDB = null;
    public $coordinator = null;
    function coordinatorservice($db) {
        $this->internalDB = $db;        
        $this->coordinator = new coordinatorclass($this->internalDB);
    }
    function getCoordinatorById($coordinatorId){
       $resultSet= $this->coordinator->getCoordinatorById($coordinatorId);
       return $resultSet;
    }
}

