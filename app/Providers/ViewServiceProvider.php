<?php

namespace App\Providers;

use App\Models\AdminSettings;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
	/**
	 * Register any application services.
	 */
	public function register(): void
	{
	}

	/**
	 * Bootstrap any application services.
	 */
	public function boot()
	{
		try {
			\DB::connection()->getPdo();
		} catch (\Exception $e) {
			// Database not available - don't share settings
			// This will be handled by the exception handler
			return false;
		}

		try {
			view()->share('settings', AdminSettings::first());
		} catch (\Exception $e) {
			// Settings not available - continue without sharing
			return false;
		}
	}
}
