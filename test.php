<?php
$begin = new DateTime('2013-02-11 00:00:00');
$end = new DateTime('2013-02-13 00:00:00');

$daterange = new DatePeriod($begin, new DateInterval('P1D'), $end);
foreach($daterange as $date){
	 echo $date->format("Y-m-d H:i:s") . "<br>";
}
?>