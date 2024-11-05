<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\Contact;
use App\Models\PrestationType;
use App\Models\Referencement;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ContactController extends Controller
{
    public function index()
    {
        $pIndex = 'contact';
        $title = 'Contact';

        $prestationType = PrestationType::query()->where('isNav', 1)->get();
        $company = Company::query()->first();
        $contact = Contact::query()->oldest()->get();
        $referencement = Referencement::query()->where('pageCible', $pIndex)->first();

        $param = [
            'pIndex' => $pIndex,
            'title' => $title,
            'company' => $company,
            'contact' => $contact,
            'prestationType' => $prestationType,
            'referencement' => $referencement,
        ];

        return view('front.contact.index', $param);
    }

    public function save(Request $request)
    {
        if ($request->filled('honeypot')) {
            return redirect()->back();
        }
        
        $validator = Validator::make($request->all(), [
            'fullName' => 'required',
            'phone' => 'required',
            'email' => 'required',
            'message' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $contact = Contact::create([
            'fullName' => $request->fullName,
            'phone' => $request->phone,
            'email' => $request->email,
            'message' => $request->message,
        ]);

        $contact->save();

        Toastr::success('Votre requête sera prise en compte par l\'un de nos agent', 'Merci de nous contacter');

        return redirect()->back();
    }
}
