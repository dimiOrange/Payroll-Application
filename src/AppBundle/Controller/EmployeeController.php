<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Role;
use AppBundle\Entity\Employee;
use AppBundle\Form\EmployeeType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
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
        $currEmployee = $this->getUser();
        if ($currEmployee === null || !$currEmployee->isPersonnelManager()) {
            return $this->redirectToRoute('homepage');
        }

        $employee = new Employee();
        $form = $this->createForm(EmployeeType::class, $employee);
        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            $emailForm = $form->getData()->getEmail();
            $employeeForm = $this
                ->getDoctrine()
                ->getRepository(Employee::class)
                ->findOneBy(['email' => $emailForm]);

            if (null !== $employeeForm) {
                $this->addFlash('info', "Username with email " . $emailForm . " already taken!");
                return $this->render('employee/register.html.twig', ['form' => $form->createView()]);
            }

            $password = $this->get('security.password_encoder')
                ->encodePassword($employee, $employee->getPassword());

            $role = $this
                ->getDoctrine()
                ->getRepository(Role::class)
                ->findOneBy(['name' => 'ROLE_EMPLOYEE']);

            $employee->addRole($role);

            $employee->setPassword($password);

            $em = $this->getDoctrine()->getManager();
            $em->persist($employee);
            $em->flush();

            $this->addFlash('info', "Employee " . $employee->getFullName() . " was successfully registered");
            return $this->redirectToRoute('employee_register');
        }

        return $this->render('employee/register.html.twig',
            ['form' => $form->createView()]);
    }

    /**
     * @Route("/profile", name="employee_profile")
     */
    public function profileAction()
    {
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

    /**
     * @Route("/changePassword", name="employee_change_password")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function changePasswordAction(Request $request)
    {
        $employeeId = $this
            ->getUser()
            ->getId();

        $entityManager = $this->getDoctrine()->getManager();
        $employee = $entityManager
            ->getRepository(Employee::class)
            ->find($employeeId);

        $defaultData = array('pass' => 'New Password', 'repeatPass' => 'Repeat New Password');
        $form = $this->createFormBuilder($defaultData)
            ->add('pass', PasswordType::class, array('label' => 'New Password'))
            ->add('repeatPass', PasswordType::class, array('label' => 'Repeat New Password'))
            ->add('send', SubmitType::class)
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            $pass = $data['pass'];
            $repeatPass = $data['repeatPass'];

            if ($pass !== $repeatPass) {
                return $this->render('employee/changePassword.html.twig', array(
                    'form' => $form->createView(),
                ));
            }

            $employee->setPassword($pass);

            $password = $this->get('security.password_encoder')
                ->encodePassword($employee, $employee->getPassword());

            $employee->setPassword($password);
            $entityManager->flush();

            $this->addFlash('info', "Password changed.");
            return $this->render('employee/changePassword.html.twig', array(
                'form' => $form->createView(),
            ));
        }

        return $this->render('employee/changePassword.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    /**
     * @Route("/findEmployee", name="find_employee")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function findEmployeeAction(Request $request)
    {
        $currEmployee = $this->getUser();
        if ($currEmployee === null || !$currEmployee->isPersonnelManager()) {
            return $this->redirectToRoute('homepage');
        }
        
        $defaultData = array('companyID' => 'Company ID No');
        $form = $this->createFormBuilder($defaultData)
            ->add('companyID', TextType::class, array('label' => 'Company ID No'))
            ->add('send', SubmitType::class)
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            $companyID = $data['companyID'];

            $entityManager = $this->getDoctrine()->getManager();
            $employee = $entityManager
                ->getRepository(Employee::class)
                ->findOneBy(array('companyID' => $companyID));

            return $this->render("employee/viewEmployeeDetails.html.twig",
                ['employee' => $employee, 'form' => $form->createView()]);
        }

        return $this->render('employee/findEmployee.html.twig', array(
            'form' => $form->createView(),
        ));
    }
}