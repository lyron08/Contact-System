<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Contact;
use App\Models\User;

class ContactController extends Controller
{
    private $contact;

    public function __construct(Contact $contact, User $user) {
        $this->contact = $contact;
        $this->user = $user;
    }


    public function index(){
        $user = Auth::user();
        $contacts = $user->contacts()->paginate(4);

        return view('Contact.index')->with('contacts', $contacts);
    }

    public function create(){
        return view('Contact.create');
    }

    public function store(Request $request){
        $request->validate([
            'name' => 'required',
            'company' => 'required',
            'phone_number' => 'required',
            'email' => 'required'
        ]);

        $this->contact->user_id = Auth::user()->id;
        $this->contact->name = $request->name;
        $this->contact->company_name = $request->company;
        $this->contact->phone_number = $request->phone_number;
        $this->contact->company_email = $request->email;

        $this->contact->save();

        return redirect()->route('contacts');

    }

    public function edit($id){
        $contact = $this->contact->findOrFail($id);
        return view('Contact.edit')->with('contact', $contact);
    }

    public function update(Request $request, $id){
        $contact = $this->contact->findOrFail($id);
        $request->validate([
            'name' => 'required',
            'company' => 'required',
            'phone_number' => 'required',
            'email' => 'required'
        ]);

        $contact->name = $request->name;
        $contact->company_name = $request->company;
        $contact->phone_number = $request->phone_number;
        $contact->company_email = $request->email;

        $contact->save();

        return redirect()->route('contacts');
    }

    public function destroy($id){
        $this->contact->destroy($id);
        return redirect()->back();
    }
    
    public function search(Request $request)
    {
        $query = $request->input('query');

        $contacts = Contact::where('name', 'like', "%{$query}%")
            ->orWhere('company_name', 'like', "%{$query}%")
            ->orWhere('phone_number', 'like', "%{$query}%")
            ->orWhere('company_email', 'like', "%{$query}%")
            ->get();

        return response()->json($contacts);
    }
}
