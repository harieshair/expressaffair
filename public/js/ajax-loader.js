(function($) {
	$.fn.loader = function(action) {
          //  alert("jq fun");
		var h = "<div class='ajax-loader' style='width:100%;height:100%;position:absolute;top:0;left:0;z-index:890;background:rgba(206,206,206,0.5);border-radius:10px;padding:0px;margin:0px;'><span style='position:relative;border:1px solid #fdb45c;border-radius:5px;padding:5px;display:table;background:#ffffff;'><img style='float:left' src='data:image/gif;base64,R0lGODlhIAAgAKIAAPebLPrKj/vNl/zhwf3w4P738P////ebLCH/C05FVFNDQVBFMi4wAwEAAAAh+QQJDAAHACwAAAAAIAAgAAADewi6TPYwyskqcDNn2574oBCFoMEtGPmNqnleXgup4gsbNEu6ZyrHO5tvN2sJgSFd8qhpQgjQqNRJrVqvWGuuSESWvCtuUvzF/cxd9FhdZofBIriyvXXH5eR33T5/Z/+AgYKDf3uGP4dpdYlrfHiPjpGSi2eMZZZ+e4QZCQAh+QQJDAAHACwAAAAAIAAgAAADgGi6bAEwRtKqXU9Kepf4oKBkGsSFoIeKTjkpK2vEo2vCq4rW9pnju1YPGNIVhS5fcPYjlZTHDvIprRYI2Gy2yu16v1yaMTX+lGXMZToqJpLdZji6vX7T7796XM5o49V0YIKDhIWGYH9RejKJb4tnfXmPfJCVk5SYjXuXmnOShxYJACH5BAkMAAcALAAAAAAgACAAAAN9aLrcbgHIOZ99kVIluhfM5ymZJnEiuKRqaaJimJJmZbByDNXnPa8/lwb2yRV3POIIqBNuLlBaMgotEK5YLHXL7VJxzKOyE16OVecyWY326dxiuFm+prfB6bzezjbO8V6BgoOEhYGAiD98fYyLe3iJb46RcZCKjpOXlHOGDwkAIfkECQwABwAsAAAAACAAIAAAA4Boutz+MMopqhXs2qyx6t7XcdoCkhe6iaU5uq1xwim9yi9b6/fMVyrgZEgsFgPIpLJgdACe0Cih2YhaAVNcTJu6Sn8h7sYLzfrEQPLTnENj1Fhw8K1mb09w+85tyFMZBIGCg3+FhocSZ4o5i3eMbY07kTd8cjZClpWZmpOYmogQCQAh+QQJDAAHACwAAAAAIAAgAAADhGi63P4wyimqFezarLHq3tdx2gKSF7qJpTm6rXHCKb3KL1vr98xXKuBkSCwaJYOAcrksHBsBgHQ6JQxnUSrViothtdtf6AuWcn3k8jmXBq+9r6xabBPK3fTJXct9KgoEgYKCfoWGhj5dO4o9OYxCeY8hkkFjjolol5pwMZR1lp2YjocQCQAh+QQJDAAHACwAAAAAIAAgAAADgGi63P4wyimqFezarLHq3tdx2gKSF7qJpTm6rXHCKb3KL1vr98xXKuBkSCwaj41BYMlkIhsBgHQ6/YVwrSiVag16tFtp1yYEh8dj8xaNram57Vu8HK7Or7O3/anQi/kKBQSDhISAh4hkeDl3il6PbD6NkYw+kpc5mDGTnJ2SiQ4JACH5BAkMAAcALAAAAAAgACAAAAN6aLrc/jDKKaoV7Nqssere13HaApIXuomlObqtccIpvcovW+v3zFcq4GRILBqPyGTRh4s1d8xoTur0UXfPXi4r/IWuN+53C+4qz2hFYM1uF9CAuHxOgM/vdXEQc8d79wZ9dH82QIJyeWV8hwCJZCOMjYR/kY5VkIx5SgkAIfkECQwABwAsAAAAACAAIAAAA39outz+MMopqhXs2qyx6t7XcdoCkhe6iaU5uq1xwim9yi9b6/fMVyrgZEgsGo/IZNGHizV3zGhO6vRRd89eLiv8ha437ncL7irPaOIgwG63C+gAYE6nE4Yzeb1+F9uEentzfVYvgYKEU4aCdl5/Hod7iTF5jIOOmJF8mBKajREJACH5BAkMAAcALAAAAAAgACAAAAN6aLrc/jDKKaoV7Nqssere13HaApIXuomlObqtccIpvcovW+v3zFcq4GRILBqPyGTRh4s1d8xoTur0UXfPXi4r/IWuN+53C+4qz+i0YhBou93pAGBOp3uDHnm9frcJ9XtzfX2AgYNiCoV7hzOKfIh+eYF2kISTgmiOdAkAOw=='><span style='float: left;margin-top: 6px;margin-left: 5px;font-family: calibri;color: #646363;'>Loading Pls Wait...</span></span></div>";
		var a = action;
		if (a === "show") {
			$(this).append(h);
			$(this).css('position', 'relative');
			var t = 150;//($(this).find("div.ajax-loader").height() / 2) - 22;
			var l = ($(this).find("div.ajax-loader").width() / 2) - 54;
			$(this).find("div.ajax-loader>span").css("top", t).css("left", l);
		}
		if (a === "hide") {
			$(this).find("div.ajax-loader").remove();
			$(this).css('position', 'relative');
		}
	}
}(jQuery));

function showPageLoader(){
   // alert("hishowpageloader");
	$(".app-body").loader("show");
}

function hidePageLoader(){
	$(".app-body").loader("hide");
	//$(".modal-backdrop").loader("hide");
}

/*function hidePageLoaderAll(){
	$(".app-body").loader("hide");
	$(".modal-backdrop").loader("hide");
}*/

(function($) {
	$.fn.disableForm = function(action) {
		var h = "<div class='dis-div'></div>";
		var a = action;
		if (a === "show") {
			$(this).prepend(h);
			$(this).addClass("dis-wrapper");			
		}
		if (a === "hide") {
			$(this).find("div.dis-div").remove();
			$(this).removeClass("dis-wrapper");
		}
	}
}(jQuery));