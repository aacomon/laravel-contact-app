<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Repositories\CompanyRepository;
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
        $companies = $this->company->pluck();
        // DB::enableQueryLog();
        // $contacts = Contact::latest()->paginate(10);
        // $contacts = Contact::latest()->where("company_id", request()->query("company_id"))->paginate(10);
        $contacts = Contact::latest()->where(function ($query) {
            if ($companyId = request()->query("company_id")) {
                $query->where("company_id", $companyId);
            }
        })->where(function ($query) {
            if ($seasrch = request()->query('search')) {
                $query->where("first_name", "LIKE", "%{$seasrch}%");
                $query->orWhere("last_name", "LIKE", "%{$seasrch}%");
                $query->orWhere("email", "LIKE", "%{$seasrch}%");
            }
        })->paginate(10);
        // dump(DB::getQueryLog());

        //manual pagination
        // $contactsCollection = Contact::latest()->get();
        // $perPage = 10;
        // $currentPage = request()->query('page', 1);
        // $items = $contactsCollection->slice(($currentPage * $perPage) - $perPage, $perPage);
        // $total = $contactsCollection->count();
        // $contacts = new LengthAwarePaginator($items, $total, $perPage, $currentPage, [
        //     'path' => request()->url(),
        //     'query' => request()->query()
        // ]);


        // $contacts = Contact::latest()->get();

        //$contacts = $this->getContacts();  call the function getContacts above
        // return view('contacts.index', ['contacts' => $contacts]);
        return view('contacts.index', compact('contacts', 'companies'));
    }

    public function create()
    {
        // dd(request()->path());
        $companies = $this->company->pluck();
        $contact = new Contact();

        return view('contacts.create', compact('companies', 'contact'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:50',
            'last_name' => 'required|string|max:50',
            'email' => 'required|email',
            'phone' => 'nullable',
            'address' => 'nullable',
            'company_id' => 'required|exists:companies,id'
        ]);

        // Contact::create($request->all());
        Contact::create($request->all());
        return redirect()->route('contacts.index')->with('message', 'Contact has been added');

        // dd($request->all());
    }

    public function show($id)
    {
        // $contacts = $this->getContacts();
        $contact = Contact::findOrFail($id);
        //abort_if(!isset($contacts[$id]), 404);  this will show when out of range and will show 404 pages instead of error
        // abort_if(empty($contact), 404);
        return view('contacts.show')->with('contact', $contact);
    }

    public function edit($id)
    {
        $companies = $this->company->pluck();
        $contact = Contact::findOrFail($id);
        return view('contacts.edit', compact('companies', 'contact'));
    }

    public function update(Request $request, $id)
    {
        $contact = Contact::findOrFail($id);
        $request->validate([
            'first_name' => 'required|string|max:50',
            'last_name' => 'required|string|max:50',
            'email' => 'required|email',
            'phone' => 'nullable',
            'address' => 'nullable',
            'company_id' => 'required|exists:companies,id'
        ]);

        $contact->update($request->all());
        return redirect()->route('contacts.index')->with('message', 'Contact has been updated');
    }

    public function destroy($id)
    {
        $contact = Contact::findOrFail($id);
        $contact->delete();
        return redirect()->route('contacts.index')->with('message', 'Contact has been removed');
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
