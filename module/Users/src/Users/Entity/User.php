<?php
namespace Users\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
class User
{

    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    public $id;

    /**
     * @ORM\Column(type="string")
     */
    public $name;

    /**
     * @ORM\Column(type="string",length=300,unique=true)
     */
    public $email;

    /**
     * @ORM\Column(type="string")
     */
    public $password;

    /**
     *
     * @return the $id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     *
     * @return the $name
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     *
     * @return the $email
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     *
     * @return the $password
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     *
     * @param field_type $id            
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     *
     * @param field_type $name            
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     *
     * @param field_type $email            
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     *
     * @param field_type $password            
     */
    public function setPassword($clear_password)
    {
        $this->password = md5($clear_password);
    }
    function exchangeArray($data)
    {
        $this->id		= (isset($data['id'])) ? $data['id'] : null;
        $this->name		= (isset($data['name'])) ? $data['name'] : null;
        $this->email	= (isset($data['email'])) ? $data['email'] : null;
        $this->password	= (isset($data['password'])) ? $data['password'] : null;
    }
    
    public function getArrayCopy()
    {
        return get_object_vars($this);
    }
}