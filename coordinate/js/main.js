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
function callservicebyajax(POSTDATA, serverurl, callbackfunction) {
    //showPageLoader();
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
            //hidePageLoader();
        }
    });
    return false;
}
function calljsonservicebyajax(POSTDATA, serverurl, callbackfunction) {
    showPageLoader();
    $.ajax({
        url: serverurl,
        type: "POST",
        data: POSTDATA,
        cache: false,
        dataType: "json",
        async: true,
        success: function (data, status) {
            ajaxResponse = data;
            callbackfunction();
            ajaxResponse = '';
            hidePageLoader();
        },
        error: function (data, status, e)
        {
            notifyDanger(e);
        }
    });
    return false;
}
function getcontents(urllocator, responsearea, postdata)
{
    var POSTDATA = '';
    if (postdata)
        POSTDATA += "postvalue=" + encodeURIComponent(postdata);
    callservicebyajax(POSTDATA, urllocator, function () {
        getcontentresponse(responsearea);
    });
}
