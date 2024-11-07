<?php

namespace App\Http\Controllers\back;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\Demande;
use App\Models\Motif;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class DemandeController extends Controller
{
    public function index()
    {
        $demandes = Demande::query()->latest()->get();

        $company = Company::first();

        $pIndex = 'demande.all';
        $title = 'Demandes';

        $param = [
            'pIndex' => $pIndex,
            'title' => $title,
            'company' => $company,
            'demandes' => $demandes,
        ];

        return view('admin.demande.all',$param);
    }

    public function showSaveForm()
    {
        $company = Company::first();
        $demandeurs = User::query()->oldest('nom')->where('id', '!=', Auth::user()->id)->get();
        $motifs = Motif::query()->oldest('libelle')->get();

        $pIndex = 'demande.new';
        $title = 'Demandes';

        $param = [
            'pIndex' => $pIndex,
            'title' => $title,
            'company' => $company,
            'demandeurs' => $demandeurs,
            'motifs' => $motifs,
        ];

        return view('admin.demande.new',$param);
    }

    public function saveForm(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'demandeur_id' => 'required|integer',
            'motif_id' => 'required|integer',
            'description' => 'required',
        ], [
            'demandeur_id.required' => 'Le demandeur est obligatoire',
            'demandeur_id.integer' => 'Cette valeur du demandeur n\'est pas acceptée',
            'motif_id.required' => 'Le motif de la demande est obligatoire',
            'motif_id.integer' => 'Cette valeur de le motif de la demande n\'est pas acceptée',
            'description.required' => 'La description est obligatoires',
        ]);

        if ($validator->fails()) {
            $firstErrorMessage = $validator->errors()->first();
            $request->session()->flash('ess-msg-error', $firstErrorMessage);

            return redirect()->back()->withErrors($validator)->withInput();
        }

        $demande = Demande::create([
            'demandeur_id' => $request->demandeur_id,
            'motif_id' => $request->motif_id,
            'description' => $request->description,
        ]);

        $demande->save();

        $request->session()->flash('ess-msg', "Enregistrement effectué");
        return redirect()->route('demande.updateForm', [$demande->id]) ;
    }

    public function showUpdateForm(int $id)
    {
        $demandeurs = User::query()->oldest('nom')->where('id', '!=', Auth::user()->id)->get();
        $motifs = Motif::query()->oldest('libelle')->get();

        $demande = Demande::where('id', $id)->first();
        $company = Company::first();
        $pIndex = 'demande.new';
        $title = 'Demandes';

        $param = [
            'demande' => $demande,
            'pIndex' => $pIndex,
            'title' => $title,
            'company' => $company,
            'demandeurs' => $demandeurs,
            'motifs' => $motifs,
        ];

        return view('admin.demande.infos', $param);
    }

    public function updateForm(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'demandeur_id' => 'required|integer',
            'motif_id' => 'required|integer',
            'description' => 'sometimes',
        ], [
            'demandeur_id.required' => 'Le demandeur est obligatoire',
            'demandeur_id.integer' => 'Cette valeur du demandeur n\'est pas acceptée',
            'motif_id.required' => 'Le motif de la demande est obligatoire',
            'motif_id.integer' => 'Cette valeur de le motif de la demande n\'est pas acceptée',
        ]);

        if ($validator->fails()) {
            $firstErrorMessage = $validator->errors()->first();
            $request->session()->flash('ess-msg-error', $firstErrorMessage);

            return redirect()->back()->withErrors($validator)->withInput();
        }

        $demande = Demande::where('id', $request->itemId)->first();
        
        if($demande==null) return redirect()->back();

        $demande->demandeur_id = $request->demandeur_id;
        $demande->motif_id = $request->motif_id;
        $demande->description = $request->description;
        $demande->decision = $request->decision;

        $demande->save();

        $request->session()->flash('ess-msg', "Modification effectuée");
        return redirect()->back();
    }

    public function delete(Request $request, int $id)
    {
        $demande = Demande::where('id', $id)->first();
        if($demande==null) return redirect()->back();

        $demande->delete();

        $request->session()->flash('ess-msg', "Supression effectuée");
        return redirect()->back();
    }
}
