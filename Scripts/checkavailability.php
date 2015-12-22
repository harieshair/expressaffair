<script type="text/javascript">
		startdate = new Date();
		enddate=new Date();
		startdate.setDate(startdate.getDate()+10);
		enddate.setDate(enddate.getDate()+365);
		function initializecarteddatepicker(cartid,triggerid){
			$('#eventdateto_'+cartid).datepicker({		
				startDate : startdate,
				endDate : enddate,
				autoclose: true
			});
			$('#eventdatefrom_'+cartid).datepicker({		
				startDate : startdate,
				endDate : enddate,
				autoclose: true
			}).on('changeDate', function(event) {
				$('#event-search-till').css("display","");
				var newDate = new Date(event.date);
				newDate.setDate(newDate.getDate() + 10);
				$('#eventdateto_'+cartid).val('').datepicker('update');
				$('#eventdateto_'+cartid).datepicker("setStartDate", event.date);
				$('#eventdateto_'+cartid).datepicker("setEndDate", newDate);
				checkserviceavailability(cartid);
			});		
			/*$('#'+triggerid).attr("disabled",true);*/
			$('#cartedform_'+cartid).css("display","");
		}
		function checkserviceavailability(cartid){
			if($("#eventdatefrom_"+cartid).val()===""){
				$("#cartedform_"+cartid+" #errorspan").html("Please select valid event date");
				return false;
			}
			$("#chkcartservice_"+cartid).html("<i class='fa fa-spinner fa-spin'></i>Check Availability");
			chkdetails = $("#cartedform_"+cartid).serialize();
			POSTDATA="action=checkcartserviceavailability&chkdetails="+encodeURIComponent(chkdetails);
			callservicebyajax(POSTDATA,'service/customerserver.php',function(){
				if(trim(ajaxResponse)==1){
					$("#bookcartitem_"+cartid).css("display","");
					$("#cartedform_"+cartid+" #itemnotavailable").html("");		
					$("#errorspan_"+cartid).html("");	
				}
				else{
					$("#bookcartitem_"+cartid).css("display","none");
					$("#errorspan_"+cartid).html("Sorry already booked on this date");
				}
				$("#chkcartservice_"+cartid).html("Check Availability");
			});	
		}
	</script>