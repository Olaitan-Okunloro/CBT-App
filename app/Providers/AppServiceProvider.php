<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;

use App\Models\Notification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

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
        Paginator::useBootstrap();

            View::composer('layouts.app', function ($view) {
            if (Auth::check()) {
                $unreadCount = Notification::where(function($q) {
                    $user = Auth::user();
                    if ($user->role == 'student') {
                        $q->where('recipient_type', 'students')
                        ->orWhere('recipient_type', 'all');
                    } elseif ($user->role == 'teacher') {
                        $q->where('recipient_type', 'teachers')
                        ->orWhere('recipient_type', 'all');
                    } elseif ($user->role == 'school') {
                        $q->where('recipient_type', 'schools')
                        ->orWhere('recipient_type', 'all');
                    }
                    $q->orWhere('recipient_id', $user->id);
                })
                ->where('is_read', false)
                ->count();
                
                $view->with('unreadCount', $unreadCount);
            }
        });
    }

}
