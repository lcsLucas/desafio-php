<?php

namespace Ex1\Controller;

use Ex1\Model\Auth;

class AuthController
{
    private $tab;
    private $auth;
    private $error;

    public function __construct()
    {
        $this->tab = 0;
        $this->auth = new Auth();
    }

    public function getModel()
    {
        return $this->auth;
    }
    public function getError()
    {
        return $this->error;
    }
    public function getTab()
    {
        return $this->tab;
    }

    public function index()
    {
        include_once __DIR__ . '/../Views/index.php';
    }

    public function welcome()
    {
        include_once __DIR__ . '/../Views/welcome.php';
    }

    public function login()
    {
        $this->auth->setEmail(filter_input(INPUT_POST, "email", FILTER_VALIDATE_EMAIL));
        $this->auth->setPassword(filter_input(INPUT_POST, "password", FILTER_SANITIZE_SPECIAL_CHARS));

        switch (true) {
            case empty($this->auth->getEmail()):
                $this->error = "O campo email precisa ser preenchido em um formato válido.";
                break;
            case empty($this->auth->getPassword()):
                $this->error = "O campo Senha precisa ser preenchido.";
                break;
            default:
                if ($this->auth->login()) {
                    $_SESSION['logged'] = $this->auth->getName();
                    header("Refresh:0");
                    die;
                } else if (!empty($this->auth->getError())) {
                    $this->error = $this->auth->getError();
                } else {
                    $this->error = "Não foi possível fazer o login. Por favor, tente novamente.";
                }
        }

    }

    public function signup()
    {
        $this->auth->setName(filter_input(INPUT_POST, "name", FILTER_SANITIZE_STRING));
        $this->auth->setEmail(filter_input(INPUT_POST, "email", FILTER_VALIDATE_EMAIL));
        $this->auth->setPassword(filter_input(INPUT_POST, "password", FILTER_SANITIZE_SPECIAL_CHARS));

        $this->tab = 1;

        switch (true) {
            case empty($this->auth->getName()):
                $this->error = "O campo nome precisa ser preenchido.";
                break;
            case strlen($this->auth->getName()) < 3:
                $this->error = "O campo nome precisa ter no mínimo 3 letras.";
                break;
            case empty($this->auth->getEmail()):
                $this->error = "O campo email precisa ser preenchido em um formato válido.";

                break;
            case empty($this->auth->getPassword()):
                $this->error = "O campo Senha precisa ser preenchido.";
                break;
            case strlen($this->auth->getPassword()) < 7:
                $this->error = "O campo senha precisa ter no mínimo 7 caractere.";
                break;
            default:
                if ($this->auth->signup()) {
                    $_SESSION['logged'] = $this->auth->getName();
                    header("Refresh:0");
                    die;
                } else if (!empty($this->auth->getError())) {
                    $this->error = $this->auth->getError();
                } else {
                    $this->error = "Não foi possível fazer o cadastro. Por favor, tente novamente.";
                }
        }

    }

}