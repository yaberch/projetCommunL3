<?php

namespace App\Controller;

use App\Entity\Evenement;
use App\Entity\Photo;
use App\Entity\Video;
use App\Entity\Avis;
use App\Services\Stripe;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route; 

use App\Form\LaisserAvisType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

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
     * @Route("/success", name="success")
     */
    public function success()
    {
        return $this->render('accueil/success.html.twig', [
        ]);
    }

    /**
     * @Route("/error", name="error")
     */
    public function error()
    {
        return $this->render('accueil/error.html.twig', [
        ]);
    }




    /**
     * @Route("/", name="paiement")
     * @Route("/create-checkout-session", name="checkout")
     */
    public function checkout()
    {
        \Stripe\Stripe::setApiKey('sk_test_51ITnBKAwi7CWBhUn7MbWJrbhMdyAVyfFSWju5ldKyM1R9Bl1GHkWC8KIYiIefQxNCcaZS5nfn1m0yOrgyMFNU6EV00Cyg1AsfY');

        $session = \Stripe\Checkout\Session::create([
            'payment_method_types' => ['card'],
            'line_items' => [[
                'price_data' => [
                    'currency' => 'eur',
                    'product_data' => [
                        'name' => 'Soiree',
                    ],
                    'unit_amount' => 2000,
                ],
                'quantity' => 1,
            ]],
            'mode' => 'payment',
            'success_url' => $this->generateUrl('success', [], UrlGeneratorInterface::ABSOLUTE_URL),
            'cancel_url' => $this->generateUrl('error', [], UrlGeneratorInterface::ABSOLUTE_URL),
        ]);
        return new JsonResponse(['id' => $session->id ]);

    }

    // Getters ------------------------------------------------------------------------------
    public function getCart(){
        return $this -> userSession -> get('cart', []);
    }

    public function getAmount(){
        return $this -> userSession -> get('totalAmount', []);
    }



    public function getTotalAmount(){
        $cart = $this -> getCart();
        $totalAmount = 0;
        foreach ($cart as $element){
            $totalAmount = $totalAmount + ($element[3] * $element[2]);
        }
        $amount = $this -> getAmount();
        $amount[0] = round($totalAmount - $amount[1], 2);
        $this -> userSession -> set('totalAmount', $amount);
        return $amount[0] ;
    }







}
