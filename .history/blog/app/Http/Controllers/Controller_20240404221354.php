<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
abstract class Controller
{
    //
}

class AppServiceProvider extends ServiceProvider
{
    public function boot()
    {
        Carbon::setLocale('zh');
    }
}
