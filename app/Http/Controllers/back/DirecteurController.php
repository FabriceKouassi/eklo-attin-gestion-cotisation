<?php

namespace App\Http\Controllers\back;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\Directeur;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DirecteurController extends Controller
{
    public function showForm(Request $request)
    {
        $company = Company::first();
        $directeur = Directeur::first();

        $param = [
          "title" => "Mot du directeur",
          "pIndex" => "directeur.infos",
          "company" => $company,
          "directeur" => $directeur,
        ];

        return view('admin.directeur.infos', $param);
    }

    //---Enregistrement ou mise à jour des des infos
    public function saveForm(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'content' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $directeur = Directeur::first();

        //---Creation
        if($directeur==null){
            $directeur = Directeur::create([
                'nom' => $request->nom,
                'content' => $request->content,
                'alt' => $request->alt,
            ]);

            if($request->file('img')){
                $file = $request->file('img');
                $filename = $directeur->id . '-' . $file->getClientOriginalName();
                $file->move(public_path('storage/'). config('global.image_directeur'), $filename);

                $directeur->img = $filename;
            }

            if($request->file('doc')){
                $file = $request->file('doc');
                $filename =  $directeur->id.'-'.$file->getClientOriginalName();

                $file->move(public_path('storage/'). config('global.file_directeur'), $filename);

                $directeur->doc = $filename;
            }

            $directeur->save();
        }
        //---Mise à jour
        else {
            $directeur->nom = $request->nom;
            $directeur->content = $request->content;
            $directeur->alt = $request->alt;

            if($request->file('img')){
                $url_file = public_path('storage/'.config('global.image_directeur').'/'.$directeur->img);

                if(file_exists($url_file) && $directeur->img !== null)
                {
                    try {
                        unlink($url_file);
                    } catch (Exception $e) {
                        $request->session()->flash('ess-msg', "Un problème se produit. Merci de recommencer le processus. \n" .$e);
                        return redirect()->back();
                    }
                }

                $file = $request->file('img');
                $filename =  $directeur->id.'-'.$file->getClientOriginalName();

                $file->move(public_path('storage/'). config('global.image_directeur'), $filename);

                $directeur->img = $filename;
            }

            if($request->file('doc')){

                $url_file = public_path('storage/'.config('global.file_directeur').'/'.$directeur->doc);

                if(file_exists($url_file) && $directeur->doc !== null)
                {
                    try {
                        unlink($url_file);
                    } catch (Exception $e) {
                        $request->session()->flash('ess-msg', "Un problème s'est produit. Merci de recommencer le processus. \n" .$e);
                        return redirect()->back();
                    }
                }

                $file = $request->file('doc');
                $filename =  $directeur->id.'-'.$file->getClientOriginalName();

                $file->move(public_path('storage/'). config('global.file_directeur'), $filename);

                $directeur->doc = $filename;
            }

            $directeur->save();
        }

        $request->session()->flash('ess-msg', "Les informations ont été mises à jour");
        return redirect()->back();
    }
}
