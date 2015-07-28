<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>AdminLTE 2 | Dashboard</title>
  <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
  <link rel="stylesheet" href="dist/css/jquery-ui.css" type="text/css" />
  <!-- Bootstrap 3.3.2 -->
  <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
  <!-- Font Awesome Icons -->
  <link href="font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
  <!-- Ionicons -->
  <link href="ionicons/2.0.1/css/ionicons.min.css" rel="stylesheet" type="text/css" />
  <!-- Theme style -->
  <link href="dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
<!-- AdminLTE Skins. Choose a skin from the css/skins
 folder instead of downloading all of them to reduce the load. -->
 <link href="dist/css/skins/_all-skins.min.css" rel="stylesheet" type="text/css" />             
        

 <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
 <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
    <script src="../../https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="../../https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
  </head>
  <!-- ADD THE CLASS layout-top-nav TO REMOVE THE SIDEBAR. -->
  <body class="skin-blue layout-top-nav">
    <div class="wrapper">

      <header class="main-header">               
        <?php include_once("pages/navbar.php"); ?>
      </header>
      <!-- Full Width Column -->
      <div class="content-wrapper" >
        <div class="container" id="right-content">

         <?php include_once("dashboard.php"); ?>
       </div><!-- /.container -->
       <div class="pull-right"><a href="javascript:void(0);" id="backtotop" style="display:none" onclick="clicktotop()" class="btn btn-default-inverse btn-xs"><i class="glyphicon  glyphicon-arrow-up white"></i> Back to Top</a>
       </div> 
     </div><!-- /.content-wrapper -->
     <footer class="main-footer">
      <div class="container">
        <div class="pull-right hidden-xs">
          <b>Version</b> 2.0
        </div>
        <strong>Copyright &copy; 2015-2016 <a >Event Management</a>.</strong> All rights reserved.
      </div><!-- /.container -->
    </footer>
  </div><!-- ./wrapper -->
  <!-- set up the modal to start hidden and fade in and out -->

  <div id="alert-area"></div>
  <div class="modal fade" id="MicroModalwindow" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog ">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
          <h4 class="modal-title" id="myModalLabel"></h4>
        </div>
        <div class="modal-body" id="ModalWindowBody">
        </div>
        <div class="modal-footer" id="ModalWindowFooter">
        </div>
      </div>
    </div>
  </div>
  <!-- jQuery 2.1.3 -->
  <script src="plugins/jQuery/jQuery-2.1.3.min.js"></script>
   <script src="plugins/jQueryUI/jquery-ui-1.10.3.js"></script>

  <script src="plugins/jQuery/jQuery.validate.min.js"></script>
  <!-- Bootstrap 3.3.2 JS -->
  <script src="bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
  <!-- SlimScroll -->
  <script src="plugins/slimScroll/jquery.slimScroll.min.js" type="text/javascript"></script>
  <!-- FastClick -->
  <script src='plugins/fastclick/fastclick.min.js'></script>
 <script src="dist/js/app.js" type="text/javascript"></script>
  <!-- d2d scripts -->
  <script src="scripts/admin.js" type="text/javascript"></script>
  <script src="scripts/businessflow.js" type="text/javascript"></script>

   

</body>
</html>
