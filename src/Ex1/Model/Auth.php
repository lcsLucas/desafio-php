<?php

namespace Ex1\Model;

use Ex1\Dao\AuthDao;

class Auth extends AuthDao
{
    private $name;
    private $email;
    private $password;
    private $error;

    public function __construct($name = "", $email = "", $password = "")
    {
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
    }

    public function getError()
    {
        return $this->error;
    }
    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function setPassword($password)
    {
        $this->password = $password;
    }

    public function login()
    {
        $logged = $this->verifyUserDAO($this->email);

        if (!empty($logged)) {
            $password = $logged['password'];

            if (password_verify($this->password, $password)) {
                $this->name = $logged['name'];

                return true;
            }
        }

        $this->error = "Email ou senha inválido(s).";

        return false;
    }

    public function signup()
    {
        if (!$this->verifyUserDAO($this->email)) {
            $this->password = password_hash($this->password, PASSWORD_DEFAULT);

            return $this->signupDAO($this);
        }

        $this->error = "Esse email que você informou já existe. Por favor, faça o login.";

        return false;
    }

}