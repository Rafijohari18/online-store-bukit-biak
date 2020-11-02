<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Http;
use Illuminate\Support\Facades\View;
use Carbon\Carbon;
use App\Models\Cart;
use Auth;
use Illuminate\Http\Request;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(Request $request)
    {
        View::share([
            'count_keranjang'   => Cart::where('user_id',Auth::user()['id'])
                                ->whereIn('status',[0,1])->count(),
        ]);
    }
}
