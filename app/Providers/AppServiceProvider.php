<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;

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
        if (env('DB_CONNECTION') === 'sqlite') {
            $originalPath = database_path('database.sqlite');
            $tempPath = '/tmp/database.sqlite';

            // Ensure the temp path exists
            if (!File::exists($tempPath)) {
                File::copy($originalPath, $tempPath);
            }

            // Set the database connection to the temp file
            config(['database.connections.sqlite.database' => $tempPath]);

            // Ensure the file is writable
            chmod($tempPath, 0666);
        }
    }
}
