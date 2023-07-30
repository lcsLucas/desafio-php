<?php

namespace Ex1\Dao;

use Ex3\Model\Banco;

class AuthDao extends Banco
{

    protected function verifyUserDAO($email)
    {
        try {

            if ($this->conectar()) {
                $st = $this->getCon()->prepare(
                    "SELECT 
                        name,
                        password 
                    FROM 
                        `users` 
                    WHERE 
                        `email` = :email
                    LIMIT 1"
                );
                $st->bindValue(':email', $email, \PDO::PARAM_STR);

                $st->execute();

                return $st->fetch(\PDO::FETCH_ASSOC);
            }

        } catch (\Throwable $e) {
            $this->setLog("DATABASE | " . $e->getMessage(), false, false);
        }

        return false;
    }

    protected function signupDAO($model)
    {

        try {
            if ($this->conectar()) {
                $st = $this->getCon()->prepare(
                    "INSERT INTO 
                        `users` 
                            (`name`, `email`, `password`) 
                    VALUES 
                            (:name, :email, :password)"
                );

                $st->bindValue(':name', $model->getName(), \PDO::PARAM_STR);
                $st->bindValue(':email', $model->getEmail(), \PDO::PARAM_STR);
                $st->bindValue(':password', $model->getPassword(), \PDO::PARAM_STR);

                return $st->execute();
            }
        } catch (\Exception $e) {
            $this->setLog("DATABASE | " . $e->getMessage(), false, false);
        }

    }

}