<?php

namespace App\Services\Api\IpWhois;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Support\Facades\Log;

class WhoisService
{

    private function getUrl() {
        return config("api.ipWhoisUrl");
    }


    /**
     * @throws GuzzleException
     */
    private function send($url, $data = [], $method = "GET") {

        $client = new Client();

        $options = array_merge([
            'lang' => 'ru',
            'rate' => 1
        ], $data);

        try {
            $response = $client->request($method, $this->getUrl() . $url, ['query' => $options]);
            return new WhoisData(json_decode($response->getBody(), true));
        } catch (RequestException $exception) {
            Log::info('REQUEST IPWHOIS ERROR');
            Log::error(Psr7\Message::toString($exception->getRequest()));
            Log::error(Psr7\Message::toString($exception->getResponse()));
            return false;
        }

    }


    /**
     * @throws GuzzleException
     */
    public function getWhoisInfo($ipAddress) {
        return $this->send($ipAddress);
    }

}
