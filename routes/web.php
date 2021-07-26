<?php

use App\Http\Controllers\BrandsModelsController;
use App\Http\Controllers\BuckarooController;
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

Route::get('/kktelefoons', [PhoneController::class, 'kk']);


Route::group(['middleware' => ['auth:sanctum', 'verified']], function (){
    Route::get('/dashboard', [UserController::class, 'dashboard']);
// Page routes
    //Users
    Route::get('/admin/users', [UserController::class, 'index']);
    Route::get('/admin/users/create', [UserController::class, 'createIndex']);
    Route::get('/admin/user/{user}/update', [UserController::class, 'updateIndex']);

    //Companies
    Route::get('/admin/companies', [CompanyController::class, 'index']);
    Route::get('/admin/company/create', [CompanyController::class, 'createIndex']);
    Route::get('/admin/company/{company}/update', [CompanyController::class, 'updateIndex']);


    //Phones
    Route::get('/admin/phones', [PhoneController::class, 'index']);
    Route::get('/admin/phone/{company}', [PhoneController::class, 'details']);
    Route::post('/admin/phones/create', [PhoneController::class, 'create']);
    Route::get('/admin/phone/{phone}/update', [PhoneController::class, 'update']);

    //Parts
    Route::get('/admin/parts', [PartController::class, 'index']);
    Route::get('/admin/part/{part}', [PartController::class, 'details']);
    Route::post('/admin/parts/create', [PartController::class, 'create']);
    Route::put('/admin/part/{part}/update', [PartController::class, 'update']);

    //Repairs
    Route::get('/admin/repairs', [RepairController::class, 'repairIndexAdmin']);
    Route::get('/admin/repair/{repair}', [RepairController::class, 'details']);
    Route::post('/admin/repairs/create', [RepairController::class, 'create']);
    Route::put('/admin/repair/{repair}/update', [RepairController::class, 'update']);
    Route::get('/user/repair/complete', [RepairController::class, 'completeIndex']);

    //Facturen
    Route::get('/admin/facturen', [InvoiceController::class, 'index']);
    Route::get('/admin/factuur/{invoice}', [InvoiceController::class, 'details']);
    Route::get('/admin/facturen/create', [InvoiceController::class, 'create']);
    Route::get('/admin/factuur/{invoice}/update', [InvoiceController::class, 'update']);

    Route::get('/user/reparaties', [RepairController::class, 'repairIndex']);
    Route::get('/user/repair/create', [RepairController::class, 'createIndex']);

//API routes

    Route::post('/api/users/create', [UserController::class, 'create']);
    Route::post('/api/user/{user}/update', [UserController::class, 'update']);

    Route::get('/api/brands/{brand}/models', [BrandsModelsController::class, 'getBrandModels']);
    Route::post('/api/brand/models', [BrandsModelsController::class, 'getBrandsModelsByName']);

    Route::post('/api/repairs/{user}/create', [RepairController::class, 'createRepairs']);
    Route::post('/api/repair/{repair}/update', [RepairController::class, 'update']);
    Route::post('/api/user/{user}/repair-all', [RepairController::class, 'repairAll']);


    Route::get('/api/companies', [CompanyController::class, 'getCompanies']);
    Route::put('/api/company/{company}/update', [CompanyController::class, 'update']);
    Route::post('/api/company/create', [CompanyController::class, 'create']);

    Route::post('/api/invoice/create', [InvoiceController::class, 'create']);
    Route::post('/api/invoice/uploadPdf', [InvoiceController::class, 'uploadPdf']);
    Route::put('/api/invoice/{invoice}/update', [InvoiceController::class, 'update']);
    Route::get('/api/invoice', [InvoiceController::class, 'getInvoices']);
    Route::get('/api/invoice/{invoice}/pdf', [InvoiceController::class, 'generatePdf']);
    Route::delete('/api/invoice/{invoice}/delete', [InvoiceController::class, 'delete']);



    Route::middleware([\App\Http\Middleware\Admin::class])->group(function () {

        Route::post('/api/buckaroo/create-subscription', [BuckarooController::class, 'createSubscription']);

        //Users
        Route::get('/admin/users', [UserController::class, 'index']);
        Route::get('/admin/users/create', [UserController::class, 'createIndex']);
        Route::get('/admin/user/{user}/update', [UserController::class, 'updateIndex']);

        //Companies
        Route::get('/admin/companies', [CompanyController::class, 'index']);
        Route::get('/admin/company/create', [CompanyController::class, 'createIndex']);
        Route::get('/admin/company/{company}/update', [CompanyController::class, 'updateIndex']);

        Route::get('/admin/devices', [DeviceController::class, 'deviceIndexAdmin']);
//        Route::get('/admin/device/{repair}', [DeviceController::class, 'details']);
        Route::get('/admin/device/create', [DeviceController::class, 'createIndex']);
        Route::post('/api/device/create', [DeviceController::class, 'create']);

        Route::put('/admin/device/{device}/update', [DeviceController::class, 'update']);

        //Facturen
        Route::get('/admin/facturen', [InvoiceController::class, 'index']);
        Route::get('/admin/factuur/{invoice}', [InvoiceController::class, 'details']);
        Route::get('/admin/factuur/{invoice}/pdf', [InvoiceController::class, 'details']);

        Route::get('/admin/facturen/create', [InvoiceController::class, 'createIndex']);
        Route::get('/admin/factuur/{invoice}/update', [InvoiceController::class, 'updateIndex']);

//phones
        Route::get('/admin/phones', [PhoneController::class, 'index']);
        Route::get('/admin/phone/{company}', [PhoneController::class, 'details']);
        Route::post('/admin/phones/create', [PhoneController::class, 'create']);
        Route::get('/admin/phone/{phone}/update', [PhoneController::class, 'update']);

        //Parts
        Route::get('/admin/parts', [PartController::class, 'index']);
        Route::get('/admin/part/{part}', [PartController::class, 'details']);
        Route::post('/admin/parts/create', [PartController::class, 'create']);
        Route::put('/admin/part/{part}/update', [PartController::class, 'update']);

        //Repairs
        Route::get('/admin/repairs', [RepairController::class, 'repairIndexAdmin']);
        Route::get('/admin/repair/{user}', [RepairController::class, 'details']);
        Route::get('/admin/repairs/create', [RepairController::class, 'createIndexAdmin']);
        Route::post('/api/repairs/create', [RepairController::class, 'create']);
        Route::put('/admin/repair/{repair}/update', [RepairController::class, 'update']);
    });
});
