<?php

namespace App\Services;

use Illuminate\Support\Str as Str;
use App\Services\Api\IpWhois\WhoisData;
use App\Services\Api\IpWhois\WhoisService;
use hisorange\BrowserDetect\Parser as Parser;
use Carbon\Carbon;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Http\Request;


class StatisticService
{

    private $whoisService;
    private $clickhouseService;

    public function __construct()
    {
        $this->whoisService = new WhoisService();
        $this->clickhouseService = new ClickhouseService();
    }

    /**
     * @param Request $request
     * @param $link
     * @return void
     * @throws GuzzleException
     */
    public function handle(Request $request, $link) {

        $requestData = $this->getRequestData($request);
        $whoisData = $this->whoisService->getWhoisInfo($requestData['ip']);
        $this->save($requestData, $whoisData, $link);

    }

    private function save($requestData, WhoisData $whoisData, $link) {
        
        $model = \App\Models\Clickhouse\TransitionStatistic::create([
            'id' => Str::uuid(),
            'url_id' => $link->id,
            'continent' => $whoisData->getContinent(),
            'continent_code' => $whoisData->getContinentCode(),
            'country' => $whoisData->getCountry(),
            'country_code' => $whoisData->getCountryCode(),
            'region' => $whoisData->getRegion(),
            'city' => $whoisData->getCity(),
            'postal' => $whoisData->getPostal(),
            'timezone' => $whoisData->getTimezone(),
            'connection_provider' => $whoisData->getConnectionProvider(),
            'latitude' => $whoisData->getLatitude(),
            'longitude' => $whoisData->getLongitude(),
            'ip' => $requestData['ip'],
            'browser' => $requestData['browser'],
            'os' => $requestData['os'],
            'device' => $requestData['device'],
            'deviceModel' => $requestData['deviceModel'],
            'request_time' => $requestData['requestTime'],
            'created_at' => Carbon::now()->getTimestamp(),
        ]);

    }

    /**
     * @param Request $request
     * @return array
     */
    private function getRequestData(Request $request): array
    {

        $data = (new Parser())->detect();

        return [
            'browser' => $data->browserFamily(),
            'os' => $data->platformFamily(),
            'device' => $data->deviceFamily() == "Unknown" ? null : $data->deviceFamily(),
            'deviceModel' => $data->deviceModel(),
            'requestTime' => $request->server()['REQUEST_TIME'] ?? Carbon::now()->getTimestamp(),
            'ip' => $request->server()['HTTP_X_REAL_IP'] ?? null,
        ];
    }


    public function getTransitionStatistic($url): array
    {
        $data = $this->clickhouseService->getTransitionCount($url);

        $statistic = [];

        foreach ($data as $item) {
            $statistic[] = [
                'date' => $item['request_time'],
                'count' => $item['count()']
            ];
        }

        return $statistic;
    }


    public function getBrowserStatistic($url): array
    {
        $data = $this->clickhouseService->getBrowserCount($url);

        $statistic = [];

        foreach ($data as $item) {
            $statistic[] = [
                'name' => $item['browser'],
                'count' => $item['count()']
            ];
        }

        return $statistic;
    }


    public function getOperationSystemStatistic($url): array
    {
        $data = $this->clickhouseService->getOperationSystemCount($url);

        $statistic = [];

        foreach ($data as $item) {
            $statistic[] = [
                'name' => $item['os'],
                'count' => $item['count()']
            ];
        }

        return $statistic;
    }


    public function getCountryStatistic($url): array
    {
        $data = $this->clickhouseService->getCountryCount($url);

        $statistic = [];

        foreach ($data as $item) {
            $statistic[] = [
                'code' => $item['country_code'],
                'count' => $item['count()']
            ];
        }

        return $statistic;
    }
}
