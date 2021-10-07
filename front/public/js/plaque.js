'use strict';


ajaxRequest('GET', 'http://localhost:8000' + '/api/cookies/?token=' + Cookies.get('token') + "&mail=" + Cookies.get('mail'), page);

function page(token) {
	if(token){

		
		
		console.log('okay for the token');

		carousselle();	
	}else { // Sinon on affiche une erreur 403
		window.alert('Go away Hackers');
		window.location='login.html'
	}
}




function carousselle(){


 ajaxRequest('GET', 'http://localhost:8000' + '/api/profils/',affiche);
}

 function affiche (data) {


		var main = '<div class="gallery js-flickity caroussel">' 

		var fin ='</div>'

		var cellule='';


		console.log(data);

		data.map((profil,i)=>{

			// var $carousel = $('.carousel').flickity('destroy');
			// $carousel.flickity();

		cellule+='<div class="gallery-cell""><button class="acces">ACCES ILLIMITE</button><div class="identite"><h1>'+ profil.nom +'</h1><h1> ' + profil.prenom +' </h1></div><h1 class="plaques">'+ profil.immatriculation +'</h1></div>'
	
	})



var addition =main+cellule+fin;



 $('#cells').html(addition);

var caroussel = $('.caroussel').flickity();

}







	



 