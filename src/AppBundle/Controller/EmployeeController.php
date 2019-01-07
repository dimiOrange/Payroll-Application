<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Employee;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class EmployeeController extends Controller
{
    /**
     * @Route("/profile", name="employee_profile")
     */
    public function profile(){
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
