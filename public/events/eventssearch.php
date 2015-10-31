<div class="price-range row">
	<div class="col-sm-1 "><h4>Where</h4></div>
	<div class="col-sm-2 ">
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
	<div class="col-sm-1 "><h4>When</h4></div>
	<div class="col-sm-3">	
		<div class="input-group">		
			<input type="text" class="form-control pull-right" id="eventdate" />
			<div class="input-group-addon">
				<i class="fa fa-calendar"></i>
			</div>
		</div>	
	</div>
</div>