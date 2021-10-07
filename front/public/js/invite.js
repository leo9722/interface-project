'use strict';



ajaxRequest('GET', 'http://localhost:8000' + '/api/cookies/?token=' + Cookies.get('token') + "&mail=" + Cookies.get('mail'), page);

function page(data) {
    if (data) {
        console.log('okay for the token');

        carouselle()
        // On redirectionne vers la page d'accueil
    } else { // Sinon on affiche une erreur 403
        window.alert('Go away Hackers');
        window.location = 'login.html'
    }
}


function carouselle() {
    ajaxRequest('GET', 'http://localhost:8000' + '/api/profil/', affiche);
}

function affiche(data) {



    // let jsondata='[[[{"profil":[{"id":1,"immatriculation":"AA-123-AA","nom":"Rouet","prenom":"Gurvan","url_photo":"1-5646545431","invite":true}]},{"logs":[{"id":1,"info_entree":"2021-04-15T11:41:04+02:00"},{"id":2,"info_entree":"2021-04-16T13:24:29+02:00"}]},{"gestionHeures":{"gestionHeure":[{"id":3,"date_entree":"2021-04-23T00:00:00+02:00","date_sortie":"2021-04-24T00:00:00+02:00","type":true}],"plageHoraire":[{"id":1,"heure_entree":"1970-01-01T16:31:55+01:00","heure_sortie":"1970-01-01T17:21:55+01:00"}],"jours":[{"id":3,"jours":"Mercredi"}]}}],[{"profil":[{"id":2,"immatriculation":"BB-123-BB","nom":"Bob","prenom":"Marley","url_photo":"2-45674564564","invite":true}]},{"logs":[]},{"gestionHeures":{"gestionHeure":[{"id":2,"date_entree":"2021-04-09T00:00:00+02:00","date_sortie":"2021-04-24T00:00:00+02:00","type":true}],"jours":[{"id":2,"jours":"Mardi"}]}}]]]';

    // let data= JSON.parse(jsondata);


    var main = '<div class="gallery js-flickity caroussel">'

    var fin = '</div>'

    var cellule = '';


    // console.log(data[0][0][0].profil[0].nom);

    data[0].map((prof, i) => {


        let jour = 'Erreur';

        if (prof[2].gestionHeures) {
            if (prof[2].gestionHeures.jours) {

                jour = prof[2].gestionHeures.jours[0].jours;

            }
        }



        let date_entree = 'Erreur';

        let date_entree_heure = 'Erreur';

        if (prof[2].gestionHeures) {
            if (prof[2].gestionHeures.plageHoraire) {

                date_entree = prof[2].gestionHeures.plageHoraire[0].heure_entree;


                date_entree = date_entree.split('T');

                date_entree_heure = date_entree[1].split('-')



            }
        }


        let date_sortie = 'Erreur';
        let date_sortie_heure = 'Erreur';

        if (prof[2].gestionHeures) {
            if (prof[2].gestionHeures.plageHoraire) {

                date_sortie = prof[2].gestionHeures.plageHoraire[0].heure_sortie;

                date_sortie = date_sortie.split('T');

                date_sortie_heure = date_sortie[1].split('-')




            }
        }


        cellule += '<div class="gallery-cell"><button class="acces">ACCES PONCTUEL</button><div class="identite"><h1>' + prof[0].profil[0].nom + '</h1><h1>' + prof[0].profil[0].prenom + ' </h1></div><h1 class="plaques">' + prof[0].profil[0].immatriculation + '</h1><h1 class="horaire">' + jour + '</h1><h1 class="horaire">DE ' + date_entree_heure[0] + ' A ' + date_sortie_heure[0] + '</h1></div>'

    })



    var addition = main + cellule + fin;



    $('#cells').html(addition);

    var caroussel = $('.caroussel').flickity();
}