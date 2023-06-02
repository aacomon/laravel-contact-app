<?php

namespace App\Http\Controllers;

use App\Repositories\CompanyRepository;
use Illuminate\Http\Request;
use App\Models\Contact;
use Illuminate\Pagination\LengthAwarePaginator;

class ContactController extends Controller
{
    //protected $company;

    public function __construct(protected CompanyRepository $company)
    {
        //$this->company = $company;
    }



    public function index()
    {
        // $companies = [
        //     1 => ['name' => 'Company One', 'contacts' => 3],
        //     2 => ['name' => 'Company Two', 'contacts' => 5],
        // ];

        $companies = $this->company->pluck();

        // $contacts = Contact::latest()->paginate(10);

        //manual pagination
        $contactsCollection = Contact::latest()->get();
        $perPage = 10;
        $currentPage = request()->query('page', 1);
        $items = $contactsCollection->slice(($currentPage * $perPage) - $perPage, $perPage);
        $total = $contactsCollection->count();
        $contacts = new LengthAwarePaginator($items, $total, $perPage, $currentPage, [
            'path' => request()->url(),
            'query' => request()->query()
        ]);


        // $contacts = Contact::latest()->get();

        //$contacts = $this->getContacts();  call the function getContacts above
        // return view('contacts.index', ['contacts' => $contacts]);
        return view('contacts.index', compact('contacts', 'companies'));
    }

    public function create()
    {
        return view('contacts.create');
    }

    public function show($id)
    {
        // $contacts = $this->getContacts();
        $contact = Contact::findOrFail($id);
        //abort_if(!isset($contacts[$id]), 404);  this will show when out of range and will show 404 pages instead of error
        // abort_if(empty($contact), 404);
        return view('contacts.show')->with('contact', $contact);
    }

    // protected function getContacts()
    // {
    //     return [
    //         1 => ['id' => 1, 'name' => 'Name 1', 'phone' => '1234567890'],
    //         2 => ['id' => 2, 'name' => 'Name 2', 'phone' => '2345678901'],
    //         3 => ['id' => 3, 'name' => 'Name 3', 'phone' => '3456789012'],
    //     ];
    // }
}
