<?php

namespace App\Controller;

use App\Entity\Evenement;
use App\Entity\Photo;
use App\Entity\Video;
use App\Entity\Avis;
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
     * @Route("/accueil", name="accueil")
     */
    public function index(): Response
    {
        $list = $this->getDoctrine()->getRepository(Evenement::class)->findAll();

        return $this->render('accueil/index.html.twig', [
            'eventsList'=>$list
        ]);
    }

    /**
     * @Route("/accueil/{id}", name="accueil.show")
     */
    public function show($id): Response
    {
        $evenement = $this->getDoctrine()->getRepository(Evenement::class) -> find($id);
        $photosEvenement = $this->getDoctrine()->getRepository(Photo::class) -> findBy(array('evenement' => $id));
        $avisEvenement = $this->getDoctrine()->getRepository(Avis::class) -> findBy(array('evenement' => $id));

        //lieu, avis, offretarfif

        $nomPhoto = array() ;
        foreach($photosEvenement as $photosEvenements){
            $nomPhoto[] = $photosEvenements->getNom();            
        }

        $noteAvis = array() ;
        $commentaireAvis = array() ;
        foreach($avisEvenement as $avisEvenements){
            $noteAvis[] = $avisEvenements->getNote();   
            $commentaireAvis[] = $avisEvenements->getCommentaire();            
        }

        

        return $this->render('accueil/show.html.twig', [
            'evenement' => $evenement,
            'nomPhotos' => $nomPhoto,
            'noteAvis' => $noteAvis,
            'commentaireAvis' => $commentaireAvis
        ]);
    }

}
