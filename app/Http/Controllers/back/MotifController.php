<?php

namespace App\Http\Controllers\back;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\Motif;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MotifController extends Controller
{
    public function index()
    {
        $pIndex = 'motif.all';
        $title = 'Motifs';
        $company = Company::first();
        $motifs = Motif::query()->latest('libelle')->get();

        $param = [
            'pIndex' => $pIndex,
            'title' => $title,
            'company' => $company,
            'motifs' => $motifs,
        ];

        return view('admin.motif.all', $param);
    }

    public function showSaveForm()
    {
        $company = Company::first();

        $param = [
          "title" => "Motifs",
          "pIndex" => "motif.new",
          "company" => $company
        ];

        return view('admin.motif.new', $param);
    }

    public function saveForm(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'libelle' => 'required|string|unique:motifs,libelle,except,id',
        ], [
            'libelle.required' => 'Le libelle est obligatoire',
            'libelle.unique' => 'Le libelle est déjà utilisé',            
            'libelle.string' => 'Le libelle dois être une chaîne de caractère',            
        ]);

        if ($validator->fails()) {
            $firstErrorMessage = $validator->errors()->first();
            $request->session()->flash('ess-msg-error', $firstErrorMessage);

            return redirect()->back()->withErrors($validator)->withInput();
        }

        $motif = Motif::create([
            'libelle' => $request->libelle,
        ]);

        $motif->save();

        $request->session()->flash('ess-msg', "Enregistrement effectué");
        return redirect()->route('motif.updateForm', [$motif->id]);
    }

    public function showUpdateForm(int $id)
    {
        $motif = Motif::where('id', $id)->first();
        $company = Company::first();

        if($motif == null) return redirect()->route('motif.all');

        $param = [
          "title" => "Motifs",
          "pIndex" => "motif.infos",
          "motif" => $motif,
          "company" => $company,
        ];

        return view('admin.motif.infos', $param);
    }

    public function updateForm(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'libelle' => 'sometimes|unique:motifs,libelle,' . $request->itemId,
        ], [
                'libelle.unique' => 'Ce libelle est déjà utilisé',
            ]
        );

        if ($validator->fails()) {
            $firstErrorMessage = $validator->errors()->first();
            $request->session()->flash('ess-msg-error', $firstErrorMessage);
            
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $motif = Motif::where('id', $request->itemId)->first();
        if($motif==null) return redirect()->back();

        $motif->libelle = $request->libelle;

        $motif->save();

        $request->session()->flash('ess-msg', "Modification effectuée");
        return redirect()->back();
    }

    public function delete(Request $request, int $id)
    {
        $motif = Motif::where('id', $id)->first();
        if($motif==null) return redirect()->back();

        $motif->delete();

        $request->session()->flash('ess-msg', "Suppression effectuée");
        return redirect()->back();
    }
}
