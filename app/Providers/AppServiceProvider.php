<?php

namespace App\Providers;

// use App\Models\User\Role;
use App\Models\Notification;
use App\Models\Content\Comment;
use App\Models\Market\CartItem;
// use App\Models\User\Permission;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;

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
    public function boot()
    {
        Auth::loginUsingId(15);

        // dd(auth()->user()->roles[1]->permissions);
        // dd(auth()->user()->permissions);
        // $role = Role::find(2);
        // $permission = Permission::find(1);
        // dd($role->permissions);
        // dd($role->users);
        // dd($permission->roles);
        // dd($permission->users);

        view()->composer('admin.layouts.header', function ($view) {
            $view->with('unseenComments', Comment::where('seen', 0)->get());
            $view->with('notifications', Notification::where('read_at', null)->get());
        });


        view()->composer('customer.layouts.header', function ($view) {
            if (Auth::check()) {
                $cartItems = CartItem::where('user_id', Auth::user()->id)->get();
                $view->with('cartItems', $cartItems);
            }
        });
    }
}
