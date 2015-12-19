<?php

$searchobj = ($searchobj != null) ? json_decode($searchobj) : null;
$wherecondition = " where name is not null ";
if ($searchobj != null) {
    $wherecondition .=(!empty($searchobj->loginname)) ? " AND login_name LIKE '%" . $searchobj->loginname . "%' " : '';
    $wherecondition .=(isset($searchobj->usertype)) ? " AND usertype=" . intval($searchobj->usertype) : '';
    $wherecondition .=(!empty($searchobj->username)) ? " AND name LIKE '%" . $searchobj->username . "%' " : '';
    $wherecondition .=(isset($searchobj->userstatus)) ? " AND status=" . intval($searchobj->userstatus) : '';
    $wherecondition .=(!empty($searchobj->emailid)) ? " AND email='" . $searchobj->emailid . "'" : '';
}
$pages = $pages == "" ? 0 : $pages - 1;
$start = $pages * $rows;
$sql = "SELECT * FROM events " . $wherecondition;
return $this->internalDB->query("$sql ORDER BY id DESC LIMIT $start, $rows");
?>