<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Avis;
use App\Entity\Evenement;
use App\Form\LaisserAvisType;
use Symfony\Component\HttpFoundation\Request;

class LaisserAvisController extends AbstractController
{
    /**
     * @Route("/laisseravis/{id}", name="laisseravis")
     */
    public function ajouterAvis(Request $request, $id){
        $event = $this->getDoctrine()->getRepository(Evenement::class)->findOneBy([
            'id' => $id
        ]);

        // on créer un avis
        $avis = new Avis();

        //on recup le formulaire
        $formAvis = $this->createForm(LaisserAvisType::class, $avis);

        if('POST' === $request->getMethod()) {

            // on relie le formulaire
            $formAvis -> handleRequest($request);

                // si le formulaire a été soumis
                if($formAvis -> isSubmitted()) {

                    $avis->setEvenement($event);
                    $avis->setDate(new \DateTime('now'));

                    // entity manager
                    $em = $this -> getDoctrine() -> getManager();

                    // lien entre doctrine et l'objet
                    $em -> persist($avis);

                    // enregistrer dans la bdd
                    $em->flush();
                }
        }

        
        return $this->render('laisser_avis/index.html.twig', [
            'formAvis' => $formAvis->createView(),  
            'idEvenement' => $id          
        ]);
    }
}
