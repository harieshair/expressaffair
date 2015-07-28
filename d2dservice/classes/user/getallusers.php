<?php
	//$access=$_SESSION['action_list'];
	$sql = "SELECT count(id) as total FROM users ";
	$wherecondition=" where login_name is not null ";
	if($searchobj!=null){
		$wherecondition .=(!empty($searchobj->loginname))?" AND login_name LIKE '%".$searchobj->loginname."%' ":'';  
		$wherecondition .=(isset($searchobj->usertype))? " AND usertype=".intval($searchobj->usertype):'';
		$wherecondition .=(!empty($searchobj->username))?" AND name LIKE '%".$searchobj->username."%' ":''; 
		$wherecondition .=(isset($searchobj->userstatus))?" AND status=".intval($searchobj->userstatus):'';
		$wherecondition .=(!empty($searchobj->emailid))?" AND email='".$searchobj->emailid."'":'';
	}
		$totalusers = $this->internalDB->queryFirstField($sql.$wherecondition);
		if($totalusers>0) {
		$pages=ceil($totalusers/$rows);
		$page = $page == "" ? 0 : $page;
		$start=$page * $rows;
		$sql="SELECT * FROM users ".$wherecondition;
		$userlist = $this->internalDB->query("$sql ORDER BY id DESC LIMIT $start, $rows");	
$table ='<div class="row">
		<div class="col-xs-12">
			<div class="box">
				<div class="box-header">
					<h3 class="box-title">User List</h3>
				</div>
				<div class="box-body">
					<div id="example2_wrapper" class="dataTables_wrapper form-inline" role="grid"><div class="row"><div class="col-xs-6"></div><div class="col-xs-6"></div></div>';	
$table .= '<table id="usertable" class="table table-bordered table-hover dataTable" aria-describedby="example2_info">
					<thead><tr >
						<th>User Id</th>
		<th>Login Name</th>
		<th >User Name</th>
		<th >Email Id</th>
		<th >Contact Number</th>
		<th >Employee Id</th>				
		<th >User Type</th>
		<th >Status</th>	
					</tr></thead>';
		foreach ($userlist as $rowdata) {
			  $table .= '<tr >';
			  $table .= '<td >'.$rowdata['id'].'</td>';
			   $table .= '<td>'.$rowdata['login_name'].'</td>';
			  $table .= '<td >'.$rowdata['name'].'</td>';
			  
			  $table .= '<td>'.$rowdata['email'].'</td>';
			  $table .= '<td >'.$rowdata['phone'].'</td>'; 
			  $table .= '<td >'.$rowdata['employeeid'].'</td>';  			  
			  $table .= '<td >';
			  $table.=$this->TypeOfUser->getvalue($rowdata['usertype']);
			  $table.='</td>';			  
			  $table .= '<td >';
			  $table.=($rowdata['status']==0)?'Active':'Inactive';
			  $table.='</td>';
			  $table .= '</tr>';
			  }
			  $table .="</table>";
			 }
			 else
			 {
			 $table ='<div class="alert alert-warning"><strong>Message!</strong><br> No Records Found.</div>';
			 }
		$table.='<table class="table" style="width:100%;height:30px"><tr class="gridPaging"><td style="float:right">Total Records : '.$totalusers.'</td></tr></table>';	 
		return $table;
		?>