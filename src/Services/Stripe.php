<?php


namespace App\Services;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class Stripe extends AbstractController
{


    public function checkout()
    {
        \Stripe\Stripe::setApiKey('sk_test_51ITnBKAwi7CWBhUn7MbWJrbhMdyAVyfFSWju5ldKyM1R9Bl1GHkWC8KIYiIefQxNCcaZS5nfn1m0yOrgyMFNU6EV00Cyg1AsfY');

        $session = \Stripe\Checkout\Session::create([
            'payment_method_types' => ['card'],
            'line_items' => [[
                'price_data' => [
                    'currency' => 'eur',
                    'product_data' => [
                        'name' => 'Cours',
                    ],
                    'unit_amount' => 2000,
                ],
                'quantity' => 1,
            ]],
            'mode' => 'payment',
            'success_url' => $this->generateUrl('success', [], UrlGeneratorInterface::ABSOLUTE_URL),
            'success_url' => $this->generateUrl('accueil', [], UrlGeneratorInterface::ABSOLUTE_URL),
        ]);

        return new JsonResponse(['id' => $session->id ]);

    }


    /**
     * @Route("/success",name="default")
     */
    public function success()
    {

        return $this->render('accueil/success.html.twig');

    }


    /**
     * @Route("/error",name="default")
     */
    public function error()
    {

        return $this->render('accueil/error.html.twig');

    }
}