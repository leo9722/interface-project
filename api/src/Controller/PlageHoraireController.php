<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PlageHoraireController extends AbstractController
{
    /**
     * @Route("/plage/horaire", name="plage_horaire")
     */
    public function index(): Response
    {
        return $this->render('plage_horaire/index.html.twig', [
            'controller_name' => 'PlageHoraireController',
        ]);
    }
}
