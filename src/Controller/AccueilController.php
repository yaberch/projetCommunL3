<?php

namespace App\Controller;

use App\Entity\Evenement;
use App\Entity\Photo;
use App\Entity\Search;
use App\Entity\Video;
use App\Entity\Avis;
use App\Form\SearchType;
use App\Services\Stripe;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route; 

use App\Form\LaisserAvisType;
use Symfony\Component\HttpFoundation\Request;

class AccueilController extends AbstractController
{
    /**
     * @Route("/accueil", name="accueil")
     * @param Request $request
     * @return Response
     */
    public function index(Request $request): Response
    {
        $search = new Search();
        $form = $this->createForm(SearchType::class, $search);
        $form->handleRequest($request);

        $list = $this->getDoctrine()->getRepository(Evenement::class)->findSearch($search);

        return $this->render('accueil/index.html.twig', [
            'eventsList'=>$list,
            'form' => $form->createView()
        ]);
    }


    /**
     * @Route("/accueil/{id}", name="accueil.show")
     */
    public function show(Request $request, $id): Response
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

   // on créer un avis
        $avis = new Avis();

        //on recup le formulaire
        $formAvis = $this->createForm(LaisserAvisType::class, $avis);

        if('POST' === $request->getMethod()) {

            // on relie le formulaire
            $formAvis -> handleRequest($request);

                // si le formulaire a été soumis
                if($formAvis -> isSubmitted()) {

                    $avis->setEvenement($evenement);
                    $avis->setDate(new \DateTime('now'));

                    // entity manager
                    $em = $this -> getDoctrine() -> getManager();

                    // lien entre doctrine et l'objet
                    $em -> persist($avis);

                    // enregistrer dans la bdd
                    $em->flush();
                }
        }        

        return $this->render('accueil/show.html.twig', [
            'evenement' => $evenement,
            'nomPhotos' => $nomPhoto,
            'noteAvis' => $noteAvis,
            'commentaireAvis' => $commentaireAvis,

            'formAvis' => $formAvis->createView(),
            'idEvenement' => $id 
        ]);
    }

    /**
     * @Route("/create-checkout-session", name="checkout")
     */
    public function checkout(Stripe $stripe)
    {
        return $stripe -> checkout();
    }

    /**
     * @Route("/success/{paymentType}", name="success")
     */
    public function success(String $paymentType, CartGestion $cart)
    {
        $cart -> createLessons($this->getUser(), $paymentType);
        return $this->render('index.html.twig', [
        ]);
    }
}
