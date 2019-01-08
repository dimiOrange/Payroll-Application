<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Payment;
use AppBundle\Form\PaymentType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class PaymentController extends Controller
{
    /**
     * @Route("/addPayment", name="add_payment")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function registerAction(Request $request)
    {
        $payment = new Payment();
        $form = $this->createForm(PaymentType::class, $payment);
        $form->handleRequest($request);

        if($form->isSubmitted()){
            $em = $this->getDoctrine()->getManager();
            $em->persist($payment);
            $em->flush();

            $this->addFlash('info', "Payment Added");
            return $this->redirectToRoute("security_login");
        }

        return $this->render('payment/addPayment.html.twig',
            ['form' => $form->createView()]);
    }
}
