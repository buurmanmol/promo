<?php

use App\Http\Controllers\BrandsModelsController;
use App\Http\Controllers\BuckarooController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\PartController;
use App\Http\Controllers\PhoneController;
use App\Http\Controllers\RepairController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DeviceController;
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

Route::get('/offerte', function () {
    return Inertia::render('Offerte');
});

Route::group(['middleware' => ['auth:sanctum', 'verified']], function (){
    Route::get('/dashboard', [UserController::class, 'dashboard']);
// User page routes


    //Phones

    //Devices
    Route::get('/user/apparaten', [DeviceController::class, 'deviceIndex']);

    //Repairs
    Route::get('/user/repair/complete', [RepairController::class, 'completeIndex']);
    Route::get('/user/reparaties', [RepairController::class, 'repairIndex']);
    Route::get('/user/repair/create', [RepairController::class, 'createIndex']);

    //Facturen
    Route::get('/user/facturen', [InvoiceController::class, 'userIndex']);


//API routes

    //UserController
    Route::post('/api/users/create', [UserController::class, 'create']);
    Route::post('/api/user/{user}/update', [UserController::class, 'update']);
    Route::delete('/api/user/{user}/delete', [UserController::class, 'delete']);
    Route::post('/api/users', [UserController::class, 'getUsers']);

    //BrandsModelsController
    Route::get('/api/brands/{brand}/models', [BrandsModelsController::class, 'getBrandModels']);
    Route::post('/api/brand/models', [BrandsModelsController::class, 'getBrandsModelsByName']);

    //RepairController
    Route::post('/api/repairs/create', [RepairController::class, 'create']);
    Route::post('/api/repairs/{user}/create', [RepairController::class, 'createRepairs']);
    Route::post('/api/repair/{repair}/update', [RepairController::class, 'update']);
    Route::post('/api/user/{user}/repair-all', [RepairController::class, 'repairAll']);

    //DeviceController
    Route::get('/api/user/{user}/devices/unique', [DeviceController::class, 'getUniqueDevices']);
    Route::post('/api/device/create', [DeviceController::class, 'create']);
    Route::delete('/api/device/{device}/delete', [DeviceController::class, 'delete']);
    Route::post('/api/devices', [DeviceController::class, 'getDevices']);

    //CompanyController
    Route::get('/api/companies', [CompanyController::class, 'getCompanies']);
    Route::post('/api/companies/paginated', [CompanyController::class, 'getPaginatedCompanies']);
    Route::put('/api/company/{company}/update', [CompanyController::class, 'update']);
    Route::delete('/api/company/{company}/delete', [CompanyController::class, 'delete']);
    Route::post('/api/company/create', [CompanyController::class, 'create']);

    //InvoiceController
    Route::post('/api/invoice/create', [InvoiceController::class, 'create']);
    Route::post('/api/invoice/uploadPdf', [InvoiceController::class, 'uploadPdf']);
    Route::put('/api/invoice/{invoice}/update', [InvoiceController::class, 'update']);
    Route::get('/api/invoice', [InvoiceController::class, 'getInvoices']);
    Route::get('/api/invoice/{invoice}/pdf', [InvoiceController::class, 'generatePdf']);
    Route::delete('/api/invoice/{invoice}/delete', [InvoiceController::class, 'delete']);
    Route::post('/api/invoice', [InvoiceController::class, 'getInvoices']);
    Route::put('/api/invoice/{company}/wallet', [InvoiceController::class, 'updateWallet']);

    //PartController
    Route::post('/api/part/create', [PartController::class, 'create']);
    Route::delete('/api/part/{part}/delete', [PartController::class, 'delete']);
    Route::post('/api/parts', [PartController::class, 'getParts']);

    //PhonesController
    Route::get('/admin/api/phones', [PhoneController::class, 'getPhones']);
    Route::put('/admin/api/phone/{phone}/update', [PhoneController::class, 'update']);
    Route::post('/admin/api/phone/create', [PhoneController::class, 'create']);
    Route::delete('/admin/api/phone/{brandsModel}/delete', [PhoneController::class, 'delete']);
    Route::post('/admin/api/phones/search', [PhoneController::class, 'searchModel']);

    Route::middleware([\App\Http\Middleware\Manager::class])->group(function () {


        Route::get('/manager/facturen', [InvoiceController::class, 'managerIndex']);

        Route::get('/manager/repairs', [RepairController::class, 'indexManager']);
        Route::get('/manager/user/{user}', [RepairController::class, 'detailsManager']);
        Route::get('/manager/{user}/repairs', [UserController::class, 'indexCompanyManager']);
    });

    Route::middleware([\App\Http\Middleware\Company::class])->group(function () {
        Route::get('/company/facturen', [InvoiceController::class, 'companyIndex']);

        Route::get('/company/repairs', [RepairController::class, 'indexCompany']);
        Route::get('/company/user/{user}', [RepairController::class, 'detailsCompany']);
    });

//Admin page routes

    Route::middleware([\App\Http\Middleware\Admin::class])->group(function () {

        Route::post('/api/buckaroo/create-subscription', [BuckarooController::class, 'createSubscription']);
        Route::get('/api/company/{company}/managers', [UserController::class, 'getManagers']);
        Route::post('/api/companies/search', [CompanyController::class, 'searchCompany']);
        Route::get('/api/company/{company}/company-user', [CompanyController::class, 'getCompanyUser']);



        //Users
        Route::get('/admin/users', [UserController::class, 'index']);
        Route::get('/admin/users/create', [UserController::class, 'createIndex']);
        Route::get('/admin/user/{user}/update', [UserController::class, 'updateIndex']);
        Route::post('/api/users/search', [UserController::class, 'searchUser']);

        //Companies
        Route::get('/admin/companies', [CompanyController::class, 'index']);
        Route::get('/api/companies/json', [CompanyController::class, 'getCompaniesJson']);
        Route::get('/admin/company/create', [CompanyController::class, 'createIndex']);
        Route::get('/admin/company/{company}/update', [CompanyController::class, 'updateIndex']);

        //Devices
        Route::get('/admin/devices', [DeviceController::class, 'deviceIndexAdmin']);
    //    Route::get('/admin/device/{repair}', [DeviceController::class, 'details']);
        Route::get('/admin/device/create', [DeviceController::class, 'createIndex']);
        Route::put('/admin/device/{device}/update', [DeviceController::class, 'update']);

        //Facturen
        Route::get('/admin/facturen', [InvoiceController::class, 'index']);
        Route::get('/admin/factuur/{invoice}', [InvoiceController::class, 'details']);
        Route::get('/admin/facturen/create', [InvoiceController::class, 'createIndex']);
        Route::get('/admin/factuur/{invoice}/pdf', [InvoiceController::class, 'details']);
        Route::get('/admin/factuur/{invoice}/update', [InvoiceController::class, 'updateIndex']);

        //phones
        Route::get('/admin/phones', [PhoneController::class, 'index']);
        Route::get('/admin/phone/{company}', [PhoneController::class, 'details']);
        Route::get('/admin/phones/create', [PhoneController::class, 'createIndex']);
        Route::get('/admin/phone/{phone}/update', [PhoneController::class, 'updateIndex']);

        //Parts
        Route::get('/admin/parts', [PartController::class, 'index']);
        Route::get('/admin/part/create', [PartController::class, 'createIndex']);
        Route::get('/admin/part/{part}/update', [PartController::class, 'updateIndex']);

        //Repairs
        Route::post('/api/repairs/{repair}/repair-all', [RepairController::class, 'repairItem']);
        Route::post('/api/repairs/search', [RepairController::class, 'searchRepairIndexAdmin']);
        Route::get('/admin/repairs', [RepairController::class, 'repairIndexAdmin']);
        Route::get('/admin/repair/{user}', [RepairController::class, 'details']);
        Route::get('/admin/repairs/create', [RepairController::class, 'createIndexAdmin']);
        Route::put('/admin/repair/{repair}/update', [RepairController::class, 'update']);
        Route::post('/api/repair/{repair}/is-repaired', [RepairController::class, 'updateIsRepaired']);
    });
});
