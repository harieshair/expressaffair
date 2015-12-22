// JavaScript Document
/*-------------------------------------------------------------------------------------------------*/
function callservicebyajax(POSTDATA, serverurl, callbackfunction) {
    showPageLoader();
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
            hidePageLoader();

        }
    });
}
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
}
function getcontents(urllocator, responsearea, postdata)
{
    var POSTDATA = '';
    if (postdata)
        POSTDATA += "postvalue=" + encodeURIComponent(postdata);
    callservicebyajax(POSTDATA, urllocator, function () {
        getcontentresponse(responsearea)
    });
}
function appendpartialcontents(urllocator, beforelementclass, postdata)
{
    var POSTDATA = '';
    if (postdata)
        POSTDATA += "postvalue=" + encodeURIComponent(postdata);
    callservicebyajax(POSTDATA, urllocator, function () {
        appendpartialcontentresponse(beforelementclass)
    });
}
function getwizardcontents(urllocator, responsearea, postdata) {
    var POSTDATA = "";
    if (postdata && postdata > 0)
        POSTDATA = "postvalue=" + encodeURIComponent(postdata);
    else if ($('#entityid').val() && $('#entityid').val() != 0)
        POSTDATA = "postvalue=" + encodeURIComponent($('#entityid').val());
    if (POSTDATA != "")
        callservicebyajax(POSTDATA, urllocator, function () {
            getcontentresponse(responsearea)
        });
}

function getmodalcontents(urllocator, postdata, callback) {
    var POSTDATA = '';
    if (postdata)
        POSTDATA += "postvalue=" + encodeURIComponent(postdata);
    callservicebyajax(POSTDATA, urllocator, callback);
}

function getcontentresponse(responsearea) {
    $('#' + responsearea).html(ajaxResponse);
    $('.nvtooltip').remove();
}
function appendpartialcontentresponse(beforelementclass) {
    $(ajaxResponse).insertBefore('.' + beforelementclass);
}

function getmodalcontentresponse() {
    $('#MicroModalwindow').html(ajaxResponse);
    $('#MicroModalwindow').attr('class', 'modal fade bs-example-modal-sm').attr('aria-labelledby', 'myModalLabel');
    $('.modal-dialog').attr('class', 'modal-dialog  modal-lg');
    $('#MicroModalwindow').modal('show');
}


function getCheckBoxValueIsideContainer(checkboxid) {
    var eventids = $("#" + checkboxid + " input:checkbox:checked").map(function () {
        return $(this).val();
    }).toArray();
    return eventids;
}

function selectAllCheckboxchilds(parentname, childname) {
    if ($('input:checkbox[name=' + parentname + ']').is(':checked'))
        $('input:checkbox[name=' + childname + ']').prop('checked', true);
    else
        $('input:checkbox[name=' + childname + ']').prop('checked', false);
}
function resetform(formid) {
    $('#' + formid)[0].reset();
}

function savedataresponse(callbackmethod) {
    var response = JSON.parse(ajaxResponse);
    if (response) {
        if (response.Exception) {
            notifyDanger(response.Exception);
        } else {
            notifySuccess(response.Message);
            if (callbackmethod)
                setTimeout(function () {
                    callbackmethod();
                }, 1000);
        }
    }
}
function wizardnext(nextwizardurl, isNew, appenddataurl) {
    var response = JSON.parse(ajaxResponse);
    if (response) {
        if (response.Exception) {
            notifyDanger(response.Exception);
        } else {
            notifySuccess(response.Message);
            if (nextwizardurl && nextwizardurl != "")
                getwizardcontents(nextwizardurl, 'wizardcontent', response.Id)
            else if (isNew)
                appendnewli(response.Id, appenddataurl);
            else
                hideeditli(response.Id, appenddataurl);


        }
    }
}
function hideeditli(listid, appenddataurl) {
    $('#' + listid + '-edit').css("display", "none");
    $('#' + listid + '-non-edit').css("display", "block");
    getcontents(appenddataurl, listid + "-non-edit", listid);
}
function appendnewli(listid, appenddataurl) {
    appendpartialcontents(appenddataurl, "li-new", listid);
    $('.li-new').css("display", "none");
    resetform('new-form');
}

function savemodalwindowresponse(callbackmethod) {
    var response = JSON.parse(ajaxResponse);
    if (response) {
        if (response.Exception) {
            notifyDanger(response.Exception);
        } else {
            closemodalwindow();
            callbackmethod();
        }
    }

}
function notifySuccess(message) {
    $.bootstrapGrowl(message, {type: 'success'});
}
function notifyInfo(message) {
    $.bootstrapGrowl(message, {type: 'info'});
}
function notifyDanger(message) {
    $.bootstrapGrowl(message, {type: 'danger'});
}

function removefilefromattachment(filename, hiddenfieldname)
{
    $("#view_" + filename).remove();
    $("#remove_" + filename).remove();
    var files = $('#' + hiddenfieldname).val();
    files = files.split(',');
    var index = files.indexOf(filename);
    if (index > -1) {
        files.splice(index, 1);
        $('#' + hiddenfieldname).val(files.join(','));
    }
}
function removefilefromattachmentdiv(divid, hiddenfieldname, filename)
{
    $("#" + divid).remove();
    var files = $('#' + hiddenfieldname).val();
    files = files.split(',');
    var index = files.indexOf(filename);
    if (index > -1) {
        files.splice(index, 1);
        $('#' + hiddenfieldname).val(files.join(','));
    }
}
function stringReplace(variable, searchstring, replacestring) {
    return variable.replace(searchstring, replacestring);
}

/*--------------------------------------------------------------------------------------------*/
function uploadfiles(elementid)
{
    if(!elementid)
        elementid="";
    if ($("#file_name" + elementid).val() != "" && $("#file_name" + elementid).val() != undefined)
    {
        var isfilereplace = confirm("file is already exists,Do you want to replace.?");
        if (!isfilereplace)
            return;
    }
    if ($('#attachment'.elementid).val() != '')
    {
        type = $("#file_type" + elementid).val();
        fileElementId = "attachment" + elementid;
        file = '../service/accessories/attachments.php?filetype=' + type + '&elementId=attachment' + elementid;

        $("#loading")
                .ajaxStart(function () {
                    $(this).show();
                })
                .ajaxComplete(function () {
                    $(this).hide();
                });
        $.ajaxFileUpload
                ({
                    url: file,
                    secureuri: true,
                    fileElementId: fileElementId,
                    dataType: 'json',
                    success: function (data, status)
                    {
                        var result = jQuery.parseJSON(data);
                        if (!result.Exception || result.Exception == "")
                        {
                            notifySuccess("Attached Successfully");
                            $('#file_name' + elementid).val(result.newfilename);
                            if($('#previewimage').length>0)
                                $('#previewimage').attr({"src":"../uploadfolder/"+result.newfilename});
                            var div = $("#divexistingfile_" + elementid);
                            $("<a/>").css({"cursor": "pointer", "color": "#0000CC"}).html(result.filename).attr({"href": "../downloadfiles.php?filelocation=../uploadfiles/" + result.newfilename, "Title": "Download", "target": "_blank"}).appendTo(div);
                        } else
                            notifyDanger(result.Exception);
                    },
                    error: function (data, status, e)
                    {
                        notifyDanger(e);
                    }
                })
    } else
    {
        notifyDanger("Please Upload files");
    }
    return false;
}
function uploadmultiplefiles(reqformid)
{
    var elementid = "";
    if (reqformid)
        elementid = "_" + reqformid;

    if ($('#attachment' + elementid).val() != '')
    {
        type = $("#file_type" + elementid).val();
        fileElementId = "attachment" + elementid;
        file = '../service/accessories/multi_attachments.php?filetype=' + type + '&elementId=attachment' + elementid;

        $("#loading")
                .ajaxStart(function () {
                    $(this).show();
                })
                .ajaxComplete(function () {
                    $(this).hide();
                });
        $.ajaxFileUpload
                ({
                    url: file,
                    secureuri: true,
                    fileElementId: fileElementId,
                    dataType: 'json',
                    success: function (data, status)
                    {
                        var result = jQuery.parseJSON(data);
                        if (!result.Exception || result.Exception == "")
                        {
                            var files = [];
                            oldfiles = $('#file_name' + elementid).val();
                            if (oldfiles)
                                files = oldfiles.split(',');

                            var div = $("#divexistingfile" + elementid);
                            $.each(result, function (key, value) {
                                if (key != "Exception") {
                                    files.push(value);
                                    filewithoutext = key.split('.')[0]
                                    if ($('#attachmentdiv' + elementid + '_' + filewithoutext).length > 0) {
                                        $('#attachmentdiv' + elementid + '_' + filewithoutext + ' #remove_attachment').trigger("click");
                                    }
                                    attachmentrow = $("<div/>").attr({"id": "attachmentdiv" + elementid + "_" + filewithoutext}).addClass("row").appendTo(div);
                                    $("<div/>").addClass("col-sm-3 ele-centered")
                                            .html("<input type='radio' value='" + value + "' id='rd_ismasterimage' name='rd_ismasterimage'>")
                                            .appendTo(attachmentrow);
                                    colsm7 = $("<div/>").addClass("col-sm-7").appendTo(attachmentrow);
                                    $("<a/>").addClass("attachment-anchor")
                                            .attr({"id": "view_" + filewithoutext, "href": "attachments/downloadfiles.php?filelocation='/" + value + "'"}).html(key).appendTo(colsm7);
                                    colremove = $("<div/>").addClass("col-sm-2").appendTo(attachmentrow);
                                    $("<a/>").attr({"style": "cursor: pointer", "id": "remove_attachment", "onclick": "removefilefromattachmentdiv('attachmentdiv" + elementid + '_' + filewithoutext + "','file_name" + elementid + "','" + value + "')"})
                                            .addClass("pull-left").html("<i class='fa fa-times-circle'></i>").appendTo(colremove);
                                }

                            });
                            $('#file_name' + elementid).val(files.join(','));
                            notifySuccess("Attached Successfully");
                        } else
                            notifyDanger(result.Exception);
                    },
                    error: function (data, status, e)
                    {
                        notifyDanger(e);
                    }
                });
    } else
    {
        notifyDanger("Please Upload files");
    }
    return false;
}

function showmodalwindow() {
    if (ajaxResponse) {
        var modalWindowData = JSON.parse(ajaxResponse);
        if (modalWindowData.Header)
            $('#ModalWindowHeader').html(modalWindowData.Header);
        if (modalWindowData.Body)
            $('#ModalWindowBody').html(modalWindowData.Body);
        if (modalWindowData.Footer)
            $('#ModalWindowFooter').html(modalWindowData.Footer);
    }
    $('#MicroModalwindow').attr('class', 'modal fade').attr('aria-labelledby', 'myModalLabel');
    $('.modal-dialog').attr('class', 'modal-dialog');
    $('#MicroModalwindow').modal('show');
}
function closemodalwindow() {
    $('#ModalWindowBody').html("");
    $('#ModalWindowFooter').html("");
    $('#ModalWindowHeader').html("");
    $('#MicroModalwindow').modal("hide");
}

function changenavstatus(navbarid, selectedtab)
{
    $('#' + navbarid).each(function () {
        $(this).find('li').each(function () {
            $(this).removeClass("active");
        });
        $(this).find('li').each(function () {
            if ($(this).attr('id') == selectedtab) {
                $(this).addClass("active");
            }
        });
    });
}
function previewfile(file) {
    content = {};
    var ext = file.substr(file.indexOf('.') + 1);
    ext = ext.toLowerCase();
    if (ext == "png") {
        content.Body = "<img src='" + file + "' />";
        ajaxResponse = JSON.stringify(content);
        showmodalwindow();
    }
}