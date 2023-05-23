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
    return view('welcome');
});

Route::get('/contacts', function () {
    return "<h1>All Contacts</h1>";
});

Route::get('/contacts/create', function () {
    return "<h1>Add new Contact</h1>";
});

//route parameters
Route::get('/contacts/{id}', function ($id) {
    return "Contact " . $id;
})->where('id', '[0-9]+'); // this will accept numerical only

Route::get('companies/{name?}', function ($name = null) {
    if ($name) {
        return "Company " . $name;
    } else {
        return "All companies";
    }
})->where('name', '[a-zA-Z]+'); // this will accept string or letters only
