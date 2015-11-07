<div class="left-sidebar">
	<div class="">
		<a href="javascript:void()" class="form-control btn btn-default refine-search" onclick="refinesearch();">Refine Event Search</a>
	</div>
	<div class="price-range">
		<div class="panel-heading">
			<h6 class="panel-title">Price Range</h6>
		</div>
		
		<div class="well text-center">
			<input type="text" class="span2 form-control" value="" data-slider-min="1000" data-slider-max="600000"   data-slider-step="5" data-slider-value="[20000,100000]" id="sl2" ><br />
			<b class="pull-left">1000</b> <b class="pull-right">600000</b>
		</div>

	</div><!--/price-range-->
	<div class="panel-group category-products" id="accordian"><!--category-productsr-->	
		<div class="panel panel-default">
			<div class="panel-heading">
				<h6 class="panel-title">Packages</h6>
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
                <?php if($activeMenu!="rituals") { ?>
		<?php echo $activeMenu; if(count($Rituals)>0){ ?>
		<div class="panel panel-default">
			<div class="panel-heading">
				<h6 class="panel-title">Rituals</h6>
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
		<?php } ?>
            <?php } ?>
	</div><!--/category-products-->	
</div>