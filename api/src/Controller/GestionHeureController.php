<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class GestionHeureController extends AbstractController
{
    /**
     * @Route("/gestion/heure", name="gestion_heure")
     */
    public function index(): Response
    {
        return $this->render('gestion_heure/index.html.twig', [
            'controller_name' => 'GestionHeureController',
        ]);
    }
}
