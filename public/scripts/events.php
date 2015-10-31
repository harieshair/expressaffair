<script type="text/javascript">
	var eventdateto;
	$(function () {
		customerid=<?php echo isset($_SESSION['CUSTOMERID'])?$_SESSION['CUSTOMERID']:0; ?>;
		locationId=<?php echo isset($_SESSION['LOCATION'])?$_SESSION['LOCATION']:0; ?>;
		today = new Date();
		bookingdate = new Date();
		bookingdate.setDate(today.getDate()+2);
		eventdateto=$('#eventdateto').datepicker({		
			startDate : bookingdate,
			endDate : bookingdate.setDate(today.getDate()+10),
			autoclose: true
		});

		$('#eventdatefrom').datepicker({		
			startDate : bookingdate,
			endDate : bookingdate.setDate(today.getDate()+365),
			autoclose: true
		}).on('changeDate', function(event) {
			var newDate = new Date(event.date)
			newDate.setDate(newDate.getDate() + 10)
			eventdateto.datepicker("setStartDate", event.date);
			eventdateto.datepicker("setEndDate", newDate);
		});
		/*$('#eventdate').daterangepicker({
			startDate: moment().subtract('days', -2),
			endDate: moment().add('days', 2),
			maxDate: moment().add('days', 365),
			minDate: moment().add('days', 1)
		});
			  $("#eventdate").inputmask("dd/mm/yyyy", {"placeholder": "dd/mm/yyyy"});
			$("#eventtime").timepicker({
          showInputs: false
      });*/

});
</script>