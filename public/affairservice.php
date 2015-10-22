<?php
$url = "http://localhost/expressaffair/service/customer/catalog.php";
$responseDecoded;

$parameter=array();
	$parameter['action']=$_POST['action'];
	$parameter['mastername']=$_POST['mastername'];
	
$curl = curl_init($url);
curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
$json = json_encode($parameter);
curl_setopt($curl, CURLOPT_POSTFIELDS, $json);			
$response = curl_exec( $curl );
$status = curl_getinfo($curl,CURLINFO_HTTP_CODE);
if($status >= 200 && $status < 300){
	$responseDecoded = json_decode($response);
}
print_r($response);
curl_close($curl);
return json_encode($responseDecoded);
?>