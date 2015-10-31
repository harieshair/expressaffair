<div class="price-range row">
	<div class="col-sm-1 "><h4 class="pull-right">Where</h4></div>
	<div class="col-sm-3">
		<div class="input-group">
			<select  id="location"  name="location" class="form-control">
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
	<div class="col-sm-1 "><h4 class="pull-right">When</h4></div>
	<div class="col-sm-2">	
		<div class="input-group">		
			<input type="text" class="form-control pull-right" id="eventdatefrom" />
			<div class="input-group-addon">
				<i class="fa fa-calendar"></i>
			</div>
		</div>
	</div>
	<div class="col-sm-1 "><span> to</span></div>
	<div class="col-sm-2">
		<div class="input-group">
			<input type="text" class="form-control pull-right" id="eventdateto" />
			<div class="input-group-addon">
				<i class="fa fa-calendar"></i>
			</div>
			
		</div>	
	</div>
	<div class="col-sm-2">
		<a href="javascript:void()" class="form-control btn btn-default refine-search" onclick="refinesearch();">Refine Event Search</a>
	</div>
</div>