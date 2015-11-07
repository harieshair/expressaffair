<div class="event-search">
<div class="row">
	<!--<div class="col-sm-1 "><h4 class="pull-right">Where: </h4></div>-->
	<div class="col-sm-3">
	<label >What</label>	
		<div class="input-group">
			<select  id="eventDD"  name="eventDD" class="form-control" onchange="redirecttonewevent(this);">
				<?php include "static/eventdropdown.php" ?>
			</select>
			<div class="input-group-addon">
				<i class="fa fa-bookmark"></i>
			</div>
		</div>
	</div>
	<div class="col-sm-3">
	<label>Where</label>	
		<div class="input-group">
			<select  id="locationid"  name="locationid" class="form-control" >
			<option value="0">Choose</option>
				<?php 
				foreach ($Citys as $key => $value)
					{ ?>
				<option value="<?php  echo $key; ?>"><?php echo $value; ?></option>
				<?php }
				?>		
			</select>
			<div class="input-group-addon">
				<i class="fa fa-location-arrow"></i>
			</div>
		</div>
	</div>
	<div class="col-sm-2">	
	<label>From</label>
		<div class="input-group">		
			<input type="text" class="form-control pull-right" id="eventdatefrom" />
			<div class="input-group-addon">
				<i class="fa fa-calendar"></i>
			</div>
		</div>
	</div>
	<div class="col-sm-2" id="event-search-till" style="display:none">
	<label>To</label>
		<div class="input-group">
			<input type="text" class="form-control pull-right" id="eventdateto" />
			<div class="input-group-addon">
				<i class="fa fa-calendar"></i>
			</div>
			
		</div>	
	</div>	
	<div class="col-sm-2">
	<label></label>
	<div class="input-group">
		<a href="javascript:void()" class="form-control btn btn-default refine-search" onclick="refinesearchonclick();"><i class="fa fa-search"></i>Refine Event Search</a>
		</div>
	</div>
</div>
</div>
<div class="row event-search">
<div class="col-sm-2"><span class="pull-right event-search-title">Filter based on:</span></div>
<div class="col-sm-10"><span id="event-search-object" class="event-search-object"></span></div>
</div>