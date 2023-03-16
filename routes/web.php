<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\GmailController;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::middleware(['adminSessionCheck'])->group(function () {
    Route::get('/list', [AdminController::class, 'empList']);
    Route::delete('/delete_emp/{id}', [AdminController::class, 'deleteEmp']);
    Route::get('/export', [AdminController::class, "downloadEmpAsExcel"]);
    Route::post('/logout', [AdminController::class, 'logout']);
    Route::get('upload', [EmployeeController::class, 'upload'])->name('employees.upload');
    Route::post('/employees/import', [EmployeeController::class, 'import'])->name('employees.import');
    Route::post('/employees/store', [EmployeeController::class, 'store'])->name('employees.store');
    Route::get('create', [EmployeeController::class, 'create'])->name("employees.create");
});
Route::middleware(['empSessionCheck'])->group(function () {
    Route::post('employee/logout', [EmployeeController::class, 'logout'])->name('employees.logout');
    Route::get('employee/inbox',  function(){ return view('employees.gmail.inbox'); });
    Route::get('employee/gmail/auth', [GmailController::class, 'auth'])->name('employees.gmail.auth');
    Route::get('/gmail/callback', [GmailController::class, 'callback'])->name('gmail.callback');
    Route::get('/gmail/inbox', [GmailController::class, 'inbox'])->name('gmail.inbox');
});
Route::post('/login', [AdminController::class, 'login']);
Route::get('/login', function(){ return view('login'); });
Route::view('/', "login");


Route::post('employee/login', [EmployeeController::class, 'login'])->name('employees.login');
Route::get('employee/login', function(){ return view('employees/login'); });
// Route::resource('employees', 'EmployeeController');

// Route::get('inbox', 'EmployeeController@inbox')->name('inbox');
