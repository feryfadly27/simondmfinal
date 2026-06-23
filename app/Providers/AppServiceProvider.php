<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;
use App\Models\User;
use App\Models\PengingatUser;
use App\Models\StokObat;

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
        View::composer('*', function ($view) {
            $view->with([
                'totalPasien' => User::where('role', '!=', 1)->count(),
                'totalPengingat' => PengingatUser::count(),
                'totalObat' => StokObat::count(),
                'totalVerifikasi' => User::where('role', 0)->count(),
                'authUser' => Auth::user(),
                'totalKontrol' => PengingatUser::where('user_id', Auth::id())->where('dibaca', 0)->count(),
            ]);
        });
    }
}
