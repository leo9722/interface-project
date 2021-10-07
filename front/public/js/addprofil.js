'use strict';

// On attend que l'utilisateur soumet sa requête
$('#adduser').bind('click', validateLogin);

//------------------------------------------------------------------
//--- validateLogin ------------------------------------------------
//------------------------------------------------------------------
// Envoie une requête au serveur avec les informations rentrées par l'utilisateur
// \param event Évènement de la page actuelle
function validateLogin(event) {
	event.preventDefault();	// Empêche le rafraîchissement de la page
	ajaxRequest('GET', 'http://localhost:8000' + '/api/addprofil/?nom=' + $('#nom').val() + '&prenom=' + $('#prenom').val()+ '&plaques=' + $('#plaques').val() + '&photo=' + $('#photo').val(), setLogin);

}

//------------------------------------------------------------------
//--- setLogin -----------------------------------------------------
//------------------------------------------------------------------
// En fonction du retour, 
// \param auth Savoir si on valide ou pas l'authentication
function setLogin(auth) {
	// Si c'est bon
	if (auth) {
		$('#errors').hide();
				// On défini le nom et le prénom du responsable en cookie
		window.location = 'plaques.html';							// On redirectionne vers la page d'accueil
	}else { // Sinon on affiche une erreur 403
		window.alert('Identifiant ou mot de passe inccorecte');
		window.location='login.html'
	}
}