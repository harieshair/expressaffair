<html lang="en" dir="ltr" ><head><meta charset="utf-8">
        <title>Administration</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
        <link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap.css">;
        <link rel="stylesheet" type="text/css" href="../font-awesome/4.3.0/css/font-awesome.min.css">
        <link rel="stylesheet" type="text/css" href="../dist/css/stylesheet.css">
        <script src="../dist/js/jquery-1.9.1.js" type="text/javascript"></script>   
        <script src="../dist/js/jquery-ui-1.10.2.min.js" type="text/javascript"></script> 
        <script src="../bootstrap/js/bootstrap.min.js" type="text/javascript"></script> 
        <script type="text/javascript" src="../dist/js/aform.js"></script>
        <script type="text/javascript" src="../dist/js/login.js"></script>


    </head>
    <body style="">

        <!-- page loader -->
        <div id="preloader" style="display: none;">
            <div id="preloader_status"><i class="fa fa-spinner fa-spin"></i></div>
        </div>
        <!-- / page loader -->

        <div class="wrapper">
            <div class="wrapper_c page_width" style="width: 100%">
                <section>

                    <!-- not logged in -->

                    <div class="mainpanel no-columns">

                        <div class="pageheader">
                            <div class="logopanel">
                                <a href="#">					</a>
                            </div>
                            <!-- logopanel -->
                        </div>


                        <div class="contentpanel" style="min-height: 590px;">
                            <section>

                                <div class="lockedpanel">
                                    <div class="loginuser">
                                        <img src="../dist/img/login.png" alt="Please enter your login details.">
                                    </div>
                                    <div class="logged">
                                        <h4>Administration</h4>
                                        <small class="text-muted">Please enter your login details.</small>
                                    </div>

                                    <form id="loginFrm" name="loginFrm" action="javascript:void(0);" method="get" role="form"> 
                                        <div class="form-group">
                                            <div class="input-group">
                                                <div class="input-group-addon"><i class="fa fa-user fa-fw"></i></div>			
                                                <input type="text" name="username" id="loginFrm_username" class="form-control atext " value="" data-orgvalue="" placeholder="Username:">

                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="input-group">
                                                <div class="input-group-addon"><i class="fa fa-key fa-fw"></i></div>			
                                                <input type="password" name="password" id="loginFrm_password" class="form-control atext " value="" data-orgvalue="" placeholder="Password:">

                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <input type="submit" class="btn btn-primary btn-block" onclick="checkfields()"><i class="fa fa-lock fa-fw"></i> </input>
                                        </div>
                                        <div class="form-group">
                                            <label id="msgbox" style="display:none" class="label"></label>
                                        </div>


                                    </form>

                                    <a href="#">Forgot Password?</a>

                                </div><!-- lockedpanel -->

                            </section>			</div><!-- / contentpanel -->


                    </div><!-- mainpanel -->


                </section>
            </div><!-- / Container wrapper -->
        </div><!-- /Page wrapper -->
        <a id="gotop" href="#"></a>
    </body></html>