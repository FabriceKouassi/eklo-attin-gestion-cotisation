<?php

namespace App\Http\Controllers\back;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\DocteurConseil;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DocteurConseilController extends Controller
{
    public function showForm(Request $request)
    {
        $company = Company::first();
        $docteur = DocteurConseil::first();

        $param = [
          "title" => "Tableau de bord",
          "pIndex" => "docteur.infos",
          "company" => $company,
          "docteur" => $docteur,
        ];

        return view('admin.docteurConseil.infos', $param);
    }

    //---Enregistrement ou mise à jour des des infos
    public function saveForm(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nom' => 'required',
            'fonction' => 'required',
            'alt' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $docteur = DocteurConseil::first();

        //---Creation
        if($docteur==null){
            $docteur = DocteurConseil::create([
                'nom' => $request->nom,
                'fonction' => $request->fonction,
                'content' => $request->content,
                'alt' => $request->alt,
            ]);
            if($request->file('img')){
                $file = $request->file('img');
                $filename = $docteur->id . '-' . $file->getClientOriginalName();
                $file->move(public_path('storage/'). config('global.image_docteur'), $filename);

                $docteur->img = $filename;
            }

            $docteur->save();
        }
        //---Mise à jour
        else {
            $docteur->nom = $request->nom;
            $docteur->fonction = $request->fonction;
            $docteur->alt = $request->alt;
            $docteur->content = $request->content;

            if($request->file('img')){
                $url_file = public_path('storage/'.config('global.image_docteur').'/'.$docteur->img);

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
                $filename =  $docteur->id.'-'.$file->getClientOriginalName();

                $file->move(public_path('storage/'). config('global.image_docteur'), $filename);

                $docteur->img = $filename;
            }

            $docteur->save();
        }

        $request->session()->flash('ess-msg', "Les informations ont été mises à jour");
        return redirect()->back();
    }
}
