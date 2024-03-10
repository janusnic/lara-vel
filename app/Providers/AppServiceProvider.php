<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Str;

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
        Blade::directive('datetime', function (string $expression) {
        	return "<?php echo ($expression)->format('m/d/Y H:i'); ?>";
    	});

        Str::macro('readDuration', function(...$text) {
            $totalWords = str_word_count(implode(" ", $text));
            $minutesToRead = round($totalWords / 200);

            return (int)max(1, $minutesToRead);
        });

        // Blade::anonymousComponentPath(__DIR__.'/../components');
        // Префікс "простір імен" може бути наданий як другий аргумент методу anonymousComponentPath:

        // Blade::anonymousComponentPath(__DIR__.'/../components', 'dashboard');

    }
}
