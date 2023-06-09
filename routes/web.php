<?php

use App\Http\Controllers\ActivityController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ContactNoteController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\WelcomeController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', WelcomeController::class);
Route::resource('/contacts', ContactController::class);
Route::delete('/contacts/{contact}/restore', [ContactController::class, 'restore'])->name('contacts.restore');
Route::delete('/contacts/{contact}/force-delete', [ContactController::class, 'forceDelete'])->name('contacts.force-delete');

// Route::controller(ContactController::class)->name('contacts.')->group(function () {

//     Route::get('/contacts', 'index')->name('index');

//     Route::post('/contacts', 'store')->name('store');

//     Route::get('/contacts/create', 'create')->name('create');

//     Route::get('/contacts/{id}', 'show')->name('show');

//     Route::get('/contacts/{id}/edit', 'edit')->name('edit');

//     Route::put('/contacts/{id}', 'update')->name('update');

//     Route::delete('/contacts/{id}', 'destroy')->name('destroy');
// });

Route::resource('/companies', CompanyController::class);

Route::resources([
    '/tags' => TagController::class,
    '/tasks' => TaskController::class
]);

// Route::resource('/activities', ActivityController::class)->only([
//     'create', 'store', 'edit', 'update', 'destroy'
// ]);

// Route::resource('/activities', ActivityController::class)->except([
//     'create', 'store', 'edit', 'update', 'destroy'
// ]);

Route::resource('/activities', ActivityController::class)->except([
    'index', 'show'
]);

Route::resource('/contacts.notes', ContactNoteController::class)->shallow();

// Route::resource('/activities', ActivityController::class)->names([
//     'index' => 'activities.all',
//     'show' => 'activities.view'
// ]);

Route::resource('/activities', ActivityController::class)->parameters([
    'activities' => 'active'
]);
