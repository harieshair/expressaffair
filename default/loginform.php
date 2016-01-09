<div class="login-form"><!--login form-->

    <form name="login-form" id="login-form" >
        <input type="email" name="email" id="email" placeholder="Email Address" />
        <input type="password" name="password" id="password" placeholder="Password"/>
        <div class="col-sm-6">
           <input type="checkbox" id="remember_me" name="_remember_me" checked />
    <label for="remember_me">Keep me logged in</label>
        </div>
        <div class="col-sm-6">
            <input type="checkbox" class="checkbox">Forgot Password?
        </div>
        <br/>
        <a href="javascript:void(0)" class="btn btn-default" id="submitlogin" >Login</a>
        <!--<span  class="or">OR</span>
        <a href="<?php //echo HTTPAPPLICATIONROOT.'/public/signup/'; ?>" class="btn btn-default" >SignUp</a> -->
    </form>
</div><!--/login form-->