<?php

namespace App\Http\Controllers\back\planStrategique;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\StrategiqueActivite;
use App\Models\StrategiqueObjectif;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ActiviteController extends Controller
{
    public function index()
    {
        $strategiqueActivite = StrategiqueActivite::latest()->get();
        $company = Company::first();

        $pIndex = 'strategiqueActivite.all';
        $title = 'Activites Strategiques';

        $param = [
            'strategiqueActivite' => $strategiqueActivite,
            'pIndex' => $pIndex,
            'title' => $title,
            'company' => $company,
        ];

        return view('admin.strategiqueActivite.all',$param);
    }

    public function showSaveForm()
    {
        $company = Company::first();

        $objectif = StrategiqueObjectif::query()->latest('content')->get();

        $pIndex = 'strategiqueActivite.new';
        $title = 'Activites Strategiques';

        $param = [
            'pIndex' => $pIndex,
            'title' => $title,
            'company' => $company,
            'objectif' => $objectif,
        ];

        return view('admin.strategiqueActivite.new',$param);
    }

    public function saveForm(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'content' => 'required'
        ]);

        if($validator->fails()){
            // dd($validator->messages());
            return redirect()->back()->withErrors($validator)->withInput();
        };

        $strategiqueActivite = StrategiqueActivite::create([
            'content' => $request->content,
            'objectif_id' => $request->objectifID,
        ]);

        $strategiqueActivite->save();

        $request->session()->flash('ess-msg', "Enregistrement effectuée avec succès");
        return redirect()->route('strategiqueActivite.all', [$strategiqueActivite->id]) ;
    }

    public function showUpdateForm(int $id)
    {
        $strategiqueActivite = StrategiqueActivite::where('id', $id)->first();
        $company = Company::first();
        $objectif = StrategiqueObjectif::query()->latest('content')->get();

        $pIndex = 'strategiqueActivite.new';
        $title = 'Activites Strategiques';

        $param = [
            'strategiqueActivite' => $strategiqueActivite,
            'pIndex' => $pIndex,
            'title' => $title,
            'company' => $company,
            'objectif' => $objectif,
        ];

        return view('admin.strategiqueActivite.infos', $param);
    }

    public function updateForm(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'content' => 'required',
        ]);

        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        };

        $strategiqueActivite = StrategiqueActivite::where('id', $request->itemId)->first();
        if($strategiqueActivite==null) return redirect()->back();

        $strategiqueActivite->content = $request->content;
        $strategiqueActivite->objectif_id = $request->objectifID;

        $strategiqueActivite->save();

        $request->session()->flash('ess-msg', "Modification effectuée");
        return redirect()->back();
    }

    public function delete(Request $request, int $id)
    {
        $strategiqueActivite = StrategiqueActivite::where('id', $id)->first();
        if($strategiqueActivite==null) return redirect()->back();

        $strategiqueActivite->delete();

        $request->session()->flash('ess-msg', "Supression effectuée");
        return redirect()->back();
    }
}
