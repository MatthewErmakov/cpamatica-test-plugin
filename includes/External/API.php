<?php

namespace Cpamatica\Includes\External;

class API
{
    private $api_url;
    private $x_api_key;

    public function __construct( $api_url, $x_api_key )
    {
        $this->api_url   = $api_url;
        $this->x_api_key = $x_api_key;
    }

    public function get_result() : array
    {
        $ch = curl_init();
        $headers = [
            'X-API-Key: ' . $this->x_api_key,
        ];

        curl_setopt($ch, CURLOPT_URL, $this->api_url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $server_output = curl_exec($ch);

        curl_close($ch);

        return json_decode($server_output);
    }
}
