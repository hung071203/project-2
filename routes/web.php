<?php

use Illuminate\Support\Facades\Route;

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


Route::get('/login', [\App\Http\Controllers\EmployeeController::class, 'login'])->name('login');
Route::get('/logout', [\App\Http\Controllers\EmployeeController::class, 'logout'])->name('logout');
Route::post('/login', [\App\Http\Controllers\EmployeeController::class, 'checkLogin'])->name("checkLogin");
Route::get('/forgotPass', [\App\Http\Controllers\EmployeeController::class, 'forgotPass'])->name("forgotPass");
Route::put('/newPass', [\App\Http\controllers\EmployeeController::class, 'newPass'])->name('newPass');




Route::middleware('checkMiddleware')->prefix('/')->group(function(){
    Route::post('/home', [\App\Http\Controllers\Controller::class,'home'])->name("home");
    Route::get('/home', [\App\Http\Controllers\Controller::class,'home'])->name("home1");
    Route::get('/classmate',[\App\Http\Controllers\ClassmateController::class, 'index'])->name("class");
    Route::get('/profile', [\App\Http\controllers\Controller::class, 'showPF'])->name('profile');
    Route::put('/changePass', [\App\Http\controllers\Controller::class, 'savePass'])->name('changePass');
    Route::put('/editEmployee', [\App\Http\controllers\Controller::class, 'editEm'])->name('editEm');
    Route::match(['put', 'get'],'/search', [\App\Http\controllers\Controller::class, 'search'])->name('search');


});




Route::middleware('checkMiddleware')->prefix('/course')->group(function(){
    Route::get('/', [\App\Http\Controllers\CourseController::class, 'index']) ->name("course");
    Route::delete('/{course}', [\App\Http\Controllers\CourseController::class, 'destroy'])->name("destroy.cr");
});
Route::middleware('checkMiddleware')->prefix('/majors')->group(function(){
    Route::get('/', [\App\Http\Controllers\MajorController::class, 'index']) ->name("mj");

});

Route::middleware('checkMiddleware')->prefix('/classmate')->group(function() {
    Route::get('/',[\App\Http\Controllers\ClassmateController::class, 'index'])->name("class");


});



Route::middleware('adminMiddleware')->prefix('/scholarship')->group(function(){
    Route::get('/', [\App\Http\Controllers\ScholarshipController::class,'index'])->name("scholarship");
    Route::get('/addNewSC', [\App\Http\Controllers\ScholarshipController::class,'create'])->name("addSC");
    Route::post('/storeNewSC', [\App\Http\Controllers\ScholarshipController::class,'store'])->name("addSC.store");
    Route::get('/{scholarship}/editSC', [\App\Http\Controllers\ScholarshipController::class, 'edit'])->name("editSC");
    Route::put('/{scholarship}/editSC',[\App\Http\Controllers\ScholarshipController::class,'update'])->name("editSC.update");
    Route::delete('/{scholarship}',[\App\Http\Controllers\ScholarshipController::class,'destroy'])->name("destroySC");
});

Route::middleware('checkMiddleware')->prefix('/students')->group(function(){
    Route::get('/',[\App\Http\Controllers\StudentController::class, 'index'])->name("students");
    Route::get('/{student}/editST', [\App\Http\Controllers\StudentController::class, 'edit'])->name("editST");
    Route::put('/{student}/editST',[\App\Http\Controllers\StudentController::class,'update'])->name("editST.update");
});
Route::middleware('adminMiddleware')->prefix('/')->group(function() {
    Route::get('/addNewST', [\App\Http\Controllers\StudentController::class,'create'])->name("addStudent");
    Route::put('/storeNewSt',[\App\Http\Controllers\StudentController::class,'store'])->name("addST.store");

//Class
    Route::get('/addClass',[\App\Http\Controllers\ClassmateController::class, 'create'])->name("addclass");
    Route::put('/storeclass', [\App\Http\Controllers\ClassmateController::class, 'store'])->name("addclass.store");
    Route::get('/{class}/editClass',[\App\Http\Controllers\ClassmateController::class, 'edit'])->name("editclass");
    Route::put('/{class}/editclass', [\App\Http\Controllers\ClassmateController::class, 'update'])->name("editclass.update");

//mj

    Route::get('/addmj', [\App\Http\Controllers\MajorController::class, 'create'])->name("addmj");
    Route::put('/storemj', [\App\Http\Controllers\MajorController::class, 'store'])->name("addmj.store");
    Route::get('/{major}/editmj', [\App\Http\Controllers\MajorController::class, 'edit'])->name("editmj");
    Route::put('/{major}/editmj', [\App\Http\Controllers\MajorController::class, 'update'])->name("editmj.update");
    Route::delete('/{major}', [\App\Http\Controllers\MajorController::class, 'destroy'])->name("destroymj");

//cr

    Route::get('/addcr', [\App\Http\Controllers\CourseController::class, 'create'])->name("addcr");
    Route::put('/storecr', [\App\Http\Controllers\CourseController::class, 'store'])->name("addcr.store");
    Route::get('/{course}/editcr', [\App\Http\Controllers\CourseController::class, 'edit'])->name("editcr");
    Route::put('/{course}/editcr', [\App\Http\Controllers\CourseController::class, 'update'])->name("editcr.update");


//
});

Route::middleware('checkMiddleware')->prefix('/invoices')->group(function(){
    Route::get('/', [\App\Http\controllers\InvoiceController::class, 'index'])->name('invoice');
    Route::get('/{student}/addNewIV', [\App\Http\Controllers\InvoiceController::class, 'create'])->name("addNewIV");
    Route::put('/storeNewIV', [\App\Http\Controllers\InvoiceController::class,'store'])->name("storeNewIV");
    Route::get('/{invoice}/editIV', [\App\Http\Controllers\InvoiceController::class, 'edit'])->name("editIV");
    Route::put('/{invoice}/editIV',[\App\Http\Controllers\InvoiceController::class,'update'])->name("editIV.update");
});


    Route::middleware('adminMiddleware')->prefix('/employees')->group(function() {
        Route::get('/', [\App\Http\Controllers\EmployeeController::class, 'index']) ->name("employee");
        Route::get('/addep', [\App\Http\Controllers\EmployeeController::class, 'create']) ->name("addep");
        Route::put('/storeep', [\App\Http\Controllers\EmployeeController::class,'store'])->name("addep.store");
        Route::get('/{employee}/editcr', [\App\Http\Controllers\EmployeeController::class, 'edit'])->name("editep");
        Route::put('/{employee}/editcr',[\App\Http\Controllers\EmployeeController::class,'update'])->name("editep.update");
        Route::delete('/{employee}',[\App\Http\Controllers\EmployeeController::class,'destroy'])->name("destroyep");
    });






    Route::get('/payment', [\App\Http\Controllers\PaymentMethodController::class, 'index'])->name("pay");

