<?php

namespace App\Http\Controllers\back;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\VaccinationCalendrier;
use App\Models\VaccinFamille;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class VaccinationCalendrierController extends Controller
{
    public function index()
    {
        $calendrier = VaccinationCalendrier::oldest('title')->get();
        $company = Company::first();
        $vaccinFamille = VaccinFamille::count();

        $pIndex = 'calendrier.all';
        $title = 'Calendrier de vaccinations';

        $param = [
            'calendrier' => $calendrier,
            'pIndex' => $pIndex,
            'title' => $title,
            'vaccinFamille' => $vaccinFamille,
            'company' => $company,
        ];

        return view('admin.calendrier.all',$param);
    }

    public function showSaveForm()
    {
        $company = Company::first();
        $vaccinFamille = VaccinFamille::query()->latest('libelle')->get();

        $pIndex = 'calendrier.new';
        $title = 'Calendrier de vaccinations';

        $param = [
            'pIndex' => $pIndex,
            'title' => $title,
            'vaccinFamille' => $vaccinFamille,
            'company' => $company,
        ];

        return view('admin.calendrier.new',$param);
    }

    public function saveForm(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nom' => 'sometimes',
            'title' => 'required|unique:vaccination_calendriers,title',
            'age' => 'required',
            'vaccinFamille' => 'required|numeric',
            'frequence' => 'required',
        ]);

        if($validator->fails()){
            // dd($validator->messages());
            $request->session()->flash('ess-msg', "Certaines valeurs saisir doivent être unique");
            return redirect()->back()->withErrors($validator)->withInput();
        };

        $calendrier = VaccinationCalendrier::create([
            'nom' => $request->nom,
            'title' => $request->title,
            'age' => $request->age,
            'periode' => $request->periode,
            'cout' => (int) $request->cout,
            'vaccin_famille_id' => (int) $request->vaccinFamille,
            'frequence' => $request->frequence,
        ]);

        $calendrier->save();

        $request->session()->flash('ess-msg', "Enregistrement effectuée avec succès");
        return redirect()->route('calendrier.updateForm', [$calendrier->id]) ;
    }

    public function showUpdateForm(int $id)
    {
        $calendrier = VaccinationCalendrier::where('id', $id)->first();
        $vaccinFamille = VaccinFamille::query()->latest('libelle')->get();
        $company = Company::first();
        $pIndex = 'calendrier.new';
        $title = 'Calendrier de vaccinations';

        $param = [
            'calendrier' => $calendrier,
            'pIndex' => $pIndex,
            'title' => $title,
            'vaccinFamille' => $vaccinFamille,
            'company' => $company,
        ];

        return view('admin.calendrier.infos', $param);
    }

    public function updateForm(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nom' => 'sometimes',
            'title' => 'sometimes',
            'age' => 'sometimes',
            'vaccinFamille' => 'required|numeric',
            'frequence' => 'sometimes',
        ]);

        if($validator->fails()){
            dd($validator->messages());
            $request->session()->flash('ess-msg', "Certaines valeurs saisir doivent être unique");
            return redirect()->back()->withErrors($validator)->withInput();
        };

        $calendrier = VaccinationCalendrier::where('id', $request->itemId)->first();
        if($calendrier==null) return redirect()->back();

        $calendrier->nom = $request->nom;
        $calendrier->age = $request->age;
        $calendrier->periode = $request->periode;
        $calendrier->frequence = $request->frequence;
        $calendrier->cout = (int) $request->cout;
        $calendrier->vaccin_famille_id = (int) $request->vaccinFamille;
        $calendrier->title = $request->title;

        $calendrier->save();

        $request->session()->flash('ess-msg', "Modification effectuée");
        return redirect()->back();
    }

    public function delete(Request $request, int $id)
    {
        $calendrier = VaccinationCalendrier::where('id', $id)->first();
        if($calendrier==null) return redirect()->back();

        $calendrier->delete();

        $request->session()->flash('ess-msg', "Supression effectuée");
        return redirect()->back();
    }
}
