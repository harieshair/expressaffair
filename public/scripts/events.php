<script type="text/javascript">
		$(function () {
			customerid=<?php echo isset($_SESSION['CUSTOMERID'])?$_SESSION['CUSTOMERID']:0; ?>;
			locationId=<?php echo isset($_SESSION['LOCATION'])?$_SESSION['LOCATION']:0; ?>;
			 $('#eventdate').daterangepicker();
			  /*$("#eventdate").inputmask("dd/mm/yyyy", {"placeholder": "dd/mm/yyyy"});
			$("#eventtime").timepicker({
          showInputs: false
        });*/
                
     });
	</script>