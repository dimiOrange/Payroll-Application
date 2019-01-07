<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Employee;
use AppBundle\Form\EmployeeType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class EmployeeController extends Controller
{
    /**
     * @Route("/register", name="employee_register")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function registerAction(Request $request)
    {
        $employee = new Employee();
        $form = $this->createForm(EmployeeType::class, $employee);
        $form->handleRequest($request);

        if($form->isSubmitted()){
            $emailForm = $form->getData()->getEmail();
            $employeeForm = $this
                ->getDoctrine()
                ->getRepository(Employee::class)
                ->findOneBy(['email' => $emailForm]);

            if(null !== $employeeForm){
                $this->addFlash('info', "Username with email " . $emailForm . " already taken!");
                return $this->render('employee/register.html.twig', ['form' => $form->createView()]);
            }

            $password = $this->get('security.password_encoder')
                ->encodePassword($employee, $employee->getPassword());

//            $role = $this
//                ->getDoctrine()
//                ->getRepository(Role::class)
//                ->findOneBy(['name' => 'ROLE_USER']);
//
//            $user->addRole($role);

            $employee->setPassword($password);

            $em = $this->getDoctrine()->getManager();
            $em->persist($employee);
            $em->flush();

            $this->addFlash('info', "Employee successfully registered");
            return $this->redirectToRoute("security_login");
        }

        return $this->render('employee/register.html.twig',
            ['form' => $form->createView()]);
    }

    /**
     * @Route("/profile", name="employee_profile")
     */
    public function profileAction(){
        $employeeId = $this
            ->getUser()
            ->getId();

        $employee = $this
            ->getDoctrine()
            ->getRepository(Employee::class)
            ->find($employeeId);

        return $this->render("employee/profile.html.twig",
            ['employee' => $employee]);
    }
}
