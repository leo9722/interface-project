<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\Common\Annotations\DocLexer;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\SerializerInterface;
use App\Entity\GestionHeure;
use App\Entity\Profil;
use App\Entity\Jours;
use App\Entity\Log;
use App\Entity\PlageHoraire;
use App\Entity\Utilisateurs;

class ApiController extends AbstractController
{
   	
   	/**
     * @Route("/api/profil/", name="getProfile")
     */

    public function get_profil_more(SerializerInterface $serializer){


      $all = array();

       $profils = $this->getDoctrine()->getRepository(Profil::class)->findApiAll();

       foreach($profils as $prof){

          $profilsTab = array();
      
          $profil = $this->getDoctrine()->getRepository(Profil::class)->findApiByProfil($prof['immatriculation']);

          $logs = $this->getDoctrine()->getRepository(Log::class)->findApiByProfil($profil[0]['id']);

          //$gestionHeures = $this->getDoctrine()->getRepository(GestionHeure::class)->findApiByProfil($profil[0]['id']);
          $profil2 = $this->getDoctrine()->getRepository(Profil::class)->findByProfil($prof['immatriculation']);

          $gestionHeures = array();

          foreach($profil2[0]->getGestionHeures() as $gh){

            $gestionHeure = $this->getDoctrine()->getRepository(GestionHeure::class)->findApiByLast($gh->getId());

            $gestionHeures['gestionHeure'] = $gestionHeure;

            $plageHoraire = $this->getDoctrine()->getRepository(PlageHoraire::class)->findApiById($gh->getId());

            //dump($plageHoraire[0]);
          // die();

            if($plageHoraire){
                $gestionHeures['plageHoraire'][] = $plageHoraire[0];
            }


            $jour = $this->getDoctrine()->getRepository(Jours::class)->findApiById($gestionHeure[0]['id']);
            $gestionHeures['jours'] = $jour;          

            //$gestionHeures[$gh->getId()] = $gestionHeure;

          }


          $profilsTab[]['profil'] = $profil;
          $profilsTab[]['logs'] = $logs;
          $profilsTab[]['gestionHeures'] = $gestionHeures;
          $all[] = $profilsTab;
    

      }

      //die();


      


        // $Gestion_heure = $this->getDoctrine()
        //        ->getRepository(GestionHeure::class)
        //        ->findByGestion($profil->getGestionHeures()->getId());


      
        $superall = array();
        $superall[] = $all;
        $superall = $serializer->serialize($superall, 'json');


        $response = new Response();
        
        $response->setContent($superall);
        $response->headers->set('Content-Type', 'application/json');
        $response->headers->set('Access-Control-Allow-Origin', '*');
        return $response;

    }
  /**
     * @Route("/api/utilisateur/", methods={"GET"}, name="getUsername")
     */

    public function getUsername(SerializerInterface $serializer){

      $data ="";
      
      if (isset($_GET['mail']) && isset($_GET['password'])) {
      // On regarde dans la bdd si c'est le bon USER
      $data = $this->getDoctrine()->getRepository(Utilisateurs::class)->findUser($_GET['mail'],$_GET['password']);

      if($data == NULL){

        $data=null;

        $response = new Response();
        
        $response->setContent($data);
        $response->headers->set('Content-Type', 'application/json');
        $response->headers->set('Access-Control-Allow-Origin', '*');
        return $response;

        }
      
      else{


      $data = $serializer->serialize($data, 'json');

      $response = new Response();
        
        $response->setContent($data);
        $response->headers->set('Content-Type', 'application/json');
        $response->headers->set('Access-Control-Allow-Origin', '*');
        return $response;
      }

      }
    }



      


      // $profil = $this->getDoctrine()
      //           ->getRepository(Utilisateurs::class)
      //           ->findUSer($mail, $pass);
    


     /**
     * @Route("/api/addprofil/", methods={"GET"}, name="addprofil")
     */

    public function addProfil(SerializerInterface $serializer){

      $response = new Response();

      if (isset($_GET['nom']) && isset($_GET['prenom']) && isset($_GET['plaques']) && isset($_GET['photo'])) {
      // On regarde dans la bdd si c'est bon
       $profil =new Profil();
       $utilisateur = $this->getDoctrine()->getRepository(Utilisateurs::class)->find(1);


       $profil->setNom($_GET['nom']);
       $profil->setPrenom($_GET['prenom']);
       $profil->setImmatriculation($_GET['plaques']);
       $profil->setUrlPhoto($_GET['photo']);
       $profil->setUtilisateurs($utilisateur);
       $profil->setInvite(1);


      $entityManager = $this->getDoctrine()->getManager();
      $entityManager->persist($profil);
      $entityManager->flush();

        
        $response->setContent("utilisateur creer");
        $response->headers->set('Content-Type', 'application/json');
        $response->headers->set('Access-Control-Allow-Origin', '*');
        return $response;
       }

        $response->setContent("error");
        $response->headers->set('Content-Type', 'application/json');
        $response->headers->set('Access-Control-Allow-Origin', '*');
        return $response;
  }



/**
     * @Route("/api/profils", name="getProfiles")
     */
     public function getProfils(SerializerInterface $serializer){

      $profils = $this->getDoctrine()->getRepository(Profil::class)->findApiAll();

      $profils = $serializer->serialize($profils, 'json');

      
        $response = new Response();
        $response->setContent($profils);
        $response->headers->set('Content-Type', 'application/json');
        $response->headers->set('Access-Control-Allow-Origin', '*');
        return $response;


     }


       /**
     * @Route("/api/cookies/", methods={"GET"}, name="getCookie")
     */

    public function getCookie(SerializerInterface $serializer){

      $data ="";
      
      if (isset($_GET['token']) && isset($_GET['mail'])) {
      // On regarde dans la bdd si c'est le bon USER
      $data = $this->getDoctrine()->getRepository(Utilisateurs::class)->findCookie($_GET['token'],$_GET['mail']);

      if($data == NULL){

        $data=null;

        $response = new Response();
        
        $response->setContent($data);
        $response->headers->set('Content-Type', 'application/json');
        $response->headers->set('Access-Control-Allow-Origin', '*');
        return $response;

        }
      
      else{


      $data = $serializer->serialize($data, 'json');

      $response = new Response();
        
        $response->setContent($data);
        $response->headers->set('Content-Type', 'application/json');
        $response->headers->set('Access-Control-Allow-Origin', '*');
        return $response;
      }

      }
    }

}