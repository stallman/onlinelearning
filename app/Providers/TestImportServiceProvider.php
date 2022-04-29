<?php

namespace App\Providers;

use App\Services\Admin\Imports\ExcelTestImportService;
use Illuminate\Support\ServiceProvider;

class TestImportServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('App\Services\Interfaces\Admin\Imports\TestImportServiceInterface', function (){
            return new ExcelTestImportService();
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
