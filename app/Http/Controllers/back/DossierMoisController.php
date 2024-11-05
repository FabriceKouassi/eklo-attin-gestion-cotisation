<?php

namespace App\Http\Controllers\back;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\DossierMois;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DossierMoisController extends Controller
{
    public function showForm(Request $request)
    {
        $company = Company::first();
        $dossier = DossierMois::first();

        $param = [
          "title" => "Tableau de bord",
          "pIndex" => "dossier.infos",
          "company" => $company,
          "dossier" => $dossier,
        ];

        return view('admin.dossierMois.infos', $param);
    }

    //---Enregistrement ou mise à jour des des infos
    public function saveForm(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'content' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $dossier = DossierMois::first();

        //---Creation
        if($dossier==null){
            $dossier = DossierMois::create([
                'title' => $request->title,
                'content' => $request->content,
                'img_alt' => $request->img_alt,
                'doc_alt' => $request->doc_alt,
            ]);

            if($request->file('img')){
                $file = $request->file('img');
                $filename = $dossier->id . '-' . $file->getClientOriginalName();
                $file->move(public_path('storage/'). config('global.image_dossier'), $filename);

                $dossier->img = $filename;
            }

            if($request->file('doc')){
                $file = $request->file('doc');
                $filename = $dossier->id . '-' . $file->getClientOriginalName();
                $file->move(public_path('storage/'). config('global.file_dossier'), $filename);

                $dossier->doc = $filename;
            }

            $dossier->save();
        }
        //---Mise à jour
        else {
            $dossier->title = $request->title;
            $dossier->content = $request->content;
            $dossier->img_alt = $request->img_alt;
            $dossier->doc_alt = $request->doc_alt;

            if($request->file('img')){
                $url_file = public_path('storage/'.config('global.image_dossier').'/'.$dossier->img);

                if(file_exists($url_file))
                {
                    try {
                        unlink($url_file);
                    } catch (Exception $e) {
                        $request->session()->flash('ess-msg', "Un problème se produit. Merci de recommencer le processus. \n" .$e);
                        return redirect()->back();
                    }
                }

                $file = $request->file('img');
                $filename =  $dossier->id.'-'.$file->getClientOriginalName();

                $file->move(public_path('storage/'). config('global.image_dossier'), $filename);

                $dossier->img = $filename;
            }

            if($request->file('doc')){
                $url_file = public_path('storage/'.config('global.file_dossier').'/'.$dossier->doc);

                if(file_exists($url_file))
                {
                    try {
                        unlink($url_file);
                    } catch (Exception $e) {
                        $request->session()->flash('ess-msg', "Un problème se produit. Merci de recommencer le processus. \n" .$e);
                        return redirect()->back();
                    }
                }

                $file = $request->file('doc');
                $filename = $dossier->id . '-' . $file->getClientOriginalName();
                $file->move(public_path('storage/'). config('global.file_dossier'), $filename);

                $dossier->doc = $filename;
            }

            $dossier->save();
        }

        $request->session()->flash('ess-msg', "Les informations ont été mises à jour");
        return redirect()->back();
    }
}
