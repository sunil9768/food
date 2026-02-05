<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class BladeServiceProvider extends ServiceProvider
{
    public function boot()
    {
        Blade::directive('storageAsset', function ($expression) {
            return "<?php echo config('app.env') === 'production' ? asset('public/storage/' . $expression) : asset('storage/' . $expression); ?>";
        });
    }
}