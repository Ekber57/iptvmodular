<?php 
namespace Modules\Iptv\App\Providers;

use Illuminate\Support\ServiceProvider;
use Modules\Iptv\Events\LineCreatedEvent;
use Modules\Iptv\Listeners\LineCreatedListener;

class EventServiceProvider extends ServiceProvider {
    protected $listen = [
        LineCreatedEvent::class =>  [
            LineCreatedListener::class
        ]
    ];
    public function boot() {
      
    }
}



?>