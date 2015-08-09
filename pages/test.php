<!DOCTYPE html>
<html>
    <head>
        <title>Bootstrap Multiselect</title>
        <meta name="robots" content="noindex, nofollow" />
        <meta http-equiv="content-type" content="text/html; charset=UTF-8" />

<link rel="stylesheet" href="../dist/css/jquery-ui.css" type="text/css" />
  <!-- Bootstrap 3.3.2 -->
  <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
  <!-- Font Awesome Icons -->
  <link href="../font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
  <!-- Ionicons -->
  <link href="../ionicons/2.0.1/css/ionicons.min.css" rel="stylesheet" type="text/css" />
  <!-- Theme style -->
  <link href="../dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
<!-- AdminLTE Skins. Choose a skin from the css/skins
 folder instead of downloading all of them to reduce the load. -->
 <link href="../dist/css/skins/_all-skins.min.css" rel="stylesheet" type="text/css" /> 

        <link rel="stylesheet" href="../dist/css/bootstrap-multiselect.css" type="text/css">   
   <!-- jQuery 2.1.3 -->
  <script src="../plugins/jQuery/jQuery-2.1.3.min.js"></script>
   <script src="../plugins/jQueryUI/jquery-ui-1.10.3.js"></script>

  <script src="../plugins/jQuery/jQuery.validate.min.js"></script>
  <!-- Bootstrap 3.3.2 JS -->
  <script src="../bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
  <!-- SlimScroll -->
  <script src="../plugins/slimScroll/jquery.slimScroll.min.js" type="text/javascript"></script>
  <!-- FastClick -->
  <script src='../plugins/fastclick/fastclick.min.js'></script>
  <script src="../dist/js/jquery.bootstrap-growl.min.js"  type="text/javascript"></script>
 <script src="../dist/js/app.js" type="text/javascript"></script>
  <!-- d2d scripts -->
  <script src="../scripts/admin.js" type="text/javascript"></script>
  <script src="../scripts/businessflow.js" type="text/javascript"></script>
<!-- <script type="text/javascript" src="../dist/js/prettify.js"></script> -->
        <script type="text/javascript" src="../dist/js/bootstrap-multiselect.js"></script>       

        <script type="text/javascript">   
    $(document).ready(function() {
        $('#example-post').multiselect({
            includeSelectAllOption: true,
            enableFiltering: true
        });
    });
</script>
    </head>
    <body>   

<form class="form-horizontal" method="POST" action="post.php">
    <div class="form-group">
        <label class="col-sm-2 control-label">Multiselect</label>
        <div class="col-sm-10">
            <select id="example-post" name="multiselect[]" multiple="multiple">
                <option value="1">Option 1</option>
                <option value="2">Option 2</option>
                <option value="3">Option 3</option>
                <option value="4">Option 4</option>
                <option value="5">Option 5</option>
                <option value="6">Option 6</option>
            </select>
        </div>
    </div>
    
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" class="btn btn-default">Submit</button>
        </div>
    </div>
</form>
</body>
