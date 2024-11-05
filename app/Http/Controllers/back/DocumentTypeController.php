<?php

namespace App\Http\Controllers\back;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\DocumentType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class DocumentTypeController extends Controller
{
    public function index()
    {
        $documentType = DocumentType::oldest('libelle')->get();
        $company = Company::first();

        $pIndex = 'documentType.all';
        $title = 'Type de documents';

        $param = [
            'pIndex' => $pIndex,
            'title' => $title,
            'company' => $company,
            'documentType' => $documentType,
        ];

        return view('admin.documentType.all',$param);
    }

    public function showSaveForm()
    {
        $company = Company::first();

        $pIndex = 'documentType.new';
        $title = 'Type de documents';

        $param = [
            'pIndex' => $pIndex,
            'title' => $title,
            'company' => $company,
        ];

        return view('admin.documentType.new',$param);
    }

    public function saveForm(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'libelle' => 'required|unique:prestation_types,libelle'
        ]);

        if($validator->fails()){
            // dd($validator->messages());
            $request->session()->flash('ess-msg', "Le libelle est requis ou doit être unique.");
            return redirect()->back()->withErrors($validator)->withInput();
        };

        $documentType = DocumentType::create([
            'libelle' => $request->libelle,
            'slug' => Str::slug($request->libelle, '-'),
        ]);

        $documentType->save();

        $request->session()->flash('ess-msg', "Enregistrement effectuée avec succès");
        return redirect()->route('documentType.updateForm', [$documentType->id]) ;
    }

    public function showUpdateForm(int $id)
    {
        $documentType = DocumentType::where('id', $id)->first();
        $company = Company::first();
        $pIndex = 'documentType.new';
        $title = 'Type de documents';

        $param = [
            'documentType' => $documentType,
            'pIndex' => $pIndex,
            'title' => $title,
            'company' => $company,
        ];

        return view('admin.documentType.infos', $param);
    }

    public function updateForm(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'libelle' => 'required',
        ]);

        if($validator->fails()){
            $request->session()->flash('ess-msg', "Le libelle est requis ou doit être unique.");
            return redirect()->back()->withErrors($validator)->withInput();
        };

        $documentType = DocumentType::where('id', $request->itemId)->first();
        if($documentType==null) return redirect()->back();

        $documentType->libelle = $request->libelle;
        $documentType->slug = Str::slug($request->libelle, '-');

        $documentType->save();

        $request->session()->flash('ess-msg', "Modification effectuée");
        return redirect()->back();
    }

    public function delete(Request $request, int $id)
    {
        $documentType = DocumentType::where('id', $id)->first();
        if($documentType==null) return redirect()->back();

        $documentType->delete();

        $request->session()->flash('ess-msg', "Supression effectuée");
        return redirect()->back();
    }
}
