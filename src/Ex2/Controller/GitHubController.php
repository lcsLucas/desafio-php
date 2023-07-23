<?php

namespace Ex2\Controller;

use Ex2\Model\GitHub;

class GitHubController
{

    public function index()
    {

        if (filter_has_var(INPUT_GET, "username")) {

            $username = filter_input(INPUT_GET, "username", FILTER_SANITIZE_STRING);

            if (!empty($username)) {
                $model = new GitHub($username);

                $resultRepos = $model->getRepositories();

                if (gettype($resultRepos) === "string")
                    $error = $resultRepos;
                else
                    $data = [
                        'username' => $model->getUsername(),
                        'avatar' => $model->getAvatar(),
                        'url' => $model->getUrl(),
                        'repos' => $resultRepos
                    ];

            }

        }

        require_once __DIR__ . '/../Views/index.php';
    }

}