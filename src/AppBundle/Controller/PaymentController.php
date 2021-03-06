<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Employee;
use AppBundle\Entity\Payment;
use AppBundle\Form\PaymentType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
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
    public function addPaymentAction(Request $request)
    {
        $currEmployee = $this->getUser();

        if ($currEmployee === null || !$currEmployee->isFinancialManager() ) {
            return $this->redirectToRoute('homepage');
        }

        $payment = new Payment();
        $form = $this->createForm(PaymentType::class, $payment);
        $form->handleRequest($request);

        if($form->isSubmitted()){
            $em = $this->getDoctrine()->getManager();
            $em->persist($payment);
            $em->flush();

            $this->addFlash('info', "Payment Added");
            return $this->render('payment/addPayment.html.twig',
                ['form' => $form->createView()]);
        }

        return $this->render('payment/addPayment.html.twig',
            ['form' => $form->createView()]);
    }

    /**
     * @Route("/myPaymentsHistory", name="my_payments_history")
     * @Security("is_granted('IS_AUTHENTICATED_FULLY')")
     */
    public function myPaymentHistoryAction()
    {
        $employeeId = $this
            ->getUser()
            ->getId();

        $companyID = $this
            ->getDoctrine()
            ->getRepository(Employee::class)
            ->find($employeeId)
            ->getCompanyID();

        $repository = $this->getDoctrine()
            ->getRepository(Payment::class);

        $query = $repository->createQueryBuilder('p')
            ->where('p.companyID = :companyID')
            ->setParameter('companyID', $companyID)
            ->orderBy('p.payPeriod', 'DESC')
            ->setFirstResult( 1 )
            ->getQuery();

        $payments = $query->getResult();

        return $this->render("payment/myPaymentsHistory.html.twig",
            ['payments' => $payments]);
    }

    /**
     * @Route("/myLastPayment", name="my_last_payment")
     * @Security("is_granted('IS_AUTHENTICATED_FULLY')")
     */
    public function myLastPaymentAction()
    {
        $employeeId = $this
            ->getUser()
            ->getId();

        $companyID = $this
            ->getDoctrine()
            ->getRepository(Employee::class)
            ->find($employeeId)
            ->getCompanyID();

        $repository = $this->getDoctrine()
            ->getRepository(Payment::class);

        $query = $repository->createQueryBuilder('p')
            ->where('p.companyID = :companyID')
            ->setParameter('companyID', $companyID)
            ->orderBy('p.payPeriod', 'DESC')
            ->setMaxResults(1)
            ->getQuery();

        $payment = $query->getResult();

        return $this->render("payment/myLastPayment.html.twig",
            ['payment' => $payment]);
    }

    /**
     * @Route("/allPayments", name="all_payments")
     * @Security("is_granted('IS_AUTHENTICATED_FULLY')")
     */
    public function allPaymentsAction()
    {
        $currEmployee = $this->getUser();

        if ($currEmployee === null || !$currEmployee->isFinancialManager() ) {
            return $this->redirectToRoute('homepage');
        }

        $repository = $this->getDoctrine()
            ->getRepository(Payment::class);

        $query = $repository->createQueryBuilder('p')
            ->addOrderBy('p.payPeriod', 'DESC')
            ->addOrderBy('p.companyID', 'ASC')
            ->getQuery();

        $payments = $query->getResult();



        return $this->render("payment/allPayments.html.twig", [
            'payments' => $payments,
        ]);
    }
}
