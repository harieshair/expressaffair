function addtomycart(vserviceid) {
    if (validateitemtosave(vserviceid))
        additemtocart();
}
function removecarteditem(cartId, customerId) {
    var isToRemoveFromCart = confirm("Are you sure to remove service from shortlisted cart.?");
    if (!isToRemoveFromCart)
        return;
    POSTDATA = "action=removecarteditem&cartId=" + encodeURIComponent(cartId) + "&customerId=" + encodeURIComponent(customerId);
    callservicebyajax(POSTDATA, 'service/customerserver.php', function () {
        if (trim(ajaxResponse) == 1) {
            $("#div_" + cartId).remove();
        }
    });
}
function bookthisitem(vserviceid) {
    IsBooking = true;
    if (!validateitemtobook())
        return false;
    if (validateitemtosave(vserviceid))
        switchtoservicebookings();
}
function bookCartedItem(cartid) {
    cartedProperty = $('#cart-item-properties_' + cartid);
    pendingactions.c = cartedProperty.attr("c");
    pendingactions.l = cartedProperty.attr("l");
    pendingactions.vsi = cartedProperty.attr("vsi");
    pendingactions.s = cartedProperty.attr("s");
    pendingactions.e = cartedProperty.attr("e");
    pendingactions.r = cartedProperty.attr("r");
    pendingactions.ef = cartedProperty.attr("ef");
    pendingactions.et = cartedProperty.attr("et");
    if ($('#eventdatefrom_' + cartid).val() || $('#eventdatefrom_' + cartid).val() !== "") {
        pendingactions.ef = $('#eventdatefrom_' + cartid).val();
        pendingactions.et = $('#eventdateto_' + cartid).val();
    }
    switchtoservicebookings();
}
function validateitemtobook() {
    if (pendingactions.ef == "") {
        notifyDanger("Hey, Tell us your event date");
        return false;
    }
    if (pendingactions.l == 0 || pendingactions.l == "") {
        notifyDanger("Hey, Tell us your event location");
        return false;
    }
    return true;

}
function validateitemtosave(vserviceid) {
    pendingactions.vsi = vserviceid;
    if (!pendingactions.c || pendingactions.c == 0) {
        IsPopUpSignUp = true;
        getmodalcontents("loginorsignup.php", "", getmodalresponse);
        return false;
    }
    return true;
}

function additemtocart() {
    POSTDATA = "action=aditemtocart&itemdata=" + encodeURIComponent(JSON.stringify(pendingactions));
    oncallservice(POSTDATA, "service/cartserver.php", function () {
        if (trim(ajaxResponse) > 0) {
            notifySuccess("Service shortlisted for booking");
        } else
            notifyDanger("Try after some time");
    });
}

function bookitemonmyaccount() {
    if (!$('#booking-form-customer').valid())
        return;

    bookerDetail = $("#booking-form-customer").serialize();
    POSTDATA = "action=bookthisitem&itemdata=" + encodeURIComponent(JSON.stringify(pendingactions)) + "&bookerdetails=" + encodeURIComponent(bookerDetail);
    oncallservice(POSTDATA, "service/bookingserver.php", function () {
        if (trim(ajaxResponse) == 1) {
            notifySuccess("Service has been booked, Waiting for confirmation");
            setTimeout(function () {
                window.location = "myaccount";
            }, 1000);
        } else
            $('#errorHandler').html(ajaxResponse);
    });
}

function searchonsliderchange() {
    var range = pricerangeslider.slider('getValue');
    if (range != 0 && (pendingactions.prm != range[0] || pendingactions.prmax != range[1])) {
        pendingactions.prm = range[0];
        pendingactions.prmax = range[1];
        refinesearch();
    }
}
function enabledisablelookinthisrange(obj) {
    if (obj.checked) {
        $("#pricerange").slider("enable");
        searchonsliderchange()
    } else {
        $("#pricerange").slider("disable");
        if ((pendingactions.prm != 0 || pendingactions.prmax != 0)) {
            pendingactions.prm = 0;
            pendingactions.prmax = 0;
            refinesearch();
        }
    }
}

function refinesearchonclick() {
    pendingactions.ef = $('#eventdatefrom').val();
    pendingactions.et = $('#eventdateto').val();
    pendingactions.l = $('#locationid').val();
    refinesearch();
}
function refinesearch() {
    pendingactions.pac = getCheckBoxValueIsideContainer('package-list');
    /*$('#event-search-object').html(getFilterString());*/
    POSTDATA = JSON.stringify(pendingactions);
    calljsonservicebyajax(POSTDATA, "service/searchservice.php", fillsearcheditems);
}




function savecustomersignupdetails(serviceurl, formid, callbackfn) {
    signupdetails = $("#" + formid).serialize();
    var POSTDATA = "action=savecustomer&signupdetails=" + encodeURIComponent(signupdetails);

    oncallservice(POSTDATA, serviceurl, function () {
        if (ajaxResponse > 0) {
            pendingactions.c = trim(ajaxResponse);
            if (IsPopUpSignUp) {
                getcontents("default/myprofile.php", "myprofile-content");
                hideaffairmodal();
                completepopuppendingactions();
            } else if (callbackfn && $("#" + formid + " #entity_id").length > 0)
                callbackfn();
            else
                window.location = "home";
        }
    });
}

function changeLocationResponse() {
    if (ajaxResponse) {
        var div = '<div class="row"><label>Location</label><select id="eventlocation" name="eventlocation" >';
        var catalogValues = JSON.parse(ajaxResponse);
        $.each(result, function (key, value) {
            div += '<option value="' + value.id + '">' + value.catalog_value + '</option>';
        });
        div += '</select></div>';
        ajaxResponse = {};
        ajaxResponse.Body = div;
        showmodalwindow();
    }
}
function isemailexisits(value) {
    if (!value)
        return;
    var POSTDATA = 'action=isemailavailable&username=' + encodeURIComponent(value);
    oncallservice(POSTDATA, 'service/customerserver.php', function () {
        if (ajaxResponse == 0) {
            $("#signup_form").find("input").each(function () {
                $(this).attr("disabled", false)
            });
            $("#signup_form").find("textarea").each(function () {
                $(this).attr("disabled", false)
            });
            $("#signup_form").find("select").each(function () {
                $(this).attr("disabled", false)
            });
            $("#signup_form").find("a").each(function () {
                $(this).attr("disabled", false)
            });
        }
    });
}
function changeLocation(serviceName, catalogName) {
    req = {};
    req.mastername = catalogName;
    var postdata = JSON.stringify(req);
    callRestService(serviceName, postdata, changeLocationResponse);
}
function getintoaccount(serviceurl, formid) {
    var logindetails = $("#" + formid).serialize();
    var POSTDATA = "action=getintoaccount&logindetails=" + encodeURIComponent(logindetails);
    oncallservice(POSTDATA, serviceurl, function () {
        if (ajaxResponse > 0) {
            pendingactions.c = trim(ajaxResponse);
            if (IsPopUpSignUp) {
                getcontents("default/myprofile.php", "myprofile-content");
                hideaffairmodal();
                completepopuppendingactions();
            } else
                window.location = "home";
        } else
            alert("please specify valid credentials");
    });
}

function getFilterString()
{
    var filterString = "";
    if (pendingactions.e)
        filterString += "<span> What: </span>" + $("#eventDD option:selected").text();
    if (pendingactions.l)
        filterString += "<span>   Where: </span> " + $("#locationid option:selected").text();
    if (pendingactions.ef)
        filterString += "<span>   From: </span>" + $('#eventdatefrom').val();
    if (pendingactions.et)
        filterString += "<span>   To: </span>" + $('#eventdateto').val();
    return filterString;
}
function redirecttonewevent(sel) {
    if (sel.value && sel.value != 0)
        window.location = "events=" + sel.value;
}
function switchtoritualdata(ritualid) {
    pendingactions.r = ritualid;
    window.location = "rituals=" + javascriptObjectToQueryString(pendingactions);
}
function switchtoservicebookings() {
    window.location = "servicebooking=" + javascriptObjectToQueryString(pendingactions);
}
function previewitem(vserviceid, locationid) {
    POSTDATA = "vserviceid=" + encodeURIComponent(vserviceid) + "&locationid=" + encodeURIComponent(locationid);
    getmodalcontents("events/previewitem.php", POSTDATA, getmodalresponse);
}
function listoutentity(entity){
    getcontents('static/lefthomecontainer.php','entitylists',entity);
}