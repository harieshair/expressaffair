<script type="text/javascript">
/*price range*/
var pricerangeslider =$('#pricerange').slider();
var IsPopUpSignUp;
var pendingactions={};

$(document).ready(function(){

	$('#affair-modal').on('hidden.bs.modal', function (e) {
		$('#affair-modal-dialog').removeClass("modal-lg").removeClass("modal-sm");
		$('#affair-modal').modal('hide')
	});

		pendingactions.c=<?php echo !empty($customerService->searchObj->customerId)?$customerService->searchObj->customerId:0; ?>;
		pendingactions.l=<?php echo !empty($customerService->searchObj->locationId)?$customerService->searchObj->locationId:0; ?>;
		pendingactions.e=<?php echo !empty($customerService->searchObj->eventId)?$customerService->searchObj->eventId:0; ?>;
		pendingactions.r=<?php echo !empty($customerService->searchObj->ritualId)?$customerService->searchObj->ritualId:0;?>;
		pendingactions.s=<?php echo !empty($customerService->searchObj->serviceId)?$customerService->searchObj->serviceId:0; ?>;
		pendingactions.st= <?php echo !empty($customerService->searchObj->start)?$customerService->searchObj->start:0; ?>;
		pendingactions.ma=<?php echo !empty($customerService->searchObj->max)?$customerService->searchObj->max:15; ?>;
		pendingactions.oby=<?php echo !empty($customerService->searchObj->oby)?$customerService->searchObj->oby:2; ?>;
		$('#locationId').val(pendingactions.l);
		$('#eventDD').val(pendingactions.e);
		startdate = new Date();
		enddate=new Date();
		startdate.setDate(startdate.getDate()+2);
		enddate.setDate(enddate.getDate()+365);
		eventdateto=$('#eventdateto').datepicker({		
			startDate : startdate,
			endDate : enddate,
			autoclose: true
		});

		$('#eventdatefrom').datepicker({		
			startDate : startdate,
			endDate : enddate,
			autoclose: true
		}).on('changeDate', function(event) {
			$('#event-search-till').css("display","");
			var newDate = new Date(event.date);
			newDate.setDate(newDate.getDate() + 10);
			eventdateto.val('').datepicker('update');
			eventdateto.datepicker("setStartDate", event.date);
			eventdateto.datepicker("setEndDate", newDate);
		});
		
$('#event-search-object').html(getFilterString());

/*scroll to top*/
	$(function () {
		$.scrollUp({
	        scrollName: 'scrollUp', // Element ID
	        scrollDistance: 300, // Distance from top/bottom before showing element (px)
	        scrollFrom: 'top', // 'top' or 'bottom'
	        scrollSpeed: 300, // Speed back to top (ms)
	        easingType: 'linear', // Scroll to top easing (see http://easings.net/)
	        animation: 'fade', // Fade, slide, none
	        animationSpeed: 200, // Animation in speed (ms)
	        scrollTrigger: false, // Set a custom triggering element. Can be an HTML string or jQuery object
					//scrollTarget: false, // Set a custom target element for scrolling to the top
	        scrollText: '<i class="fa fa-angle-up"></i>', // Text for element, can contain HTML
	        scrollTitle: false, // Set a custom <a> title if required.
	        scrollImg: false, // Set true to use image
	        activeOverlay: false, // Set CSS color to display scrollUp active point, e.g '#00FFFF'
	        zIndex: 2147483647 // Z-Index for the overlay
	    });
	});

});

</script>