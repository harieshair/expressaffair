<div class="left-sidebar">
	<div class="price-range"><!--price-range-->
		<h2>Price Range</h2>
		<div class="well text-center">
			<input type="text" class="span2" value="" data-slider-min="1000" data-slider-max="600000" data-slider-step="5" data-slider-value="[20000,100000]" id="sl2" ><br />
			<b class="pull-left">1000</b> <b class="pull-right">600000</b>
		</div>
	</div><!--/price-range-->
	<div class="panel-group category-products" id="accordian"><!--category-productsr-->	
		<div class="panel panel-default">
			<div class="panel-heading">
				<h2 class="panel-title">Locations</h2>
			</div>
			<div class="panel-collapse in">
				<div class="panel-body left-panel-body" >
					<ul>				
						<?php 
						foreach ($Citys as $key => $value)
							{ ?>
						<li><input type="radio" value="<?php  echo $key; ?>"><?php echo $value; ?></li>
						<?php }
						?>							
					</ul>
				</div>			
			</div>
		</div>
		<div class="panel panel-default">
			<div class="panel-heading">
				<h2 class="panel-title">Packages</h2>
			</div>
			<div class="panel-collapse in">
				<div class="panel-body left-panel-body" >
					<ul>				
						<?php 
						foreach ($ServiceCategory as $category) 
							{ ?>
						<li><input type="checkbox" value="<?php  echo $category['id']; ?>"><?php echo $category['catalog_value']; ?></li>
						<?php }
						?>							
					</ul>
				</div>			
			</div>
		</div>

		<div class="panel panel-default">
			<div class="panel-heading">
				<h2 class="panel-title">Rituals</h2>
			</div>
			<div class="panel-collapse in">
				<div class="panel-body left-panel-body" >
					<ul>				
						<?php 
						foreach ($Rituals as $ritual) 
							{ ?>
						<li><input type="radio" value="<?php  echo $ritual['id']; ?>"><?php echo $ritual['title']; ?></li>
						<?php }
						?>							
					</ul>
				</div>			
			</div>
		</div>
	</div><!--/category-products-->	
</div>