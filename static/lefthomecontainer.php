<?php
if (session_status() != PHP_SESSION_ACTIVE)
    session_start();
if (empty($customerService)) {
    include_once($_SERVER['DOCUMENT_ROOT'] . "/eventconfig.php");
    include_once(SERVERFOLDER . "/customer/services.php");
    $customerService = new customerservice($dbconnection->dbconnector);   
}
if(empty($entity))
    $entity=$_POST['entity'];
if(empty($location))
    $location=isset($_POST['location'])?$_POST['location']:0;
$resultSet = $customerService->getEntityItems($entity,$location);
?>
<div id="entitylists">
<?php
switch($entity){
case "events":
    include_once 'evententitys.php';
   break;
case "activities":
    include_once 'activityentitys.php';
    break;
case "services":
    include_once 'serviceentitys.php';
    break;
case "packages":
    include_once 'packageentitys.php';
    break;
case "partners":
    include_once 'partnerentitys.php';
    break;
case "contactus":
    include_once 'contactusentitys.php';
    break;
}
?>

</div>
