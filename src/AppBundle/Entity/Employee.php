<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Employee
 *
 * @ORM\Table(name="employees")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\EmployeeRepository")
 */
class Employee
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="companyID", type="string", length=100, unique=true)
     */
    private $companyID;

    /**
     * @var string
     *
     * @ORM\Column(name="fullName", type="string", length=255)
     */
    private $fullName;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=100, unique=true)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="bankAccount", type="string", length=30, unique=true)
     */
    private $bankAccount;

    /**
     * @var string
     *
     * @ORM\Column(name="baseSalary", type="decimal", precision=0, scale=0)
     */
    private $baseSalary;

    /**
     * @var string
     *
     * @ORM\Column(name="password", type="string", length=255)
     */
    private $password;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set companyID
     *
     * @param string $companyID
     *
     * @return Employee
     */
    public function setCompanyID($companyID)
    {
        $this->companyID = $companyID;

        return $this;
    }

    /**
     * Get companyID
     *
     * @return string
     */
    public function getCompanyID()
    {
        return $this->companyID;
    }

    /**
     * Set fullName
     *
     * @param string $fullName
     *
     * @return Employee
     */
    public function setFullName($fullName)
    {
        $this->fullName = $fullName;

        return $this;
    }

    /**
     * Get fullName
     *
     * @return string
     */
    public function getFullName()
    {
        return $this->fullName;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return Employee
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set bankAccount
     *
     * @param string $bankAccount
     *
     * @return Employee
     */
    public function setBankAccount($bankAccount)
    {
        $this->bankAccount = $bankAccount;

        return $this;
    }

    /**
     * Get bankAccount
     *
     * @return string
     */
    public function getBankAccount()
    {
        return $this->bankAccount;
    }

    /**
     * Set baseSalary
     *
     * @param string $baseSalary
     *
     * @return Employee
     */
    public function setBaseSalary($baseSalary)
    {
        $this->baseSalary = $baseSalary;

        return $this;
    }

    /**
     * Get baseSalary
     *
     * @return string
     */
    public function getBaseSalary()
    {
        return $this->baseSalary;
    }

    /**
     * Set password
     *
     * @param string $password
     *
     * @return Employee
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get password
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }
}
