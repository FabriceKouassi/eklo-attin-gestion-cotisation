<?php

namespace App\Http\Controllers\back\planStrategique;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\StrategiqueAxe;
use App\Models\StrategiqueObjectif;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ObjectifController extends Controller
{
    public function index()
    {
        $strategiqueObjectif = StrategiqueObjectif::latest()->get();
        $company = Company::first();

        $pIndex = 'strategiqueObjectif.all';
        $title = 'Objectifs Strategiques';

        $param = [
            'strategiqueObjectif' => $strategiqueObjectif,
            'pIndex' => $pIndex,
            'title' => $title,
            'company' => $company,
        ];

        return view('admin.strategiqueObjectif.all',$param);
    }

    public function showSaveForm()
    {
        $company = Company::first();
        $axe = StrategiqueAxe::query()->latest('libelle')->get();

        $pIndex = 'strategiqueObjectif.new';
        $title = 'Objectifs Strategiques';

        $param = [
            'pIndex' => $pIndex,
            'title' => $title,
            'company' => $company,
            'axe' => $axe,
        ];

        return view('admin.strategiqueObjectif.new',$param);
    }

    public function saveForm(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'content' => 'required|unique:strategique_objectifs,content'
        ]);

        if($validator->fails()){
            dd($validator->messages());
            $request->session()->flash('ess-msg', "Ce objectif existe et ne peut être enregistré qu'une seul fois");
            return redirect()->back()->withErrors($validator)->withInput();
        };

        $strategiqueObjectif = StrategiqueObjectif::create([
            'content' => $request->content,
            'axe_id' => $request->axeID,
        ]);

        $strategiqueObjectif->save();

        $request->session()->flash('ess-msg', "Enregistrement effectuée avec succès");
        return redirect()->route('strategiqueObjectif.updateForm', [$strategiqueObjectif->id]) ;
    }

    public function showUpdateForm(int $id)
    {
        $strategiqueObjectif = StrategiqueObjectif::where('id', $id)->first();
        $axe = StrategiqueAxe::query()->latest('libelle')->get();
        $company = Company::first();
        $pIndex = 'strategiqueObjectif.new';
        $title = 'Objectifs Strategiques';

        $param = [
            'strategiqueObjectif' => $strategiqueObjectif,
            'pIndex' => $pIndex,
            'title' => $title,
            'company' => $company,
            'axe' => $axe,
        ];

        return view('admin.strategiqueObjectif.infos', $param);
    }

    public function updateForm(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'content' => 'required',
        ]);

        if($validator->fails()){
            $request->session()->flash('ess-msg', "Ce objectif existe et ne peut être enregistré qu'une seul fois");
            return redirect()->back()->withErrors($validator)->withInput();
        };

        $strategiqueObjectif = StrategiqueObjectif::where('id', $request->itemId)->first();
        if($strategiqueObjectif==null) return redirect()->back();

        $strategiqueObjectif->content = $request->content;
        $strategiqueObjectif->axe_id = $request->axeID;

        $strategiqueObjectif->save();

        $request->session()->flash('ess-msg', "Modification effectuée");
        return redirect()->back();
    }

    public function delete(Request $request, int $id)
    {
        $strategiqueObjectif = StrategiqueObjectif::where('id', $id)->first();
        if($strategiqueObjectif==null) return redirect()->back();

        $strategiqueObjectif->delete();

        $request->session()->flash('ess-msg', "Supression effectuée");
        return redirect()->back();
    }
}
