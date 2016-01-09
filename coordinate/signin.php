<div class="row">
    <div class="col-sm-6 pull-right">
        <h3>Login to your account</h3>
        <div class="box box-primary">
            <div class="login-form"><!--login form-->
                <form name="login-form" id="login-form" >
                    <input type="text" name="loginid" id="email" placeholder="Login Id" />
                    <input type="password" name="password" id="password" placeholder="Password"/>
                    <div class="col-sm-6">
                        <input type="checkbox" id="remember_me" name="_remember_me" checked />
                        <label for="remember_me">Keep me logged in</label>
                    </div>
                    <div class="col-sm-6">
                        <a href="forgetpassword" > Forgot Password?</a>
                    </div>
                    <div class="col-sm-12">
                        <a href="javascript:void(0)" class="btn xpress-btn-info xpress-back form-control" id="submitlogin" >Login</a>
                    </div>                       
                </form>
            </div><!--/login form-->               
        </div>
    </div>
</div>
 <?php include "footer.php"; ?>
<?php include "js/login.php";