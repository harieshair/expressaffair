<div class="header-middle"><!--header-bottom-->
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
				</div>
				<div class="mainmenu pull-right">
					<ul class="nav navbar-nav collapse navbar-collapse">
						<li><a href="<?php echo HTTPAPPLICATIONROOT; ?>/public" class="<?php echo ($activeMenu=='home')?'active':''?>">Home</a></li>
						
						<li><a href="javascript:void()" class="<?php echo ($activeMenu=='events')?'active':''?>" >Events</a>
							<?php include "eventlist.php" ?>
						</li>
						<li><a href="javascript:void()"class="<?php echo ($activeMenu=='rituals')?'active':''?>" >Rituals</a>
							<?php include "rituallist.php" ?>
						</li>
						<li><a href="index.html" class="<?php echo ($activeMenu=='aboutus')?'active':''?>" >About Us</a></li>
						<li><a href="index.html" class="<?php echo ($activeMenu=='contactus')?'active':''?>">Contact Us</a></li>
					</ul>
				</div>
			</div>			
		</div>
	</div>
</div><!--/header-bottom-->