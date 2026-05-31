<?php
// picksto/modules/Website/Routes/web.php
declare(strict_types=1);

use Illuminate\Support\Facades\Route;
use Modules\Website\Http\Controllers\LandingController;
use Modules\Website\Http\Controllers\PackageController;
use Modules\Website\Http\Controllers\PageController;
use Modules\Website\Http\Controllers\SupportController;

Route::get('/', LandingController::class)->name('home');
Route::get('/packages', [PackageController::class, 'index'])->name('packages.index');
Route::get('/packages/{package}', [PackageController::class, 'show'])->name('packages.show');

Route::get('/about', [PageController::class, 'show'])->defaults('page', 'about')->name('about');
Route::get('/services', [PageController::class, 'show'])->defaults('page', 'services')->name('services');

Route::get('/support', [SupportController::class, 'show'])->name('support.show');
Route::post('/support', [SupportController::class, 'submit'])->name('support.submit');
Route::get('/page/{page}', [PageController::class, 'show'])->name('page.show');
