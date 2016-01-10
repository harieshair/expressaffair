var ajaxResponse;
function oncallservice(POSTDATA, serverurl, callbackfunction) {
    $.ajax({
        url: serverurl,
        type: "POST",
        data: POSTDATA,
        cache: false,
        async: true,
        success: function (response) {
            ajaxResponse = response;
            callbackfunction();
            ajaxResponse = '';
        }
    });
    return false;
}
function getintoaccount(serviceurl, formid) {
    var logindetails = $("#" + formid).serialize();
    var POSTDATA = "action=getintoaccount&logindetails=" + encodeURIComponent(logindetails);
    oncallservice(POSTDATA, serviceurl, function () {
        if (ajaxResponse > 0) {
                window.location = "home";
        } else
            $('#errorinfo').addClass("label-danger").html("Username/Password incorrect");
    });
}