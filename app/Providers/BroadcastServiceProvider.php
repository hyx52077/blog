<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Broadcast;

class BroadcastServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Broadcast::routes(['middleware' => ['web']]);

        /*
         * Authenticate the user's personal channel...
         */
        Broadcast::auth('chat-room-presence.*', function ($user, $roomId) {
            if (true) { // Replace with real authorization
                return [
                    'id' => $user->id,
                    'name' => $user->name
                ];
            }
        });
    }
}
