<?php

if (session_status() != PHP_SESSION_ACTIVE)
    session_start();
include_once($_SERVER['DOCUMENT_ROOT'] . "/eventconfig.php");
include_once(CLASSFOLDER . "/dbconnection.php");
include_once(CLASSFOLDER . "/common.php");
include_once(CLASSFOLDER . "/user.php");
$user = new userclass($dbconnection->dbconnector);
$customer = new customerclass($dbconnection->dbconnector);

switch ($_POST['action']) {
    case "getintoaccount":
        if (!empty($_POST['logindetails'])) {
            $params = [];
            parse_str($_POST['logindetails'], $params);
            if (empty($params['email']) || empty($params['password'])) {
                echo 0;
                return;
            }
            $passwordencoded = md5($params['password']);
            $response = $user->GetCoordinatorLoginDetails($loginname, $passwordencoded);
            if (!empty($response)) {
                $_SESSION['COORDINATORID'] = $response['id'];
                $_SESSION['start'] = time(); // taking now logged in time
                $_SESSION['expire'] = $_SESSION['start'] + (1 * 60);
                echo $response;
                break;
            }
            echo 0;
        } else {
            echo 0;
        }
        break;
}