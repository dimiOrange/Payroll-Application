<?php
namespace AppBundle\Entity;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Security\Core\User\UserInterface;
use Doctrine\ORM\Mapping as ORM;
/**
 * Employee
 *
 * @ORM\Table(name="employees")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\EmployeeRepository")
 */
class Employee implements UserInterface
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
     * @var ArrayCollection
     *
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Role")
     *
     * @ORM\JoinTable(name="employees_roles",
     *     joinColumns={@ORM\JoinColumn(name="employee_id", referencedColumnName="id")},
     *     inverseJoinColumns={@ORM\JoinColumn(name="role_id", referencedColumnName="id")}
     *   )
     */
    private $roles;


    public function __construct()
    {
        $this->roles = new ArrayCollection();
    }


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

    /**
     * Returns the roles granted to the user.
     *
     *     public function getRoles()
     *     {
     *         return array('ROLE_USER');
     *     }
     *
     * Alternatively, the roles might be stored on a ``roles`` property,
     * and populated in any number of different ways when the user object
     * is created.
     *
     * @return (Role|string)[] The user roles
     */
    public function getRoles()
    {
        $stringRoles = [];

        foreach ($this->roles as $role){
            /** @var Role $role */
            $stringRoles[] = $role->getRole();
        }

        return $stringRoles;
    }

    /**
     * @param \AppBundle\Entity\Role $role
     *
     * @return Employee
     */
    public function addRole(Role $role)
    {
        $this->roles[]= $role;
        return $this;
    }


    /**
     * Returns the salt that was originally used to encode the password.
     *
     * This can return null if the password was not encoded using a salt.
     *
     * @return string|null The salt
     */
    public function getSalt()
    {
        // TODO: Implement getSalt() method.
    }
    /**
     * Returns the username used to authenticate the user.
     *
     * @return string The username
     */
    public function getUsername()
    {
        return $this->email;
    }
    /**
     * Removes sensitive data from the user.
     *
     * This is important if, at any given point, sensitive information like
     * the plain-text password is stored on this object.
     */
    public function eraseCredentials()
    {
        // TODO: Implement eraseCredentials() method.
    }
}