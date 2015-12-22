<script type="text/javascript">
	/*price range*/
	var pricerangeslider; 
	

	var IsPopUpSignUp;
	var IsBooking=false;
	var pendingactions={};

	$(document).ready(function(){
		pricerangeslider=$('#pricerange').slider().on('slideStop',searchonsliderchange);
		$('#affair-modal').on('hidden.bs.modal', function (e) {
			$('#affair-modal-dialog').removeClass("modal-lg").removeClass("modal-sm");
			$('#affair-modal').modal('hide')
		});
		<?php include "requestparser.php";?>

		if(pendingactions.l!=0)
			$('#locationid').val(pendingactions.l);
		else
			getGeoLocationCityName();
		
		$('#eventDD').val(pendingactions.e);
		startdate = new Date();
		enddate=new Date();
		startdate.setDate(startdate.getDate()+10);
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
		if(pendingactions.ef!='0')
			$('#eventdatefrom').datepicker('update', pendingactions.ef.replace("/", "-"));
		if(pendingactions.et!='0')
			$('#eventdateto').datepicker('update', pendingactions.et.replace("/", "-"));		
		/*$('#event-search-object').html(getFilterString());*/
		pricerangeslider.slider('setValue', pendingactions.prm).slider('setValue', pendingactions.prmax);

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