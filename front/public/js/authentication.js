'use strict';

// On attend que l'utilisateur soumet sa requête
$('#authentication-send').bind('click', validateLogin);

//------------------------------------------------------------------
//--- validateLogin ------------------------------------------------
//------------------------------------------------------------------
// Envoie une requête au serveur avec les informations rentrées par l'utilisateur
// \param event Évènement de la page actuelle
function validateLogin(event) {
	event.preventDefault();	// Empêche le rafraîchissement de la page
	ajaxRequest('GET', 'http://localhost:8000' + '/api/utilisateur/?mail=' + $('#login').val() + '&password=' + $('#password').val(), setLogin);

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

		Cookies.set('token', auth[0].token, {sameSite: 'lax'});
		Cookies.set('mail', auth[0].mail, {sameSite: 'lax'});			// On défini le nom et le prénom du responsable en cookie
		window.location = 'invite.html';							// On redirectionne vers la page d'accueil
	}else { // Sinon on affiche une erreur 403
		window.alert('Identifiant ou mot de passe inccorecte');
		window.location='login.html'
	}
}