	<?php
	class publicclass{	
		public $internalDB;		
	function publicclass($db) // Constructor 
	{
		$this->internalDB=$db;
	}
	/* -----------------------------------------------------------------------------*/
	function getAllRitualsForHome()
	{
		$ritualdata= $this->internalDB->query("SELECT id,title,icon FROM rituals order by title");
		return $ritualdata;		
	}
	
}