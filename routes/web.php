<?php

use App\Http\Livewire\Admin\AdminDashboardComponent;
use App\Http\Livewire\Customer\CustomerDashboardComponent;
use App\Http\Livewire\HomeComponent;
use App\Http\Livewire\ServiceCategoriesComponent;
use App\Http\Livewire\Sprovider\SproviderDashboardComponent;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;

// Home page
Route::get('/', HomeComponent::class)->name('home');
Route::get('service-categories', ServiceCategoriesComponent::class)->name('home.service-categories');

// Customer dashboard
Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::get('/customer/dashboard', CustomerDashboardComponent::class)->name('customer.dashboard');
});

// Service provider dashboard
Route::middleware(['auth:sanctum', 'verified', 'authsprovider'])->group(function () {
    Route::get('/sprovider/dashboard', SproviderDashboardComponent::class)->name('sprovider.dashboard');
});

// Admin dashboard
Route::middleware(['auth:sanctum', 'verified', 'authadmin'])->group(function () {
    Route::get('/admin/dashboard', AdminDashboardComponent::class)->name('admin.dashboard');
});

// Redirect /dashboard based on user type
Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        $user = Auth::user();

        return match ($user->utype) {
            'ADM' => Redirect::route('admin.dashboard'),
            'SVP' => Redirect::route('sprovider.dashboard'),
            default => Redirect::route('customer.dashboard'),
        };
    })->name('dashboard');
});

