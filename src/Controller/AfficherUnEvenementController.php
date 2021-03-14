<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AfficherUnEvenementController extends AbstractController
{
    /**
     * @Route("event", name="afficher_un_evenement")
     */
    public function index(): Response
    {
        return $this->render('afficher_un_evenement/index.html.twig', [
            'controller_name' => 'AfficherUnEvenementController',
        ]);
    }
}
