<?php

namespace App\Http\Controllers\back;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\Fonction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class FonctionController extends Controller
{
    public function index()
    {
        $pIndex = 'fonction.all';
        $title = 'Fonctions';
        $company = Company::first();
        $fonctions = Fonction::query()->latest('libelle')->get();

        $param = [
            'pIndex' => $pIndex,
            'title' => $title,
            'company' => $company,
            'fonctions' => $fonctions,
        ];

        return view('admin.fonction.all', $param);
    }

    public function showSaveForm()
    {
        $company = Company::first();

        $param = [
          "title" => "Fonctions",
          "pIndex" => "fonction.new",
          "company" => $company
        ];

        return view('admin.fonction.new', $param);
    }

    public function saveForm(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'libelle' => 'required|string|unique:fonctions,libelle,except,id',
            'montant' => 'required',
        ], [
            'libelle.required' => 'Le libelle est obligatoire',
            'libelle.unique' => 'Le libelle est déjà utilisé',            
            'libelle.string' => 'Le libelle dois être une chaîne de caractère',            
            'montant.required' => 'Le montant est obligatoires',
        ]);

        if ($validator->fails()) {
            $firstErrorMessage = $validator->errors()->first();
            $request->session()->flash('ess-msg-error', $firstErrorMessage);

            return redirect()->back()->withErrors($validator)->withInput();
        }

        $fonction = Fonction::create([
            'libelle' => $request->libelle,
            'montant' => $request->montant,
        ]);

        $fonction->save();

        $request->session()->flash('ess-msg', "Enregistrement effectué");
        return redirect()->route('fonction.updateForm', [$fonction->id]);
    }

    public function showUpdateForm(int $id)
    {
        $fonction = Fonction::where('id', $id)->first();
        $company = Company::first();

        if($fonction == null) return redirect()->route('fonction.all');

        $param = [
          "title" => "Fonctions",
          "pIndex" => "fonction.infos",
          "fonction" => $fonction,
          "company" => $company,
        ];

        return view('admin.fonction.infos', $param);
    }

    public function updateForm(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'libelle' => 'sometimes|unique:fonctions,libelle,' . $request->itemId,
            'montant' => 'sometimes',
        ], [
                'libelle.unique' => 'Ce libelle est déjà utilisé',
            ]
        );

        if ($validator->fails()) {
            $firstErrorMessage = $validator->errors()->first();
            $request->session()->flash('ess-msg-error', $firstErrorMessage);
            
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $fonction = Fonction::where('id', $request->itemId)->first();
        if($fonction==null) return redirect()->back();

        $fonction->libelle = $request->libelle;
        $fonction->montant = $request->montant;

        $fonction->save();

        $request->session()->flash('ess-msg', "Modification effectuée");
        return redirect()->back();
    }

    public function delete(Request $request, int $id)
    {
        $fonction = Fonction::where('id', $id)->first();
        if($fonction==null) return redirect()->back();

        $fonction->delete();

        $request->session()->flash('ess-msg', "Suppression effectuée");
        return redirect()->back();
    }
}
