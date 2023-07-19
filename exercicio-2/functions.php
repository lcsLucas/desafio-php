<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

function makeRequest($url)
{
    $result = array();

    $curl = curl_init();
    curl_setopt_array($curl, [
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_HTTPHEADER => [
            'User-Agent: GitHub API Client',
        ],
    ]);

    $response = curl_exec($curl);

    if (curl_errno($curl)) {
        $result = [
            "error" => curl_error($curl)
        ];
    } else {
        $code = curl_getinfo($curl, CURLINFO_HTTP_CODE);

        $response_data = json_decode($response, true);

        if ($code === 200) {
            $result = [
                "data" => $response_data
            ];
        } else if (!empty($response_data["message"])) { //erro retornado da api
            $result = [
                "error" => $response_data["message"]
            ];
        } else { // erro emitido pelo curl
            $result = [
                "error" => $response
            ];
        }
    }

    curl_close($curl);

    return $result;

}

function getRepositories($user)
{
    $url = "https://api.github.com/users/$user/repos";

    $response = makeRequest($url);

    if (!empty($response["data"])) {
        $result = [];

        foreach ($response["data"] as $value) {
            $result[] = [
                "owner" => [
                    "login" => $value["owner"]["login"],
                    "avatar_url" => $value["owner"]["avatar_url"],
                    "html_url" => $value["owner"]["html_url"],
                ],
                "full_name" => $value["full_name"],
                "url" => $value["url"],
                "language" => $value["language"],
                "stargazers_count" => $value["stargazers_count"]
            ];
        }

        return $result;
    }

    return $response;
}