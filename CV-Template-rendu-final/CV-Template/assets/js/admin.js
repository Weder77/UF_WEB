$(document).ready(function(){
	var a = $("#add-formation").get(0);
	var b = $("#close-formation").get(0);
	var c = $("#add-skill").get(0);
	var d = $("#close-skill").get(0);
	popupOpen(a);
	popupClose(b);
	popupOpen(c);
	popupClose(d);
});
function popupOpen(id) {
	$(id).click(function(){
		if ( $(id).attr("id") == "add-formation" ) {
			$("#popup-add-formation").addClass("popup-open");
		} else if ( $(id).attr("id") == "add-skill" ) {
			$("#popup-add-skill").addClass("popup-open");			
		}
		$("main").addClass("popup-open-background-main");
	});
}

function popupClose(id) {
	$(id).click(function(){
		if ( $(id).attr("id") == "close-formation" ) {
			$("#popup-add-formation").removeClass("popup-open");
		} else if ( $(id).attr("id") == "close-skill" ) {
			$("#popup-add-skill").removeClass("popup-open");		
		}
		$("main").removeClass("popup-open-background-main");
	});
}