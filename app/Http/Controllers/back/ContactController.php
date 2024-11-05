<?php

namespace App\Http\Controllers\back;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        $contacts = Contact::latest()->get();

        $company = Company::first();

        $pIndex = 'contact.all';
        $title = 'Contact';

        $param = [
            'contacts' => $contacts,
            'pIndex' => $pIndex,
            'title' => $title,
            'company' => $company,
        ];

        return view('admin.contact.all',$param);
    }

    public function showUpdateForm(int $id)
    {
        $contact = Contact::where('id', $id)->first();
        $company = Company::first();
        $pIndex = 'contact.infos';
        $title = 'Contact';

        $contact->isRead = 1;

        $contact->save();

        $param = [
            'contact' => $contact,
            'pIndex' => $pIndex,
            'title' => $title,
            'company' => $company,
        ];

        return view('admin.contact.infos', $param);
    }

    public function delete(Request $request, int $id)
    {
        $contact = Contact::where('id', $id)->first();
        if($contact==null) return redirect()->back();

        $contact->delete();

        $request->session()->flash('ess-msg', "Supression effectuée");
        return redirect()->back();
    }

    public function manyDelete(Request $request)
    {
        if ($request->ids === null)
        {
            $request->session()->flash('ess-msg', "Veuillez selectionner au moins une ligne avant la suppression groupé");
            return redirect()->back();
        }
        $request->validate([
            'ids' => 'required|array',
            'ids.*' => 'exists:contacts,id',
        ]);

    
        Contact::destroy($request->ids);
        $request->session()->flash('ess-msg', "Supression effectuée");

        return redirect()->back();
    }
}
