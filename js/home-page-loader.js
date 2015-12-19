function bindrituallists() {
    var result = ajaxResponse;
    if (result) {
        var totalItems = result.length;
        $("#home-rituals").html("");
        for (var i = 0; i < totalItems; i++) {
            col3 = $("<div/>").addClass("col-sm-3");
            imageWrapper = $("<div/>").addClass("product-image-wrapper").appendTo(col3);
            singleProduct = $("<div/>").addClass("single-products").appendTo(imageWrapper);
            productinfo = $("<div/>").addClass("productinfo").addClass("text-center").appendTo(singleProduct);
            $("<a/>").attr({"href": "rituals=" + result[i].id}).addClass("affair-big-icon").html("<i class='fa " + result[i].icon + "'></i>").appendTo(productinfo);
            $("<span/>").addClass("col-sm-12").html("<a href='rituals=" + result[i].id + "'>" + result[i].title + "</a>").appendTo(productinfo);
            $("#home-rituals").append(col3);
        }
        ;
    }
}
/*price range*/
var IsPopUpSignUp;
var IsBooking = false;
var pendingactions = {};
var locationId = 0;
/*scroll to top*/
$(document).ready(function () {
    /*$('#affair-modal').modal({
     keyboard: false
     });*/
    $('#affair-modal').on('hidden.bs.modal', function (e) {
        $('#affair-modal-dialog').removeClass("modal-lg").removeClass("modal-sm");
        $('#affair-modal').modal('hide')
    });
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

    calljsonservicebyajax("action=getAllRitualsForHome", "service/publicserver.php", function () {
        if (ajaxResponse)
            bindrituallists();
    });

});