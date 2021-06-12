<?php

use App\Http\Controllers\CompanyController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\PartController;
use App\Http\Controllers\PhoneController;
use App\Http\Controllers\RepairController;
use App\Http\Controllers\UserController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::group(['middleware' => ['auth:sanctum', 'verified']], function (){
    Route::get('/dashboard', [UserController::class, 'dashboard']);




    Route::get('/admin/users', [UserController::class, 'index']);
    Route::get('/admin/users/create', [UserController::class, 'create']);
    Route::get('/admin/user/{user}/update', [UserController::class, 'update']);
    Route::get('/admin/companies', [CompanyController::class, 'index']);
    Route::get('/admin/company/{company}', [CompanyController::class, 'details']);
    Route::get('/admin/companies/create', [CompanyController::class, 'create']);
    Route::get('/admin/company/{company}/update', [CompanyController::class, 'update']);
    Route::get('/admin/phones', [PhoneController::class, 'index']);
    Route::get('/admin/phone/{company}', [PhoneController::class, 'details']);
    Route::get('/admin/phones/create', [PhoneController::class, 'create']);
    Route::get('/admin/phone/{phone}/update', [PhoneController::class, 'update']);
    Route::get('/admin/parts', [PartController::class, 'index']);
    Route::get('/admin/part/{part}', [PartController::class, 'details']);
    Route::get('/admin/parts/create', [PartController::class, 'create']);
    Route::get('/admin/part/{part}/update', [PartController::class, 'update']);
    Route::get('/admin/repairs', [RepairController::class, 'index']);
    Route::get('/admin/repair/{repair}', [RepairController::class, 'details']);
    Route::get('/admin/repairs/create', [RepairController::class, 'create']);
    Route::get('/admin/repair/{repair}/update', [RepairController::class, 'update']);
    Route::get('/admin/facturen', [InvoiceController::class, 'index']);
    Route::get('/admin/factuur/{invoice}', [InvoiceController::class, 'details']);
    Route::get('/admin/facturen/create', [InvoiceController::class, 'create']);
    Route::get('/admin/factuur/{invoice}/update', [InvoiceController::class, 'update']);

});
