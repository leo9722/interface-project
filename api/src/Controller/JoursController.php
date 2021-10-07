<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class JoursController extends AbstractController
{
    /**
     * @Route("/jours", name="jours")
     */
    public function index(): Response
    {
        return $this->render('jours/index.html.twig', [
            'controller_name' => 'JoursController',
        ]);
    }
}
