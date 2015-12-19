<?php
$ritualnames=array();
		$resultset= $this->internalDB->query("SELECT id,title FROM rituals" );
		foreach ($resultset as $row) {
			$ritualnames[$row['id']]=$row['title'];
		}
		return $ritualnames;
		?>