$(document).ready(function(){
	window.onscroll = function(){
		/** Hover la balise a du header correspondant au href de celle-ci **/
		headerHover(accueil,"#headerAccueil");
		headerHover(aproposTextPres,"#headerApropos");
		headerHover(competences,"#headerCompetences");
		headerHover(formations,"#headerFormations");	
		headerHover(realisations,"#headerRealisations");
		headerHover(contact,"#headerContact");

			/** Hover qu'une seule balise a **/
		if ( checkVisible(accueilPres) ) {
			$("#headerApropos").removeClass("header-a-hover");
		}
		if ( $("#headerApropos").attr("class") == "header-a-hover" ) {
			$("#headerAccueil").removeClass("header-a-hover");
			$("#headerFormations").removeClass("header-a-hover");
			$("#headerCompetences").removeClass("header-a-hover");

		}
		if ( checkVisible(competencesH2) && !checkVisible(aproposH2) ) {
			$("#headerCompetences").addClass("header-a-hover");
			$("#headerApropos").removeClass("header-a-hover");
			$("#headerFormations").removeClass("header-a-hover");
			$("#headerRealisations").removeClass("header-a-hover");
		}
		if ( checkVisible(formationsH2) && !checkVisible(competencesH2) ) {
			$("#headerFormations").addClass("header-a-hover");
			$("#headerCompetences").removeClass("header-a-hover");
			$("#headerRealisations").removeClass("header-a-hover");
			$("#headerContact").removeClass("header-a-hover");
		}
		if ( checkVisible(realisationsH2) && !checkVisible(formationsH2) ) {
			$("#headerFormations").removeClass("header-a-hover");
			$("#headerContact").removeClass("header-a-hover");
		}
		if ( checkVisible(contactH2) && !checkVisible(realisationsH2)  ) {
			$("#headerRealisations").removeClass("header-a-hover");
		}


		/** Animation des barres de progréssion quand visible (ne s'effectue qu'une seul fois) **/
		for (var id = 1; id <= $(".pourcentage").length ; id++) {
			if ( $("#prog"+id).width() == 0 ) {
				var element = $('#prog'+id).get(0);
				var pourcent = parseInt($("#pourcentage"+id).text().replace("%",""));
				checkVisible(element) ?  progUp(pourcent,id) : "unset";
			}
		}

		/** Animation des formation de gauche à droite et inversement en fonction de la position initiale **/
		for (var i = 1; i <= $(".container").length; i++) {
			sliceInLeft(formationsVisible,"#formationContainerLeft"+i);
			sliceInRight(formationsVisible,"#formationContainerRight"+i);
		}
	}
});

/** Fonction permettant de vérifier si l'element est visible ou non  **/
function checkVisible(element) {
  var rect = element.getBoundingClientRect();
  var viewHeight = Math.max(document.documentElement.clientHeight, window.innerHeight);
  return !(rect.bottom < 0 || rect.top - viewHeight >= 0);
}

/** Fonction de l'animation des barres de progression **/
function progUp(percent,id) {
	(function theLoop (i) {

	    setTimeout(function () {
	        $("#prog" + id).width(i+"%");
	        $("#pourcentage" + id).html(i+"%");

	        if (i != percent) {
	            i++;
	            theLoop(i);
	        }
	        
	    }, 20);

	})(0);
}

/** Fonction permettant de hover l'id en fonction de la visibilité d'un élément **/
function headerHover(elm,id){
	checkVisible(elm) ? $(id).addClass("header-a-hover") : $(id).removeClass("header-a-hover");
}

/** Animation de l'id de la gauche vers la droite en fonction de la visibilité d'un élement **/
function sliceInLeft(elm,id){
	checkVisible(elm) ? $(id).removeClass("left-init").addClass("left-end") : "unset";
}

/** Animation de l'id de la droite vers la gauche en fonction de la visibilité d'un élement **/
function sliceInRight(elm,id) {
	checkVisible(elm) ? $(id).removeClass("right-init").addClass("right-end") : "unset";
}


