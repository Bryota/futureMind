<?php

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

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes();

Route::get('/', [App\Http\Controllers\User\DiagnosisController::class, 'index'])->name('diagnosis.index')->middleware(['auth', 'uncheckedMessage.user']);
Route::get('/about', [App\Http\Controllers\User\DiagnosisController::class, 'about'])->name('diagnosis.about')->middleware(['auth', 'uncheckedMessage.user']);
Route::group(['namespace' => 'User', 'prefix' => 'diagnosis', 'middleware' => ['auth', 'uncheckedMessage.user']], function () {
    Route::get('future', [App\Http\Controllers\User\DiagnosisController::class, 'future'])->name('diagnosis.future');
    Route::post('future', [App\Http\Controllers\User\DiagnosisController::class, 'futurePost'])->name('diagnosis.futurePost');
    Route::get('self', [App\Http\Controllers\User\DiagnosisController::class, 'self'])->name('diagnosis.self');
    Route::post('self', [App\Http\Controllers\User\DiagnosisController::class, 'selfPost'])->name('diagnosis.selfPost');
    Route::get('result', [App\Http\Controllers\User\DiagnosisController::class, 'result'])->name('diagnosis.result');
    Route::get('futureCompany', [App\Http\Controllers\User\DiagnosisController::class, 'futureCompany'])->name('diagnosis.futureCompany');
    Route::get('selfCompany', [App\Http\Controllers\User\DiagnosisController::class, 'selfCompany'])->name('diagnosis.selfCompany');
    Route::get('futureSingleCompany/{id}', [App\Http\Controllers\User\DiagnosisController::class, 'futureSingleCompany'])->name('diagnosis.futureSingleCompany');
    Route::post('futureSingleCompany/{id}', [App\Http\Controllers\User\DiagnosisController::class, 'futureLikeCompany'])->name('diagnosis.futureLikeCompany');
    Route::get('selfSingleCompany/{id}', [App\Http\Controllers\User\DiagnosisController::class, 'selfSingleCompany'])->name('diagnosis.selfSingleCompany');
    Route::post('selfSingleCompany/{id}', [App\Http\Controllers\User\DiagnosisController::class, 'selfLikeCompany'])->name('diagnosis.selfLikeCompany');
});
Route::group(['namespace' => 'User', 'prefix' => 'user', 'middleware' => ['auth', 'uncheckedMessage.user']], function () {
    Route::get('', [App\Http\Controllers\User\UserController::class, 'index'])->name('user.index');
    Route::get('edit', [App\Http\Controllers\User\UserController::class, 'edit'])->name('user.edit');
    Route::post('edit', [App\Http\Controllers\User\UserController::class, 'update'])->name('user.update');
    Route::get('likes', [App\Http\Controllers\User\UserController::class, 'likesCompany'])->name('user.likes');
    Route::get('chat/{id}', [App\Http\Controllers\User\UserController::class, 'chat'])->name('user.chat');
    Route::get('chat/ajax/{id}', [App\Http\Controllers\User\UserController::class, 'getMessages'])->name('user.getMessage');
    Route::post('chat/{id}', [App\Http\Controllers\User\UserController::class, 'postMessage'])->name('user.postMessage');
});
Route::group(['namespace' => 'User', 'prefix' => 'search', 'middleware' => ['auth', 'uncheckedMessage.user']], function () {
    Route::get('/', [App\Http\Controllers\User\SearchCompanyController::class, 'search'])->name('search.search');
    Route::post('result', [App\Http\Controllers\User\SearchCompanyController::class, 'searchPost'])->name('search.searchPost');
    Route::get('result', [App\Http\Controllers\User\SearchCompanyController::class, 'searchPost'])->name('search.result');
    Route::get('company/{id}', [App\Http\Controllers\User\SearchCompanyController::class, 'single'])->name('search.single');
    Route::post('company/{id}', [App\Http\Controllers\User\SearchCompanyController::class, 'likeCompany'])->name('search.likeCompany');
});

Route::get('/company/login', [App\Http\Controllers\Auth\LoginController::class, 'showCompanyLoginForm'])->name('company.login');
Route::get('/company/register', [App\Http\Controllers\Auth\RegisterController::class, 'showCompanyRegisterForm'])->name('company.register');
Route::post('/company/login', [App\Http\Controllers\Auth\LoginController::class, 'companyLogin']);
Route::post('/company/register', [App\Http\Controllers\Auth\RegisterController::class, 'createCompany']);
Route::group(['namespace' => 'company', 'prefix' => 'company', 'middleware' => ['auth:company', 'uncheckedMessage.company']], function () {
    Route::get('/', [App\Http\Controllers\company\CompanyController::class, 'index'])->name('company.home');
    Route::get('edit', [App\Http\Controllers\company\CompanyController::class, 'edit'])->name('company.edit');
    Route::delete('logout', [App\Http\Controllers\company\CompanyController::class, 'logout'])->name('company.logout');
    Route::post('edit', [App\Http\Controllers\company\CompanyController::class, 'update'])->name('company.update');
    Route::get('diagnosis', [App\Http\Controllers\company\CompanyController::class, 'diagnosis'])->name('company.diagnosis');
    Route::post('diagnosis', [App\Http\Controllers\company\CompanyController::class, 'diagnosisPost'])->name('company.diagnosisPost');
    Route::get('student', [App\Http\Controllers\company\CompanyController::class, 'student'])->name('company.student');
    Route::get('student/{id}', [App\Http\Controllers\company\CompanyController::class, 'singleStudent'])->name('company.singleStudent');
    Route::post('chat', [App\Http\Controllers\company\CompanyController::class, 'createChatRoom'])->name('company.createChatRoom');
    Route::get('chat/{id}', [App\Http\Controllers\company\CompanyController::class, 'chat'])->name('company.chat');
    Route::get('chat/ajax/{id}', [App\Http\Controllers\company\CompanyController::class, 'getMessages'])->name('company.getMessage');
    Route::post('chat/{id}', [App\Http\Controllers\company\CompanyController::class, 'postMessage'])->name('company.postMessage');
});

Route::get('/admin/login', [App\Http\Controllers\Auth\LoginController::class, 'showAdminLogin'])->name('admin.login')->middleware(['firewall']);
Route::post('/admin/login', [App\Http\Controllers\Auth\LoginController::class, 'adminLogin'])->middleware(['firewall']);
Route::group(['namespace' => 'admin', 'prefix' => 'admin', 'middleware' => ['auth:admin', 'firewall']], function () {
    Route::get('/', [App\Http\Controllers\Admin\AdminController::class, 'index'])->name('admin.home');
    Route::get('/future_comment', [App\Http\Controllers\Admin\AdminController::class, 'futureIndex'])->name('admin.future_index');
    Route::get('/future_comment/edit/{id}', [App\Http\Controllers\Admin\AdminController::class, 'futureEdit'])->name('admin.future_edit');
    Route::post('/future_comment/edit/{id}', [App\Http\Controllers\Admin\AdminController::class, 'futureUpdate'])->name('admin.future_update');
    Route::delete('/future_comment/delete/{id}', [App\Http\Controllers\Admin\AdminController::class, 'futureDelete'])->name('admin.future_delete');
    Route::get('/self_comment', [App\Http\Controllers\Admin\AdminController::class, 'selfIndex'])->name('admin.self_index');
    Route::get('/self_comment/edit/{id}', [App\Http\Controllers\Admin\AdminController::class, 'selfEdit'])->name('admin.self_edit');
    Route::delete('/self_comment/delete/{id}', [App\Http\Controllers\Admin\AdminController::class, 'selfDelete'])->name('admin.self_delete');
    Route::post('/self_comment/edit/{id}', [App\Http\Controllers\Admin\AdminController::class, 'selfUpdate'])->name('admin.self_update');
    Route::get('/diagnosis_comment', [App\Http\Controllers\Admin\AdminController::class, 'diagnosisIndex'])->name('admin.diagnosis_index');
    Route::get('/diagnosis_comment/edit/{id}', [App\Http\Controllers\Admin\AdminController::class, 'diagnosisEdit'])->name('admin.diagnosis_edit');
    Route::post('/diagnosis_comment/edit/{id}', [App\Http\Controllers\Admin\AdminController::class, 'diagnosisUpdate'])->name('admin.diagnosis_update');
    Route::delete('/diagnosis_comment/delete/{id}', [App\Http\Controllers\Admin\AdminController::class, 'diagnosisDelete'])->name('admin.diagnosis_delete');
    Route::get('/future_company_comment', [App\Http\Controllers\Admin\AdminController::class, 'futureCompanyIndex'])->name('admin.future_company_index');
    Route::get('/future_company_comment/edit/{id}', [App\Http\Controllers\Admin\AdminController::class, 'futureCompanyEdit'])->name('admin.future_company_edit');
    Route::post('/future_company_comment/edit/{id}', [App\Http\Controllers\Admin\AdminController::class, 'futureCompanyUpdate'])->name('admin.future_company_update');
    Route::delete('/future_company_comment/delete/{id}', [App\Http\Controllers\Admin\AdminController::class, 'futureCompanyDelete'])->name('admin.future_company_delete');
    Route::get('/self_company_comment', [App\Http\Controllers\Admin\AdminController::class, 'selfCompanyIndex'])->name('admin.self_company_index');
    Route::get('/self_company_comment/edit/{id}', [App\Http\Controllers\Admin\AdminController::class, 'selfCompanyEdit'])->name('admin.self_company_edit');
    Route::post('/self_company_comment/edit/{id}', [App\Http\Controllers\Admin\AdminController::class, 'selfCompanyUpdate'])->name('admin.self_company_update');
    Route::delete('/self_company_comment/delete/{id}', [App\Http\Controllers\Admin\AdminController::class, 'selfCompanyDelete'])->name('admin.self_company_delete');
    Route::get('/diagnosis_question', [App\Http\Controllers\Admin\AdminController::class, 'diagnosisQuestionIndex'])->name('admin.diagnosis_question_index');
    Route::get('/diagnosis_question/edit/{id}', [App\Http\Controllers\Admin\AdminController::class, 'diagnosisQuestionEdit'])->name('admin.diagnosis_question_edit');
    Route::post('/diagnosis_question/edit/{id}', [App\Http\Controllers\Admin\AdminController::class, 'diagnosisQuestionUpdate'])->name('admin.diagnosis_question_update');
    Route::delete('/diagnosis_question/delete/{id}', [App\Http\Controllers\Admin\AdminController::class, 'diagnosisQuestionDelete'])->name('admin.diagnosis_question_delete');
    Route::get('/import_diagnosis_qiestion', [App\Http\Controllers\Admin\ImportCSVController::class, 'index'])->name('admin.diagnosis_question_import');
    Route::post('/import_diagnosis_qiestion', [App\Http\Controllers\Admin\ImportCSVController::class, 'store'])->name('admin.diagnosis_question_store');
});
