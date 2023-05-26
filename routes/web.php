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

function getContacts()
{
    return [
        1 => ['name' => 'Name 1', 'phone' => '1234567890'],
        2 => ['name' => 'Name 2', 'phone' => '2345678901'],
        3 => ['name' => 'Name 3', 'phone' => '3456789012'],
    ];
}

Route::get('/', function () {
    return view('welcome');
});

Route::get('/contacts', function () {
    $companies = [
        1 => ['name' => 'Company One', 'contacts' => 3],
        2 => ['name' => 'Company Two', 'contacts' => 5],
    ];
    $contacts = getContacts(); // call the function getContacts above
    // return view('contacts.index', ['contacts' => $contacts]);
    return view('contacts.index', compact('contacts', 'companies'));
})->name('contacts.index');

Route::get('/contacts/create', function () {
    return view('contacts.create');
    //return "<h1>Add new Contact</h1>";
})->name('contacts.create');

Route::get('/contacts/{id}', function ($id) {
    $contacts = getContacts();
    abort_if(!isset($contacts[$id]), 404); // this will show when out of range and will show 404 pages instead of error
    $contact = $contacts[$id];
    return view('contacts.show')->with('contact', $contact);
})->name('contacts.show');

Route::get('companies/{name?}', function ($name = null) {
    if ($name) {
        return "Company " . $name;
    } else {
        return "All companies";
    }
    //})->where('name', '[a-zA-Z]+'); // this will accept string or letters only
    //})->whereAlpha('name'); //same will accept string or letters only
})->whereAlphaNumeric('name'); // this will accept string or numbers
