<?php
if (session_status() != PHP_SESSION_ACTIVE)
    session_start();
if (empty($customerService)) {
    include_once($_SERVER['DOCUMENT_ROOT'] . "/eventconfig.php");
    include_once(SERVERFOLDER . "/customer/services.php");
    $customerService = new customerservice($dbconnection->dbconnector);
    if (isset($_SESSION['CUSTOMERID']) && empty($customerData)) {
        $customerId = $_SESSION['CUSTOMERID'];
        $customerData = $customerService->GetCustomerById($customerId);
        if (!isset($_SESSION['LOCATION'])) {
            $_SESSION['LOCATION'] = $customerData['city'];
        }
    }
}
?>
<div class="header_top"><!--header_top-->
    <div class="container">
        <div class="row">            
            <div class="col-sm-12 shop-menu">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" 
                            data-target=".affair-header-nav" aria-expanded="false" aria-controls=".home-left-sidebar">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="home"><img src="images/partner2.png" alt="" /></a>
                </div>
                <div class="navbar-collapse collapse in affair-header-nav pull-right" aria-expanded="true">
                    <ul class="nav navbar-nav">
                        <li><a href="home"><i class="fa fa-home"></i></a></li>
                        <li class="dropdown"><a href="javascript:void()" data-toggle="dropdown" role="button" aria-haspopup="true" 
                           aria-expanded="true" class="<?php echo ($activeMenu == 'events') ? 'active' : '' ?>" >Events<span class="caret"></span></a>
                            <?php include ROOTFOLDER."/static/eventlist.php" ?>
                        </li>
                        <li class="dropdown"><a href="javascript:void()" data-toggle="dropdown" role="button" aria-haspopup="true" 
                                                aria-expanded="true" class="<?php echo ($activeMenu == 'rituals') ? 'active' : '' ?>">Activity<span class="caret"></span></a>
                            <?php include ROOTFOLDER."/static/rituallist.php" ?>
                        </li>
                        <?php if (empty($customerData)) { ?>
                            <li><a href="signin"><i class="fa fa-lock"></i> Login</a></li>
                            <li><a href="signup"><i class="fa fa-user"></i> SignUp</a></li>
                            <?php
                        } else {
                            ?>							
                            <li><a href="#"><i class="fa fa-star"></i> Wishlist</a></li>
                            <li><a href="cart"><i class="fa fa-shopping-cart"></i> Shortlisted</a></li>
                            <li><a href="myaccount"><i class="fa fa-user"></i>
                                    <?php echo $customerData['name']; ?></a></li>
                            <li><a href="logout"><i class="fa fa-unlock"></i> LogOut</a></li>
                            <?php }
                            ?>						
                    </ul>
                </div>			
            </div>
        </div>
    </div>
</div><!--/header_top-->		