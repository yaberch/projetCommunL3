<?php

namespace App\Controller;

use App\Entity\Evenement;
use App\Form\EventType;
use App\Security\LoginUserAuthenticator;
use Laminas\EventManager\Event;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Guard\GuardAuthenticatorHandler;

class AccueilController extends AbstractController
{
    /**
     * @Route("/", name="accueil")
     */
    public function index(): Response
    {
        $list = $this->getDoctrine()->getRepository(Evenement::class)->findAll();

        return $this->render('accueil/index.html.twig', [
            'eventsList'=>$list
        ]);
    }

}
