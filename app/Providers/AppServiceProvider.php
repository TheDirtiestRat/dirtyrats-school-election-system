<?php

namespace App\Providers;

use App\Models\Position;
use App\Models\RegisteredVoter;
use App\Models\SystemConfig;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        view()->composer('*',function($view) {
            // $view->with('user', Auth::user());
            // $view->with('social', Social::all());
            $view->with('positions_list', Position::all());

            // for the system settings
            $view->with('can_register', SystemConfig::query()->where('key', 'can_register')->first());
            $view->with('can_vote', SystemConfig::query()->where('key', 'can_vote')->first());

            // for the voter
            // $view->with('voter_user', RegisteredVoter::query()->where('user_id', Auth::user()->id)->first());
        });
    }
}
