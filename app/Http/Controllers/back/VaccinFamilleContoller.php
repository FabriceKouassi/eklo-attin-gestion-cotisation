<?php

namespace App\Http\Controllers\back;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\VaccinFamille;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class VaccinFamilleContoller extends Controller
{
    public function index()
    {
        $vaccinFamille = VaccinFamille::oldest('libelle')->get();
        $company = Company::first();

        $pIndex = 'vaccinFamille.all';
        $title = 'Type de Vaccins';

        $param = [
            'vaccinFamille' => $vaccinFamille,
            'pIndex' => $pIndex,
            'title' => $title,
            'company' => $company,
        ];

        return view('admin.vaccinFamille.all',$param);
    }

    public function showSaveForm()
    {
        $company = Company::first();

        $pIndex = 'vaccinFamille.new';
        $title = 'Type de Vaccin';

        $param = [
            'pIndex' => $pIndex,
            'title' => $title,
            'company' => $company,
        ];

        return view('admin.vaccinFamille.new',$param);
    }

    public function saveForm(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'libelle' => 'required|unique:vaccin_familles,libelle',
        ]);

        if($validator->fails()){
            // dd($validator->messages());
            $request->session()->flash('ess-msg', "Le libelle est requis ou doit être unique.");
            return redirect()->back()->withErrors($validator)->withInput();
        };

        $vaccinFamille = VaccinFamille::create([
            'libelle' => $request->libelle,
        ]);

        $vaccinFamille->save();

        $request->session()->flash('ess-msg', "Enregistrement effectuée avec succès");
        return redirect()->route('vaccinFamille.all', [$vaccinFamille->id]) ;
    }

    public function showUpdateForm(int $id)
    {
        $vaccinFamille = VaccinFamille::where('id', $id)->first();
        $company = Company::first();
        $pIndex = 'vaccinFamille.new';
        $title = 'Type de Vaccins';

        $param = [
            'vaccinFamille' => $vaccinFamille,
            'pIndex' => $pIndex,
            'title' => $title,
            'company' => $company,
        ];

        return view('admin.vaccinFamille.infos', $param);
    }

    public function updateForm(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'libelle' => 'required|unique:vaccin_familles,libelle',
        ]);

        if($validator->fails()){
            $request->session()->flash('ess-msg', "Le libelle est requis ou doit être unique.");
            return redirect()->back()->withErrors($validator)->withInput();
        };

        $vaccinFamille = VaccinFamille::where('id', $request->itemId)->first();
        if($vaccinFamille==null) return redirect()->back();

        $vaccinFamille->libelle = $request->libelle;

        $vaccinFamille->save();

        $request->session()->flash('ess-msg', "Modification effectuée");
        return redirect()->back();
    }

    public function delete(Request $request, int $id)
    {
        $vaccinFamille = VaccinFamille::where('id', $id)->first();
        if($vaccinFamille==null) return redirect()->back();

        $vaccinFamille->delete();

        $request->session()->flash('ess-msg', "Supression effectuée");
        return redirect()->back();
    }
}
