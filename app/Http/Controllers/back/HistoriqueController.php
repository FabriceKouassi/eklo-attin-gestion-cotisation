<?php

namespace App\Http\Controllers\back;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\Historique;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class HistoriqueController extends Controller
{
    public function showForm(Request $request)
    {
        $company = Company::first();
        $historique = Historique::first();

        $param = [
          "title" => "Historique",
          "pIndex" => "historique.infos",
          "company" => $company,
          "historique" => $historique,
        ];

        return view('admin.historique.infos', $param);
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

        $historique = Historique::first();

        //---Creation
        if($historique==null){
            $historique = Historique::create([
                'content' => $request->content,
                'alt' => $request->alt,
            ]);

            if($request->file('img')){
                $file = $request->file('img');
                $filename = $historique->id . '-' . $file->getClientOriginalName();
                $file->move(public_path('storage/'). config('global.image_historique'), $filename);

                $historique->img = $filename;
            }

            if($request->file('doc')){
                $file = $request->file('doc');
                $filename =  $historique->id.'-'.$file->getClientOriginalName();

                $file->move(public_path('storage/'). config('global.file_historique'), $filename);

                $historique->doc = $filename;
            }

            $historique->save();
        }
        //---Mise à jour
        else {
            $historique->content = $request->content;
            $historique->alt = $request->alt;

            if($request->file('img')){
                $url_file = public_path('storage/'.config('global.image_historique').'/'.$historique->img);

                if(file_exists($url_file) && $historique->img !== null)
                {
                    try {
                        unlink($url_file);
                    } catch (Exception $e) {
                        $request->session()->flash('ess-msg', "Un problème se produit. Merci de recommencer le processus. \n" .$e);
                        return redirect()->back();
                    }
                }

                $file = $request->file('img');
                $filename =  $historique->id.'-'.$file->getClientOriginalName();

                $file->move(public_path('storage/'). config('global.image_historique'), $filename);

                $historique->img = $filename;
            }

            if($request->file('doc')){

                $url_file = public_path('storage/'.config('global.file_historique').'/'.$historique->doc);

                if(file_exists($url_file) && $historique->doc !== null)
                {
                    try {
                        unlink($url_file);
                    } catch (Exception $e) {
                        $request->session()->flash('ess-msg', "Un problème s'est produit. Merci de recommencer le processus. \n" .$e);
                        return redirect()->back();
                    }
                }

                $file = $request->file('doc');
                $filename =  $historique->id.'-'.$file->getClientOriginalName();

                $file->move(public_path('storage/'). config('global.file_historique'), $filename);

                $historique->doc = $filename;
            }

            $historique->save();
        }

        $request->session()->flash('ess-msg', "Les informations ont été mises à jour");
        return redirect()->back();
    }
}
