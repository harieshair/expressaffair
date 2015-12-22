<?php

include "commonenums.php";
define("SUPERADMIN", "Super Admin");
define("ADMIN", "Admin");
define("ACTIVE", "Active");
define("INACTIVE", "InActive");

class TypeOfUser {

    public function getlists() {
        return array(
            "1" => SUPERADMIN,
            "2" => ADMIN,
            "3" => VENDOR,
            "4" => CUSTOMER
        );
    }

    public function getvalue($id) {

        $casevalue = (string) $id;
        switch ($casevalue) {
            case '1':
                $value = SUPERADMIN;
                break;
            case '2':
                $value = ADMIN;
                break;
            case '3':
                $value = VENDOR;
                break;
            case '4':
                $value = CUSTOMER;
                break;
        }
        return $value;
    }

}

class UserStatus {

    public function getlists() {
        return array(
            "0" => ACTIVE,
            "1" => INACTIVE,
        );
    }

    public function getvalue($id) {
        $value = "";
        switch ($id) {
            case "0":
                $value = ACTIVE;
                break;
            case "1":
                $value = INACTIVE;
                break;
        }
        return $value;
    }

}

?>