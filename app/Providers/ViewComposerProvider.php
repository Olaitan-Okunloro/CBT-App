<?php
// app/Providers/ViewComposerProvider.php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Auth;

class ViewComposerProvider extends ServiceProvider
{
    public function boot()
    {
        View::composer('*', function ($view) {
            if (Auth::check()) {
                $announcements = \App\Models\Announcement::where('status', 'active')
                    ->where(function ($q) {
                        $q->where('audience', 'all')
                          ->orWhere('audience', Auth::user()->role);
                    })
                    ->latest()
                    ->get();
                
                $view->with('globalAnnouncements', $announcements);
            }
        });
    }

    public function register()
    {
        
    }

}