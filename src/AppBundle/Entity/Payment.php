<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Payment
 *
 * @ORM\Table(name="payments")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\PaymentRepository")
 */
class Payment
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
     * @ORM\Column(name="payPeriod", type="string", length=255)
     */
    private $payPeriod;

    /**
     * @return string
     */
    public function getCompanyID()
    {
        return $this->companyID;
    }

    /**
     * @param string $companyID
     */
    public function setCompanyID($companyID)
    {
        $this->companyID = $companyID;
    }

    /**
     * @var string
     *
     * @ORM\Column(name="companyID", type="string", length=255)
     */
    private $companyID;

    /**
     * @var string
     *
     * @ORM\Column(name="additionalToBaseSalary", type="decimal", precision=10, scale=0)
     */
    private $additionalToBaseSalary;

    /**
     * @var string
     *
     * @ORM\Column(name="grossAmount", type="decimal", precision=10, scale=0)
     */
    private $grossAmount;

    /**
     * @var string
     *
     * @ORM\Column(name="socialSecurityEmployee", type="decimal", precision=10, scale=0)
     */
    private $socialSecurityEmployee;

    /**
     * @var string
     *
     * @ORM\Column(name="pit", type="decimal", precision=10, scale=0)
     */
    private $pit;

    /**
     * @var string
     *
     * @ORM\Column(name="netSalary", type="decimal", precision=10, scale=0)
     */
    private $netSalary;

    /**
     * @var string
     *
     * @ORM\Column(name="socialSecurityEmployer", type="decimal", precision=10, scale=0)
     */
    private $socialSecurityEmployer;

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
     * Set payPeriod
     *
     * @param string $payPeriod
     *
     * @return Payment
     */
    public function setPayPeriod($payPeriod)
    {
        $this->payPeriod = $payPeriod;

        return $this;
    }

    /**
     * Get payPeriod
     *
     * @return string
     */
    public function getPayPeriod()
    {
        return $this->payPeriod;
    }

    /**
     * Set additionalToBaseSalary
     *
     * @param string $additionalToBaseSalary
     *
     * @return Payment
     */
    public function setAdditionalToBaseSalary($additionalToBaseSalary)
    {
        $this->additionalToBaseSalary = $additionalToBaseSalary;

        return $this;
    }

    /**
     * Get additionalToBaseSalary
     *
     * @return string
     */
    public function getAdditionalToBaseSalary()
    {
        return $this->additionalToBaseSalary;
    }

    /**
     * Set grossAmount
     *
     * @param string $grossAmount
     *
     * @return Payment
     */
    public function setGrossAmount($grossAmount)
    {
        $this->grossAmount = $grossAmount;

        return $this;
    }

    /**
     * Get grossAmount
     *
     * @return string
     */
    public function getGrossAmount()
    {
        return $this->grossAmount;
    }

    /**
     * Set socialSecurityEmployee
     *
     * @param string $socialSecurityEmployee
     *
     * @return Payment
     */
    public function setSocialSecurityEmployee($socialSecurityEmployee)
    {
        $this->socialSecurityEmployee = $socialSecurityEmployee;

        return $this;
    }

    /**
     * Get socialSecurityEmployee
     *
     * @return string
     */
    public function getSocialSecurityEmployee()
    {
        return $this->socialSecurityEmployee;
    }

    /**
     * Set pit
     *
     * @param string $pit
     *
     * @return Payment
     */
    public function setPit($pit)
    {
        $this->pit = $pit;

        return $this;
    }

    /**
     * Get pit
     *
     * @return string
     */
    public function getPit()
    {
        return $this->pit;
    }

    /**
     * Set netSalary
     *
     * @param string $netSalary
     *
     * @return Payment
     */
    public function setNetSalary($netSalary)
    {
        $this->netSalary = $netSalary;

        return $this;
    }

    /**
     * Get netSalary
     *
     * @return string
     */
    public function getNetSalary()
    {
        return $this->netSalary;
    }

    /**
     * Set socialSecurityEmployer
     *
     * @param string $socialSecurityEmployer
     *
     * @return Payment
     */
    public function setSocialSecurityEmployer($socialSecurityEmployer)
    {
        $this->socialSecurityEmployer = $socialSecurityEmployer;

        return $this;
    }

    /**
     * Get socialSecurityEmployer
     *
     * @return string
     */
    public function getSocialSecurityEmployer()
    {
        return $this->socialSecurityEmployer;
    }
}

