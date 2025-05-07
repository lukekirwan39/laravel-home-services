<?php

use App\Http\Livewire\Customer\CustomerDashboardComponent;
use App\Http\Livewire\HomeComponent;
use App\Http\Livewire\ServiceCategoriesComponent;
use App\Http\Livewire\ServicesByCategoryComponent;
use App\Http\Livewire\Sprovider\SproviderDashboardComponent;
use App\Livewire\Admin\AdminAddServiceCategoryComponent;
use App\Livewire\Admin\AdminAddServiceComponent;
use App\Livewire\Admin\AdminDashboardComponent;
use App\Livewire\Admin\AdminEditServiceCategoryComponent;
use App\Livewire\Admin\AdminServiceCategoryComponent;
use App\Livewire\Admin\AdminServicesByCategoryComponent;
use App\Livewire\Admin\AdminServicesComponent;
use App\Livewire\ServicesDetailsComponent;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;

// Home page
Route::get('/', HomeComponent::class)->name('home');
Route::get('service-categories', ServiceCategoriesComponent::class)->name('home.service-categories');
Route::get('/{category_slug}/services', ServicesByCategoryComponent::class)->name('home.services_by_category');
Route::get('/service/{service_slug}',ServicesDetailsComponent::class)->name('home.service_details');

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
    Route::get('/admin/service-categories', AdminServiceCategoryComponent::class)->name('admin.service_categories');
    Route::get('/admin/service-category/add', AdminAddServiceCategoryComponent::class)->name('admin.add_service_category');
    Route::get('/admin/service-category/edit/{category_id}',AdminEditServiceCategoryComponent::class)->name('admin.edit_service_category');
    Route::get('/admin/{category_slug}/services', AdminServicesByCategoryComponent::class)->name('admin.services_by_category');
    Route::get('/admin/all-service',AdminServicesComponent::class)->name('admin.all_services');
    Route::get('/admin/service/add',AdminAddServiceComponent::class)->name('admin.add_service');
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

