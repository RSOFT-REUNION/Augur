<?php

namespace App\Providers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $settings = DB::table('general_settings')->where('id', 1)->first();
        View::share('settingGlobal', $settings);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $characters = ["é", "è", "ê", "ë", "à", "'", "\"", "«", "»", "<", ">", " ", "_", "&", "ç", "î", "ï", "ô", "ö", "/", "[", "(", ")", "]", "{", "}"];
        $correct_characters = ["e", "e", "e", "e", "a", "-", "-", "-", "-", "-", "-", "-", "-", "and", "c", "i", "i", "o", "o", "-", "-", "-", "-", "-", "-", "-"];

        View::share('characters', $characters);
        View::share('correct_characters', $correct_characters);
    }
}
