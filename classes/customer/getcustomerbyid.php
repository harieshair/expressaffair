<?php
	$resultSet= $this->internalDB->queryFirstRow("SELECT id,name,email,password,city,state,contact_number,address FROM customers where id=$customerid");
	return $resultSet;
?>