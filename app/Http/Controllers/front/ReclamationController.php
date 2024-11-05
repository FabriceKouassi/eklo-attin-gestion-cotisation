<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\PrestationType;
use App\Models\Reclamation;
use App\Models\Referencement;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ReclamationController extends Controller
{
    public function index()
    {
        $pIndex = 'reclamation';
        $title = 'Reclamations & Suggestions';

        $prestationType = PrestationType::query()->where('isNav', 1)->get();
        $company = Company::query()->first();
        $referencement = Referencement::query()->where('pageCible', $pIndex)->first();

        $param = [
            'pIndex' => $pIndex,
            'title' => $title,
            'company' => $company,
            'prestationType' => $prestationType,
            'referencement' => $referencement,
        ];

        return view('front.reclamation.index', $param);
    }

    public function save(Request $request)
    {
        if ($request->filled('honeypot')) {
            return redirect()->back();
        }
        
        $validator = Validator::make($request->all(), [
            'fullName' => 'required',
            'phone' => 'required',
            'objet' => 'required',
            'email' => 'required',
            'type' => 'required',
            'message' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $reclamation = Reclamation::create([
            'fullName' => $request->fullName,
            'phone' => $request->phone,
            'objet' => $request->objet,
            'type' => $request->type,
            'email' => $request->email,
            'message' => $request->message,
        ]);

        $reclamation->save();

        Toastr::success('Votre requête sera prise en compte par l\'un de nos agent', 'Merci de nous contacter');

        return redirect()->back();
    }
}
