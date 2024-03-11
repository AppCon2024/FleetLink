<?php

namespace App\Listeners;

use App\Events\GeolocationUpdated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class GeolocationUpdatedListener
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
    
    }

    /**
     * Handle the event.
     */
    public function handle(GeolocationUpdated $event): void
    {
        broadcast(new GeolocationUpdated($event->geolocation));
    }
}
