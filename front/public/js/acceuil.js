'use strict';


//Requête permettant le chargement de la page initiale
ajaxRequest('GET', 'http://localhost:8000' + '/api/cookies/?token=' + Cookies.get('token') + "&mail=" + Cookies.get('mail'), page);

function page(data) {
	if(data){
		console.log('okay for the token');
					// On redirectionne vers la page d'accueil
	}else { // Sinon on affiche une erreur 403
		window.alert('Go away Hackers');
		window.location='login.html'
	}
}
