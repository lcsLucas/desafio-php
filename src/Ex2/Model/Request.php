<?php

namespace Ex2\Model;

class Request
{
    private $instance_curl;
    private $params_curl;

    public function __construct()
    {
        $this->instance_curl = curl_init();
        $this->params_curl = [
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTPHEADER => [
                'User-Agent: GitHub API Client',
            ]
        ];
    }

    protected function request($url)
    {
        if (empty($url)) {
            return [
                "error" => "Not Found"
            ];
        }

        $result = array();

        $this->params_curl[CURLOPT_URL] = $url;

        curl_setopt_array($this->instance_curl, $this->params_curl);

        $response = curl_exec($this->instance_curl);

        if (curl_errno($this->instance_curl)) {
            $result = [
                "error" => curl_error($this->instance_curl)
            ];
        } else {
            $code = curl_getinfo($this->instance_curl, CURLINFO_HTTP_CODE);

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

        curl_close($this->instance_curl);

        return $result;

    }

}