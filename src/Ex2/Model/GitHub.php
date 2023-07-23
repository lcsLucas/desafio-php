<?php

namespace Ex2\Model;

class GitHub extends Request
{
    private $username;
    private $avatar;
    private $url;

    public function getUsername()
    {
        return $this->username;
    }
    public function getAvatar()
    {
        return $this->avatar;
    }
    public function getUrl()
    {
        return $this->url;
    }

    public function __construct($username)
    {
        parent::__construct();

        $this->username = $username;
    }

    public function getRepositories()
    {
        $url = "https://api.github.com/users/" . $this->username . "/repos";

        $response = $this->request($url);

        if (!empty($response['data'])) {
            $repositories = [];

            foreach ($response['data'] as $key => $value) {

                if ($key === 0) {
                    $this->avatar = $value['owner']['avatar_url'];
                    $this->url = $value['owner']['html_url'];
                }

                $repositories[] = [
                    'name' => $value['name'],
                    'html_url' => $value['html_url'],
                    'url' => $value['url'],
                    'created_at' => $value['created_at'],
                    'updated_at' => $value['updated_at'],
                    'stargazers_count' => $value['stargazers_count'],
                    'watchers_count' => $value['watchers_count'],
                    'language' => $value['language'],
                    'has_issues' => $value['has_issues'],
                    'forks' => $value['forks'],
                    'forks_count' => $value['forks_count'],
                    'archived' => $value['archived'],
                    'visibility' => $value['visibility'],
                    'default_branch' => $value['default_branch'],
                ];

            }

            return $repositories;
        }

        return $response['error'];

    }

}