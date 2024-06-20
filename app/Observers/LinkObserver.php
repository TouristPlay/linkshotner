<?php

namespace App\Observers;

use App\Models\Link;
use Illuminate\Support\Facades\Cache;

class LinkObserver
{

    const CACHE_KEY = 'links';

    /**
     * Handle the Link "created" event.
     *
     * @param  \App\Models\Link  $link
     * @return void
     */
    public function created(Link $link)
    {
        Cache::put(self::CACHE_KEY . "-{$link->slug}", $link, now()->addDay());
    }

    /**
     * Handle the Link "updated" event.
     *
     * @param  \App\Models\Link  $link
     * @return void
     */
    public function updated(Link $link)
    {
        Cache::forget(self::CACHE_KEY . "-{$link->slug}");
        Cache::put(self::CACHE_KEY . "-{$link->slug}", $link, now()->addDay());
    }

    /**
     * Handle the Link "deleted" event.
     *
     * @param  \App\Models\Link  $link
     * @return void
     */
    public function deleted(Link $link)
    {
        Cache::forget(self::CACHE_KEY . "-{$link->slug}");
    }
}
