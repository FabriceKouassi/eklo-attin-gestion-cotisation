<?php

namespace App\Http\Controllers\back;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\VaccinDisponible;
use App\Models\VaccinFamille;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class VaccinDisponibleController extends Controller
{
    public function index()
    {
        $vaccin = VaccinDisponible::oldest('title')->get();
        $company = Company::first();
        $vaccinFamille = VaccinFamille::count();

        $pIndex = 'vaccin.all';
        $title = 'Vaccins Disponibles';

        $param = [
            'vaccin' => $vaccin,
            'pIndex' => $pIndex,
            'title' => $title,
            'vaccinFamille' => $vaccinFamille,
            'company' => $company,
        ];

        return view('admin.vaccin.all',$param);
    }

    public function showSaveForm()
    {
        $company = Company::first();
        $vaccinFamille = VaccinFamille::query()->latest('libelle')->get();

        $pIndex = 'vaccin.new';
        $title = 'Vaccins Disponibles';

        $param = [
            'pIndex' => $pIndex,
            'title' => $title,
            'company' => $company,
            'vaccinFamille' => $vaccinFamille,
        ];

        return view('admin.vaccin.new',$param);
    }

    public function saveForm(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nom' => 'sometimes',
            'title' => 'required|unique:vaccin_disponibles,title',
            'age' => 'required',
            'frequence' => 'required',
            'vaccinFamille' => 'required|numeric',
        ]);

        if($validator->fails()){
            // dd($validator->messages());
            $request->session()->flash('ess-msg', "Certaines valeurs saisir doivent être unique");
            return redirect()->back()->withErrors($validator)->withInput();
        };

        $vaccin = VaccinDisponible::create([
            'nom' => $request->nom,
            'title' => $request->title,
            'age' => $request->age,
            'periode' => $request->periode,
            'cout' => (int) $request->cout,
            'frequence' => $request->frequence,
            'vaccin_famille_id' => (int) $request->vaccinFamille,
        ]);

        $vaccin->save();

        $request->session()->flash('ess-msg', "Enregistrement effectuée avec succès");
        return redirect()->route('vaccin.updateForm', [$vaccin->id]) ;
    }

    public function showUpdateForm(int $id)
    {
        $vaccin = VaccinDisponible::where('id', $id)->first();
        $company = Company::first();
        $vaccinFamille = VaccinFamille::query()->latest('libelle')->get();
        $pIndex = 'vaccin.new';
        $title = 'Vaccins Disponibles';

        $param = [
            'vaccin' => $vaccin,
            'pIndex' => $pIndex,
            'title' => $title,
            'company' => $company,
            'vaccinFamille' => $vaccinFamille,
        ];

        return view('admin.vaccin.infos', $param);
    }

    public function updateForm(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nom' => 'sometimes',
            'title' => 'sometimes',
            'age' => 'sometimes',
            'frequence' => 'sometimes',
            'vaccinFamille' => 'required|numeric',
        ]);

        if($validator->fails()){
            dd($validator->messages());
            $request->session()->flash('ess-msg', "Certaines valeurs saisir doivent être unique");
            return redirect()->back()->withErrors($validator)->withInput();
        };

        $vaccin = VaccinDisponible::where('id', $request->itemId)->first();
        if($vaccin==null) return redirect()->back();

        $vaccin->nom = $request->nom;
        $vaccin->age = $request->age;
        $vaccin->periode = $request->periode;
        $vaccin->frequence = $request->frequence;
        $vaccin->cout = (int) $request->cout;
        $vaccin->title = $request->title;
        $vaccin->vaccin_famille_id = (int) $request->vaccinFamille;

        $vaccin->save();

        $request->session()->flash('ess-msg', "Modification effectuée");
        return redirect()->back();
    }

    public function delete(Request $request, int $id)
    {
        $vaccin = VaccinDisponible::where('id', $id)->first();
        if($vaccin==null) return redirect()->back();

        $vaccin->delete();

        $request->session()->flash('ess-msg', "Supression effectuée");
        return redirect()->back();
    }
}
