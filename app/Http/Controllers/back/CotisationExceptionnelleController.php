<?php

namespace App\Http\Controllers\back;

use App\Http\Controllers\Controller;
use App\Http\Enums\Decisions;
use App\Models\Company;
use App\Models\CotisationExceptionnelle;
use App\Models\Demande;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class CotisationExceptionnelleController extends Controller
{
    public function index()
    {
        $cotisationExceptionnelle = CotisationExceptionnelle::query()->with(['demande', 'contributeur', 'gestionnaire'])->get();

        $company = Company::first();

        $pIndex = 'cotisationExceptionnelle.all';
        $title = 'Cotisations Exceptionnelles';

        $param = [
            'pIndex' => $pIndex,
            'title' => $title,
            'company' => $company,
            'cotisationExceptionnelle' => $cotisationExceptionnelle,
        ];

        return view('admin.cotisationExceptionnelle.all',$param);
    }

    public function showSaveForm()
    {
        $company = Company::first();
        $demandes = Demande::query()->where('decision', (string) Decisions::ACCEPTE)->get();
        $contributeurs = User::query()->oldest('nom')->where('id', '!=', Auth::user()->id)->get();

        $pIndex = 'cotisationExceptionnelle.new';
        $title = 'Demandes';

        $param = [
            'pIndex' => $pIndex,
            'title' => $title,
            'company' => $company,
            'contributeurs' => $contributeurs,
            'demandes' => $demandes,
        ];

        return view('admin.cotisationExceptionnelle.new',$param);
    }

    public function saveForm(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'demande_id' => 'required|integer',
            'contributeur_id' => 'required|integer',
            'montant' => 'required',
        ], [
            'demande_id.required' => 'Le demandeur est obligatoire',
            'demande_id.integer' => 'Cette valeur du demandeur n\'est pas acceptée',
            'contributeur_id.required' => 'Le contributeur est obligatoire',
            'contributeur_id.integer' => 'Cette valeur du contributeur n\'est pas acceptée',
            'montant.required' => 'Le montant est obligatoires',
        ]);

        if ($validator->fails()) {
            $firstErrorMessage = $validator->errors()->first();
            $request->session()->flash('ess-msg-error', $firstErrorMessage);

            return redirect()->back()->withErrors($validator)->withInput();
        }

        $cotisationExceptionnelle = CotisationExceptionnelle::create([
            'demande_id' => $request->demande_id,
            'contributeur_id' => $request->contributeur_id,
            'montant' => $request->montant,
            'gestionnaire_id' => Auth::user()->id
        ]);

        $cotisationExceptionnelle->save();

        $request->session()->flash('ess-msg', "Enregistrement effectué");
        return redirect()->route('cotisationExceptionnelle.updateForm', [$cotisationExceptionnelle->id]) ;
    }

    public function showUpdateForm(int $id)
    {
        $demandes = Demande::query()->where('decision', (string) Decisions::ACCEPTE)->get();
        $contributeurs = User::query()->oldest('nom')->where('id', '!=', Auth::user()->id)->get();

        $cotisationExceptionnelles = CotisationExceptionnelle::query()->with(['demande', 'contributeur'])
                                    ->where('id', $id)
                                    ->first();

        $cotisationExceptionnelle = Demande::where('id', $id)->first();
        $company = Company::first();
        $pIndex = 'cotisationExceptionnelle.new';
        $title = 'Demandes';

        $param = [
            'cotisationExceptionnelle' => $cotisationExceptionnelle,
            'pIndex' => $pIndex,
            'title' => $title,
            'company' => $company,
            'demandes' => $demandes,
            'contributeurs' => $contributeurs,
            'cotisationExceptionnelles' => $cotisationExceptionnelles,
        ];

        return view('admin.cotisationExceptionnelle.infos', $param);
    }

    public function updateForm(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'demande_id' => 'required|integer',
            'contributeur_id' => 'required|integer',
            'montant' => 'required',
        ], [
            'demande_id.required' => 'Le demandeur est obligatoire',
            'demande_id.integer' => 'Cette valeur du demandeur n\'est pas acceptée',
            'contributeur_id.required' => 'Le contributeur est obligatoire',
            'contributeur_id.integer' => 'Cette valeur du contributeur n\'est pas acceptée',
            'montant.required' => 'Le montant est obligatoires',
        ]);

        if ($validator->fails()) {
            $firstErrorMessage = $validator->errors()->first();
            $request->session()->flash('ess-msg-error', $firstErrorMessage);

            return redirect()->back()->withErrors($validator)->withInput();
        }

        $cotisationExceptionnelle = CotisationExceptionnelle::where('id', $request->itemId)->first();
        
        if($cotisationExceptionnelle==null) return redirect()->back();

        $cotisationExceptionnelle->demande_id = $request->demande_id;
        $cotisationExceptionnelle->contributeur_id = $request->contributeur_id;
        $cotisationExceptionnelle->montant = $request->montant;
        $cotisationExceptionnelle->gestionnaire_id = Auth::user()->id;

        $cotisationExceptionnelle->save();

        $request->session()->flash('ess-msg', "Modification effectuée");
        return redirect()->back();
    }

    public function delete(Request $request, int $id)
    {
        $cotisationExceptionnelle = Demande::where('id', $id)->first();
        if($cotisationExceptionnelle==null) return redirect()->back();

        $cotisationExceptionnelle->delete();

        $request->session()->flash('ess-msg', "Supression effectuée");
        return redirect()->back();
    }
}
