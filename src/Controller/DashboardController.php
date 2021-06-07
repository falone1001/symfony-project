<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\FormBuilder;
use Symfony\Component\Form\FormTypeInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use App\Entity\PlanPricing;
use App\Entity\Faq;
use App\Form\Type\PlanPricingType;
use App\Form\Type\FaqsType;


class DashboardController extends AbstractController
{
    /**
     * @Route("/dashboard", name="dashboard")
     */
    public function indexAction(): Response
    {
        return $this->render('dashboard/index.html.twig', [ 'title' => 'Dashboard']);

    }


    /**
     * @Route("/dashboard/orders", name="orders")
     */
    public function ordersAction(): Response
    {
        return $this->render('dashboard/orders.html.twig', [ 'title' => 'Orders']);

    }

    /**
     * @Route("/dashboard/customers", name="customers")
     */
    public function customersAction(): Response
    {
        return $this->render('dashboard/customers.html.twig', [ 'title' => 'Customers']);

    }

    /**
     * @Route("/dashboard/faqs", name="faqs")
     */
    public function faqsAction(Request $request): Response
    {
         // Create form
         $faqs = new Faq();
         $form = $this->createFormBuilder($faqs)
             ->add('question', TextType::class)
             ->add('answer', TextareaType::class)
             ->add('save', SubmitType::class)
             ->getForm();
         $form = $this->createForm(FaqsType::class, $faqs);
 
         // Process form
         $form->handleRequest($request);
 
         if ($form->isSubmitted() && $form->isValid()) {
             $faqs = $form->getData();
             // Persist data to database
             $entityManager = $this->getDoctrine()->getManager();
             $entityManager->persist($faqs);
             $entityManager->flush();
 
             // Redirect user upon successfully submitting the form
             return $this->redirectToRoute('faqs');
         }
        // List faqs

        $em = $this->getDoctrine()->getManager();
        $repo = $em->getRepository(Faq::class);
        $faqs = $repo->findAll();

        return $this->render('dashboard/faqs.html.twig', [
            'title' => 'FAQs',
            'faqs' => $faqs,
            'form' => $form->createView(),
            'deleted' => false,
         ]);
        // return $this->render('dashboard/faqs.html.twig', [ 'title' => 'FAQs']);

    }

    /**
     * @Route("/dashboard/faqs/delete/{id}", name="delete_faqs")
     */
    public function faqsDeleteAction($id, Request $request): Response
    {
        $em = $this->getDoctrine()->getManager();
        $repo = $em->getRepository(Faq::class);
        $faq = $repo->find($id); 
        $em->remove($faq);
        $em->flush();
        return $this->redirectToRoute('faqs', ['deleted' => true]); 
    }

    /**
     * @Route("/dashboard/faqs/update/{id}", name="update_faqs")
     */
    public function faqsUpdateAction($id, Request $request): Response
    {

        // List faqs

        $em = $this->getDoctrine()->getManager();
        $repo = $em->getRepository(Faq::class);
        $faqs = $repo->findAll();


        // Fetch plan data from database and append it to form values
        $em = $this->getDoctrine()->getManager();
        $repo = $em->getRepository(Faq::class);
        $faq = $repo->find($id); 
        $form = $this->createFormBuilder($faq)
            ->add('question', TextType::class)
            ->add('answer', TextareaType::class)
            ->add('save', SubmitType::class)
            ->getForm();
        $form = $this->createForm(FaqsType::class, $faq);
         // Process form
         $form->handleRequest($request);
         if ($form->isSubmitted() && $form->isValid()) {
            $faq = $form->getData();
                $em = $this->getDoctrine()->getManager();
                $em->persist($faq);
                $em->flush();
            // Redirect user upon successfully submitting the form
            return $this->redirectToRoute('faqs', ['updated' => true]);
        }
        return $this->render('dashboard/faqsUpdate.html.twig', [
            'title' => 'FAQs',
            'faqs' => $faqs,
            'form' => $form->createView(),
            'updated' => false
            ]);
        // return $this->redirectToRoute('plans'); 
    }

    /**
     * @Route("/dashboard/plans", name="plans")
     */
    public function plansAction(Request $request): Response
    {
        // Create form
        $plan = new PlanPricing();
        $form = $this->createFormBuilder($plan)
            ->add('title', TextType::class)
            ->add('price', IntegerType::class)
            ->add('ram', IntegerType::class)
            ->add('storage', IntegerType::class)
            ->add('backup', CheckboxType::class, [ 'required' => false ])
            ->add('save', SubmitType::class)
            ->getForm();
        $form = $this->createForm(PlanPricingType::class, $plan);

        // Process form
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $plan = $form->getData();
            // Persist data to database
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($plan);
            $entityManager->flush();

            // Redirect user upon successfully submitting the form
            return $this->redirectToRoute('plans');
        }
        
        // List plans

        $em = $this->getDoctrine()->getManager();
        $repo = $em->getRepository(PlanPricing::class);
        $plans = $repo->findAll();

        return $this->render('dashboard/plans.html.twig', [
            'title' => 'Plans',
            'plans' => $plans,
            'form' => $form->createView(),
         ]);

    }

    /**
     * @Route("/dashboard/plans/delete/{id}", name="delete_plans")
     */
    public function plansDeleteAction($id, Request $request): Response
    {
        $em = $this->getDoctrine()->getManager();
        $repo = $em->getRepository(PlanPricing::class);
        $plan = $repo->find($id); 
        $em->remove($plan);
        $em->flush();
        return $this->redirectToRoute('plans'); 
    }


     /**
     * @Route("/dashboard/plans/update/{id}", name="update_plans")
     */
    public function plansUpdateAction($id, Request $request): Response
    {

        // List plans

        $em = $this->getDoctrine()->getManager();
        $repo = $em->getRepository(PlanPricing::class);
        $plans = $repo->findAll();


        // Fetch plan data from database and append it to form values
        $em = $this->getDoctrine()->getManager();
        $repo = $em->getRepository(PlanPricing::class);
        $plan = $repo->find($id); 
        $form = $this->createFormBuilder($plan)
            ->add('title', TextType::class)
            ->add('price', IntegerType::class)
            ->add('ram', IntegerType::class)
            ->add('storage', IntegerType::class)
            ->add('backup', CheckboxType::class, [ 'required' => false ])
            ->add('save', SubmitType::class)
            ->getForm();
        $form = $this->createForm(PlanPricingType::class, $plan);
         // Process form
         $form->handleRequest($request);
         if ($form->isSubmitted() && $form->isValid()) {
            $plan = $form->getData();
                $em = $this->getDoctrine()->getManager();
                $em->persist($plan);
                $em->flush();
            // Redirect user upon successfully submitting the form
            return $this->redirectToRoute('plans');
        }
        return $this->render('dashboard/plansUpdate.html.twig', [
            'title' => 'Plans',
            'plans' => $plans,
            'form' => $form->createView(),
            ]);
        // return $this->redirectToRoute('plans'); 
    }

    

}
