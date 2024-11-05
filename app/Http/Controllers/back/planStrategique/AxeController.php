<?php

namespace App\Http\Controllers\back\planStrategique;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\StrategiqueAxe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AxeController extends Controller
{
    public function index()
    {
        $strategiqueAxe = StrategiqueAxe::oldest('libelle')->get();
        $company = Company::first();

        $pIndex = 'strategiqueAxe.all';
        $title = 'Axe Strategiques';

        $param = [
            'strategiqueAxe' => $strategiqueAxe,
            'pIndex' => $pIndex,
            'title' => $title,
            'company' => $company,
        ];

        return view('admin.strategiqueAxe.all',$param);
    }

    public function showSaveForm()
    {
        $company = Company::first();

        $pIndex = 'strategiqueAxe.new';
        $title = 'Axe Strategiques';

        $param = [
            'pIndex' => $pIndex,
            'title' => $title,
            'company' => $company,
        ];

        return view('admin.strategiqueAxe.new',$param);
    }

    public function saveForm(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'libelle' => 'required|unique:strategique_axes,libelle'
        ]);

        if($validator->fails()){
            // dd($validator->messages());
            $request->session()->flash('ess-msg', "Ce libelle existe et ne peut être enregistré qu'une seul fois");
            return redirect()->back()->withErrors($validator)->withInput();
        };

        $strategiqueAxe = StrategiqueAxe::create([
            'libelle' => $request->libelle,
        ]);

        $strategiqueAxe->save();

        $request->session()->flash('ess-msg', "Enregistrement effectuée avec succès");
        return redirect()->route('strategiqueAxe.all', [$strategiqueAxe->id]) ;
    }

    public function showUpdateForm(int $id)
    {
        $strategiqueAxe = StrategiqueAxe::where('id', $id)->first();
        $company = Company::first();
        $pIndex = 'strategiqueAxe.new';
        $title = 'Axe Strategiques';

        $param = [
            'strategiqueAxe' => $strategiqueAxe,
            'pIndex' => $pIndex,
            'title' => $title,
            'company' => $company,
        ];

        return view('admin.strategiqueAxe.infos', $param);
    }

    public function updateForm(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'libelle' => 'required|unique:strategique_axes,libelle',
        ]);

        if($validator->fails()){
            $request->session()->flash('ess-msg', "Ce libelle existe et ne peut être enregistré qu'une seul fois");
            return redirect()->back()->withErrors($validator)->withInput();
        };

        $strategiqueAxe = StrategiqueAxe::where('id', $request->itemId)->first();
        if($strategiqueAxe==null) return redirect()->back();

        $strategiqueAxe->libelle = $request->libelle;

        $strategiqueAxe->save();

        $request->session()->flash('ess-msg', "Modification effectuée");
        return redirect()->back();
    }

    public function delete(Request $request, int $id)
    {
        $strategiqueAxe = StrategiqueAxe::where('id', $id)->first();
        if($strategiqueAxe==null) return redirect()->back();

        $strategiqueAxe->delete();

        $request->session()->flash('ess-msg', "Supression effectuée");
        return redirect()->back();
    }
}
