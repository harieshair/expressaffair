function fillsearcheditems(){
	var result=ajaxResponse;
	if(result.Exception && result.Exception!=""){
		$('#features-items').html('Service is not available');
		return;
	}
	if(result.Items){
		var totalItems=result.Items.length;
		if(totalItems==0){
			$('#features-items').html('Service is not available');
			return;
		}
		$("#features-items").html("");
		for(var i = 0; i < totalItems; i++){
			itemdiv= $("<div/>").addClass("col-sm-4");
			imageWrapper= $("<div/>").addClass("product-image-wrapper").appendTo(itemdiv);
			singleProduct= $("<div/>").addClass("single-products").appendTo(imageWrapper);
			productinfo= $("<div/>").addClass("productinfo").addClass("text-center").appendTo(singleProduct);
			$("<img/>").attr({"src":result.Items[i].filePath,"alt":"","height":"170","width":"42","onclick":"previewitem("+result.Items[i].id+")"}).appendTo(productinfo);
			$("<span/>").addClass("col-sm-12").html(result.Items[i].title).appendTo(productinfo);
			$("<span/>").addClass("col-sm-12").html(result.Items[i].city).appendTo(productinfo);
			price=$("<span/>").addClass("col-sm-6").appendTo(productinfo);
			$("<label/>").addClass("rate").html("<i class='fa fa-rupee'></i>"+result.Items[i].price).appendTo(price);
			$("<span/>").addClass("col-sm-6").html("<a href='javascript:void()' class='rating'>"+getRatings(result.Items[i].review)+"</a>").appendTo(productinfo);
			addtocart=$("<span/>").addClass("col-sm-12").appendTo(productinfo);
			$("<a/>").attr({"href":"#","onclick":"addtomycart('"+result.Items[i].id+"')"}).addClass("btn btn-default add-to-cart").html("<i class='fa fa-bookmark'></i>Shortlist to booking").appendTo(addtocart);

			wishlist=$("<div/>").addClass("choose").appendTo(itemdiv);
			wishlistul=$("<ul/>").addClass("nav nav-pills nav-justified").appendTo(wishlist);
			$("<li/>").html('<a href="#"><i class="fa fa-plus-square"></i>Add to wishlist</a>').appendTo(wishlistul);
			$("<li/>").html('<a href="#"><i class="fa fa-plus-square"></i>Add to compare</a>').appendTo(wishlistul);
			
			$("#features-items").append(itemdiv);
		};
	}
	else{
		$('#features-items').html('<h2 class="item-unavail">New items comes soon</h2>');
		return;
	}

}
function getRatings(review){
	rating="";
	switch(review){
		case "1":
		rating='<i class="fa fa-star"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i>';
		break;
		case "2":
		rating='<i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i>';
		break;
		case "3":
		rating='<i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i>';
		break;
		case "4":
		rating='<i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star-o"></i>';
		break;
		case "5":
		rating='<i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i>';
		break;
		default:
		rating='<i class="fa fa-star-o"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i>';
		
	}
	return rating;
}