<?php

namespace App\Jobs;

use App\Services\StatisticService;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class StatisticJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $request;
    private $link;
    private $service;

    public function __construct($request, $link)
    {
        $this->link = $link;
        $this->request = $request;
        $this->service = new StatisticService();
    }

    /**
     * @throws GuzzleException
     */
    public function handle()
    {
        $this->service->handle($this->request, $this->link);
    }
}
