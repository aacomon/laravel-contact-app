<?php

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

Route::get('/', function () {
    $html = "
    <h1>Contact App</h1>
    <div>

        <a href='" . route('contacts.index') . "'>All contacts</a>
        <a href='" . route('contacts.create') . "'>Add contacts</a>
        <a href='" . route('contacts.show', 1) . "'>Show contacts</a>
    </div>
    ";
    //return view('welcome');
    return $html;
});

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/contacts', function () {
        return "<h1>All contacts</h1>";
    })->name('contacts.index');

    Route::get('/contacts/create', function () {
        return "<h1>Add new Contact</h1>";
    })->name('contacts.create');

    Route::get('/contacts/{id}', function ($id) {
        return "Contact " . $id;
    })->name('contacts.show');
});



Route::get('companies/{name?}', function ($name = null) {
    if ($name) {
        return "Company " . $name;
    } else {
        return "All companies";
    }
    //})->where('name', '[a-zA-Z]+'); // this will accept string or letters only
    //})->whereAlpha('name'); //same will accept string or letters only
})->whereAlphaNumeric('name'); // this will accept string or numbers
