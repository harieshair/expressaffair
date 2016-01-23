<script src="../js/jquery.js"></script>
<script src="../plugins/jQuery/jQuery.validate.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
<script src="../js/bootstrap-growl.min.js"  type="text/javascript"></script>
<script src="js/login.js" type="text/javascript"></script>
<script type="text/javascript">

    (function ($, W, D)
    {
        var JQUERY4U = {};

        JQUERY4U.UTIL =
                {
                    setupFormValidation: function ()
                    {
                        //form validation rules
                        $("#login-form").validate({
                            rules: {
                                loginid: {
                                    required: true,
                                     minlength: 3,
                                },
                                password: {
                                    required: true,
                                    minlength: 4,
                                    maxlength: 15,
                                }
                            },
                            messages: {
                                loginid: "Please specify login name",
                                password: "Please specify valid password"
                            }
                        });
                    }
                }

//when the dom has loaded setup form validation rules
        $(D).ready(function ($) {
            JQUERY4U.UTIL.setupFormValidation();
            $('#submitlogin').on('click', function () {
                if ($('#login-form').valid()) {
                    getintoaccount("service/signupservice.php", "login-form");
                }
            });
        });

    })(jQuery, window, document);
</script>