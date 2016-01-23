<?php include "header.php"; ?>
<section>
    <div class="container">
        <div class="row">
            <div class="col-sm-6 pull-right">
                 <div class="box">
                    <div class="box-header box-login">
                  <h3 class="box-title">Login to your account</h3>
                    </div>
                    <div class="login-form"><!--login form-->
                        <form name="login-form" id="login-form" >
                            <input type="text" name="loginid" id="loginid" placeholder="UseName" maxlength="20" />
                            <input type="password" name="password" id="password" placeholder="Password" maxlength="15"/>
                            <div class="col-sm-6">
                                <input type="checkbox" id="remember_me" name="_remember_me" checked />
                                <label for="remember_me">Keep me logged in</label>
                            </div>
                            <div class="col-sm-6">
                                <a href="forgetpassword" > Forgot Password?</a>
                            </div>
                            <div class="col-sm-6">
                                <label id="errorinfo" class="label"></label>
                            </div>
                            <div class="col-sm-6 pull-right">
                                <a href="javascript:void(0)" class="btn xpress-btn-info xpress-back form-control" id="submitlogin" >Login</a>
                            </div>                       
                        </form>
                    </div><!--/login form-->               
                </div>
            </div>
        </div>
        <?php include "footer.php";
        include "scripts/loginscripts.php";
        ?>
    </div>
</section>        
</body>
</html>