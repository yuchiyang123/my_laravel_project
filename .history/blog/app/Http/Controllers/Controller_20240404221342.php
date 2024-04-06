<?php
use Carbon\Carbon;
namespace App\Http\Controllers;

abstract class Controller
{
    //
}
use Carbon\Carbon;

class AppServiceProvider extends ServiceProvider
{
    public function boot()
    {
        Carbon::setLocale('zh');
    }
}
