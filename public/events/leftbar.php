<div class="left-sidebar">

	<div class="panel-group category-products" id="accordian"><!--category-productsr-->	
		<?php if(count($Rituals)>0){ ?>
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
						<li><a href="javascript:void()" class="btn-block btn-leftbar" onclick="switchtoritualdata(<?php  echo $ritual['id']; ?>)"><?php echo $ritual['title']; ?></a></li>
						<?php }
						?>							
					</ul>
				</div>			
			</div>
		</div>
		<?php } ?>
		<div class="panel panel-default">
			<div class="panel-heading">
				<h2 class="panel-title">Packages</h2>
			</div>
			<div class="panel-collapse in">
				<div class="panel-body left-panel-body" >
					<ul id="package-list">				
						<?php 
						foreach ($ServiceCategory as $category) 
							{ ?>
						<li><input type="checkbox" value="<?php  echo $category['id']; ?>" onchange="refinesearch()"><?php echo $category['catalog_value']; ?></li>
						<?php }
						?>							
					</ul>
				</div>			
			</div>
		</div>
	</div><!--/category-products-->	
		<div class="price-range">
		<div class="panel-heading">
			<h2 class="panel-title">Price Range</h2>
		</div>
		<div class="row">		
		<div class="col-sm-12"> <input id="pricerange" type="text" class="price-range" 
		value="" data-slider-min="10000" data-slider-max="200000" data-slider-step="20000" data-slider-value="[30000,100000]"/> 
		</div>		
		</div>		
	</div><!--/price-range-->
</div>