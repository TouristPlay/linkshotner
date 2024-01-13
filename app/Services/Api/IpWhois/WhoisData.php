<?php

namespace App\Services\Api\IpWhois;

class WhoisData
{

    private $ipAddressInfo;

    public function __construct($ipAddressInfo)
    {
        $this->ipAddressInfo = $ipAddressInfo;
    }

    public function getContinent() {
        return $this->ipAddressInfo['continent'] ?? null;
    }

    public function getContinentCode() {
        return $this->ipAddressInfo['continent_code'] ?? null;
    }

    public function getCountry() {
        return $this->ipAddressInfo['country'] ?? null;
    }

    public function getCountryCode() {
        return $this->ipAddressInfo['country_code'] ?? null;
    }

    public function getRegion() {
        return $this->ipAddressInfo['region'] ?? null;
    }

    public function getCity() {
        return $this->ipAddressInfo['city'] ?? null;
    }

    public function getPostal() {
        return $this->ipAddressInfo['postal'] ?? null;
    }

    public function getTimezone() {
        return $this->ipAddressInfo['timezone']['id'] ?? null;
    }

    public function getLatitude() {
        return $this->ipAddressInfo['latitude'] ?? null;
    }

    public function getLongitude() {
        return $this->ipAddressInfo['longitude'] ?? null;
    }

    public function getConnectionProvider() {
        return $this->ipAddressInfo['connection']['org'] ?? null;
    }
}
