<?php

namespace App\Http\Controllers\back;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\Referencement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ReferencementController extends Controller
{
    public function index()
    {
        $referencement = Referencement::query()->oldest()->get();

        $company = Company::first();

        $title = "referencement";
        $pIndex = "referencement.all";
        $param = [
            "title" => $title,
            "pIndex" => $pIndex,
            'company' => $company,
            "referencement" => $referencement,
        ];

        return view('admin.referencement.all', $param);
    }

    public function showSaveForm(Request $request)
    {
        $title = "Referencement";
        $pIndex = "referencement.new";
        $company = Company::first();

        $existingPages = Referencement::pluck('pageCible')->toArray();

        $param = [
            "title" => $title,
            'company' => $company,
            "pIndex" => $pIndex,
            "existingPages" => $existingPages,
        ];

        return view('admin.referencement.new', $param);
    }

    public function saveForm(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'pageCible' => 'unique:referencements,pageCible',
            // 'title' => 'required',
            // 'meta_keywords' => 'required',
            // 'meta_description' => 'required',
            // 'meta_robots' => 'required',
            // 'meta_category' => 'required',
            // 'meta_identifier_url' => 'required',
            // 'meta_reply_to' => 'required',
        ]);

        if($validator->fails()){
            $request->session()->flash('ess-msg', "Désolé, la page '". $request->pageCible."' est déjà referencé. Veuillez choisir une autre page cible svp !");
            return redirect()->back()->withErrors($validator)->withInput();
        };

        $referencement = Referencement::create([
            'pageCible' => $request->pageCible,
            'title' => $request->title,
            'meta_keywords' => $request->meta_keywords,
            'meta_description' => $request->meta_description,
            'meta_robots' => $request->meta_robots,
            'meta_category' => $request->meta_category,
            'meta_identifier_url' => $request->meta_identifier_url,
            'meta_reply_to' => $request->meta_reply_to,
        ]);

        $referencement->save();

        $request->session()->flash('ess-msg', "Enregistrment effectuée avec succès");
        return redirect()->route('referencement.updateForm', [$referencement->id]) ;
    }


    public function showUpdateForm(Request $request, $referencementId)
    {
        $company = Company::first();
        $referencement = Referencement::where('id', $referencementId)->first();

        if($referencement==null) return redirect()->back();

        $title = "Referencement";
        $pIndex = "referencement.infos";
        $param = [
            "title" => $title,
            "pIndex" => $pIndex,
            "referencement" => $referencement,
            'company' => $company,
        ];

        return view('admin.referencement.infos', $param);
    }


    public function updateForm(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'pageCible' => 'required',
            // 'title' => 'required',
            'meta_keywords' => 'required',
            'meta_description' => 'required',
            'meta_robots' => 'required',
            // 'meta_category' => 'required',
            // 'meta_identifier_url' => 'required',
            // 'meta_reply_to' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $referencement = Referencement::where('id', $request->referencementId)->first();
        if($referencement==null) return redirect()->back();

        $referencement->pageCible = $request->pageCible;
        $referencement->title = $request->title;
        $referencement->meta_keywords = $request->meta_keywords;
        $referencement->meta_description = $request->meta_description;
        $referencement->meta_robots = $request->meta_robots;
        $referencement->meta_category = $request->meta_category;
        $referencement->meta_identifier_url = $request->meta_identifier_url;
        $referencement->meta_reply_to = $request->meta_reply_to;

        $referencement->save();

        $request->session()->flash('ess-msg', "Modification effectuée");
        return redirect()->back();
    }

    public function delete(Request $request, int $id)
    {
        $referencement = Referencement::where('id', $id)->first();
        if($referencement==null) return redirect()->back();
        $referencement->delete();

        $request->session()->flash('ess-msg', "Supression effectuée");
        return redirect()->back();
    }
}
