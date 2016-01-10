<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">
        <title>X Affair</title>
        <link href="../css/bootstrap.min.css" rel="stylesheet">
        <link href="../css/font-awesome.min.css" rel="stylesheet">       
        <link href="../plugins/datepicker/datepicker3.css" rel="stylesheet">
        <link href="../css/responsive.css" rel="stylesheet">
        <link href="css/main.css" rel="stylesheet">
    </head> 
    <body>
<header id="header"><div class="header_top"><!--header_top-->
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
                    <a class="navbar-brand brand-a" href="home" ><img src="../images/partner2.png" alt="" /></a>
                </div>
                <?php if(!empty($Coordinator)) { ?> 
                 <div class="navbar-collapse collapse in affair-header-nav pull-right" aria-expanded="true">
                    <ul class="nav navbar-nav">
                        <li><a href="home"><i class="fa fa-home"></i></a></li>
                      <li><span><i class="fa fa-user"></i>Hi, <?php echo $Coordinator['name'] ; ?></span></li>
                    </ul>
                 </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>
</header>