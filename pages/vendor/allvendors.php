<?php 
if(!isset($_SESSION)){session_start();}
/*if(!isset($_SESSION['hpadminloginstatus']) || $_SESSION['hpadminloginstatus']!="HPAdminLoggedIn")
{
	include_once("login_again.php");
	exit();
}
$navactive="createuser";*/

//$access=$_SESSION['action_list'];
include_once($_SERVER['DOCUMENT_ROOT']."/eventconfig.php");
include_once(CLASSFOLDER."/dbconnection.php");
include_once(CLASSFOLDER."/vendor.php");
$vendor=new vendorclass($dbconnection->dbconnector);
include_once(CLASSFOLDER."/catalogs.php");
$catalog=new catalogclass($dbconnection->dbconnector);          
$catalogArray=$catalog->GetAllCatalogValuesByMasterNames('City');
$searchObject=isset($_POST['postvalue'])?$_POST['postvalue']:null;
if(!empty($searchObject)){
    $rows=$searchObject['rows'];
    $page=$searchObject['page'];
}
else{
    $rows=20;
    $page=1;
}
?>

</script>
<div id="gridcontent" class ="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Vendor List</h3>
                    <a title="Create Community" class="btn btn-default pull-right btn-sm " href="javascript:void(0)" 
                    onclick="getcontents('pages/vendor/wizard.php','content')" > <i class="glyphicon  glyphicon-plus-sign"></i>Add Vedor</a>
                </div>  
                <div class="box-body">
                    <div id="example2_wrapper" class="dataTables_wrapper form-inline" role="grid">
                        <?php
                        $totalVendors= $vendor->getTotalVendors(null);
                        if($totalVendors>0){ 
                            if($totalVendors>=($page-1) * $rows){
                                $vendorlists= $vendor->getallvendorlists($page,$rows,null);
                                ?>  
                                <table id="eventtable" class="table table-bordered table-hover dataTable" aria-describedby="example2_info">
                                    <thead><tr >
                                        <th>Vendor Id</th>
                                        <th>Name</th>
                                        <th >Title</th>
                                        <th >Email</th>   
                                        <th >Located At</th>  
                                        <th >Creatd On</th>                                                                            
                                    </tr></thead> 
                                    <?php 
                                    foreach ($vendorlists as $rowdata) { ?>
                                    <tr >
                                        <td ><?php echo $rowdata['id']; ?></td>
                                        <td><a  title="Edit Vendor" href="javascript:void(0)" 
                                            onclick="getcontents('pages/vendor/wizard.php','content', <?php echo $rowdata['id']; ?>);"> 
                                            <?php  echo $rowdata['name']; ?></a></td>
                                            <td ><?php echo $rowdata['title']; ?></td> 
                                            <td ><?php echo $rowdata['email']; ?></td>              
                                            <td ><?php echo !empty($rowdata['location'])?$catalogArray[$rowdata['location']]:''; ?></td>                           
                                            <td><?php echo $rowdata['created_on'] ;?></td>                                                                                  
                                        </tr>
                                        <?php 
                                    } ?>
                                </table>
                                <table class="table" style="width:100%;height:30px"><tr class="gridPaging"><td style="float:right">Total Records : <?php echo $totalVendors;?> </td></tr></table> 
                                <?php 
                            }
                            else
                                { ?>
                            <div class="alert alert-warning"><strong>Message!</strong><br> No Records Found.</div>
                            <?php }
                        } 
                        else { ?> 
                        <div class="alert alert-warning"><strong>Message!</strong><br> No Records Found.</div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


