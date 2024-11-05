<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\Document;
use App\Models\DocumentType;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DocumentController extends Controller
{
    public function index()
    {
        $document = Document::latest()->get();

        $company = Company::first();

        $pIndex = 'document.all';
        $title = 'Documents';

        $param = [
            'document' => $document,
            'pIndex' => $pIndex,
            'title' => $title,
            'company' => $company,
        ];

        return view('admin.document.all',$param);
    }

    public function showSaveForm()
    {
        $company = Company::first();
        $documentType = DocumentType::query()->oldest('libelle')->get();

        $pIndex = 'document.new';
        $title = 'Documents';

        $param = [
            'pIndex' => $pIndex,
            'title' => $title,
            'company' => $company,
            'documentType' => $documentType,
        ];

        return view('admin.document.new',$param);
    }

    public function saveForm(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|unique:documents,title,except,id',
        ]);

        if($validator->fails()){
            $request->session()->flash('ess-msg', "Le titre du document dois être unique et obligatoires.");
            return redirect()->back()->withErrors($validator)->withInput();
        };

        $document = Document::create([
            'title' => $request->title,
            'description' => $request->description,
            'img_alt' => $request->img_alt,
            'doc_alt' => $request->doc_alt,
            'document_types_id' => $request->documentType,
        ]);

        if($request->file('img')){
            $file = $request->file('img');
            $filename = $document->id.'-'.$file->getClientOriginalName();

            $file->move(public_path('storage/'). config('global.image_document'), $filename);

            $document->img = $filename;
        }
        if($request->file('doc')){
            $file = $request->file('doc');
            $filename =  $document->id.'-'.$file->getClientOriginalName();

            $file->move(public_path('storage/'). config('global.file_document'), $filename);

            $document->doc = $filename;
        }

        $document->save();

        $request->session()->flash('ess-msg', "Enregistrment effectuée avec succès");
        return redirect()->route('document.updateForm', [$document->id]) ;
    }

    public function showUpdateForm(int $id)
    {
        $documentType = DocumentType::query()->oldest('libelle')->get();
        $document = Document::where('id', $id)->first();
        $company = Company::first();
        $pIndex = 'document.new';
        $title = 'Documents';

        $param = [
            'document' => $document,
            'pIndex' => $pIndex,
            'title' => $title,
            'company' => $company,
            'documentType' => $documentType,
        ];

        return view('admin.document.infos', $param);
    }

    public function updateForm(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
        ]);

        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        };

        $document = Document::where('id', $request->itemId)->first();
        if($document==null) return redirect()->back();

        $document->title = $request->title;
        $document->description = $request->description;
        $document->img_alt = $request->img_alt;
        $document->doc_alt = $request->doc_alt;
        $document->document_types_id = $request->documentType;

        if($request->file('img')){
            $url_file = public_path('storage/'.config('global.image_document').'/'.$document->img);

            if(file_exists($url_file) && $document->img !== null)
            {
                try {
                    unlink($url_file);
                } catch (Exception $e) {
                    $request->session()->flash('ess-msg', "Un problème se produit. Merci de recommencer le processus. \n" .$e);
                    return redirect()->back();
                }
            }

            $file = $request->file('img');
            $filename =  $document->id.'-'.$file->getClientOriginalName();

            $file->move(public_path('storage/'). config('global.image_document'), $filename);

            $document->img = $filename;
        }
        if($request->file('doc')){

            $url_file = public_path('storage/'.config('global.file_document').'/'.$document->doc);

            if(file_exists($url_file) && $document->doc !== null)
            {
                try {
                    unlink($url_file);
                } catch (Exception $e) {
                    $request->session()->flash('ess-msg', "Un problème s'est produit. Merci de recommencer le processus. \n" .$e);
                    return redirect()->back();
                }
            }

            $file = $request->file('doc');
            $filename =  $document->id.'-'.$file->getClientOriginalName();

            $file->move(public_path('storage/'). config('global.file_document'), $filename);

            $document->doc = $filename;
        }

        $document->save();

        $request->session()->flash('ess-msg', "Modification effectuée");
        return redirect()->back();
    }

    public function delete(Request $request, int $id)
    {
        $document = Document::where('id', $id)->first();
        if($document==null) return redirect()->back();

        $url_doc = public_path('storage/'.config('global.file_document').'/'.$document->doc);
        $url_img = public_path('storage/'.config('global.image_document').'/'.$document->img);

        if(file_exists($url_img) && $document->img !== null)
        {
            try {
                unlink($url_img);
            } catch (Exception $e) {
                $request->session()->flash('ess-msg', "Un problème se produit. Merci de recommencer le processus. \n" .$e);
                return redirect()->back();
            }
        }
        if(file_exists($url_doc) && $document->doc !== null)
        {
            try {
                unlink($url_doc);
            } catch (Exception $e) {
                $request->session()->flash('ess-msg', "Un problème se produit. Merci de recommencer le processus. \n" .$e);
                return redirect()->back();
            }
        }

        $document->delete();

        $request->session()->flash('ess-msg', "Supression effectuée");
        return redirect()->back();
    }
}
