<?php

namespace App\Services;

class ClickhouseService
{


    public function getTransitionCount($url): array
    {
        return \App\Models\Clickhouse\TransitionStatistic::where('url_id', $url)
            ->select('created_at', raw('count()'))
            ->orderBy('created_at', 'desc')
            ->groupBy('created_at')
            ->getRows();
    }

    public function getBrowserCount($url): array
    {
        return \App\Models\Clickhouse\TransitionStatistic::where('url_id', $url)
            ->select('browser', raw('count()'))
            ->groupBy('browser')
            ->getRows();
    }

    public function getOperationSystemCount($url): array
    {
        return \App\Models\Clickhouse\TransitionStatistic::where('url_id', $url)
            ->select('os', raw('count()'))
            ->groupBy('os')
            ->getRows();
    }


    public function getCountryCount($url): array
    {
        return \App\Models\Clickhouse\TransitionStatistic::where('url_id', $url)
            ->select('country_code', raw('count()'))
            ->groupBy('country_code')
            ->getRows();
    }

}


