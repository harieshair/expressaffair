<?php 
		$communitynames=array();
		$resultset= $this->internalDB->query("SELECT id,name FROM communities" );
		foreach ($resultset as $row) {
			$communitynames[$row['id']]=$row['name'];
		}
		return $communitynames;
?>