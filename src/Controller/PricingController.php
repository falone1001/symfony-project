<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\PlanPricing;

class PricingController extends AbstractController
{
    /**
     * @Route("/pricing", name="pricing")
     */
    public function index(): Response
    {

        // List plans

        $em = $this->getDoctrine()->getManager();
        $repo = $em->getRepository(PlanPricing::class);
        $plans = $repo->findAll();

        return $this->render('pricing/content.html.twig', [
            'title' => 'Pricing',
            'plans' => $plans
         ]);
        // return $this->render('pricing/content.html.twig', [ 'title' => 'Pricing' ]);

    }
}
