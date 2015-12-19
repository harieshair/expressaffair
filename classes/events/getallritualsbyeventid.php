<?php
$eventRituals= $this->internalDB->query("SELECT r.id,r.title FROM rituals r inner join e_rituals er on er.ritual_id=r.id where er.event_id=$eventId" );
return $eventRituals;
?>