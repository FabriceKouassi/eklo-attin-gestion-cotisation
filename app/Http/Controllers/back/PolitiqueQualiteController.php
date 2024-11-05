<?php

namespace App\Http\Controllers\back;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\PolitiqueQualite;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PolitiqueQualiteController extends Controller
{
    public function showForm(Request $request)
    {
        $company = Company::first();
        $politique = PolitiqueQualite::first();

        $param = [
          "title" => "Politique Qualite",
          "pIndex" => "politique.infos",
          "company" => $company,
          "politique" => $politique,
        ];

        return view('admin.politique.infos', $param);
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

        $politique = PolitiqueQualite::first();

        //---Creation
        if($politique==null){
            $politique = PolitiqueQualite::create([
                'content' => $request->content,
                'alt' => $request->alt,
            ]);

            if($request->file('img')){
                $file = $request->file('img');
                $filename = $politique->id . '-' . $file->getClientOriginalName();
                $file->move(public_path('storage/'). config('global.image_politique'), $filename);

                $politique->img = $filename;
            }

            if($request->file('doc')){
                $file = $request->file('doc');
                $filename =  $politique->id.'-'.$file->getClientOriginalName();

                $file->move(public_path('storage/'). config('global.file_politique'), $filename);

                $politique->doc = $filename;
            }

            $politique->save();
        }
        //---Mise à jour
        else {
            $politique->content = $request->content;
            $politique->alt = $request->alt;

            if($request->file('img')){
                $url_file = public_path('storage/'.config('global.image_politique').'/'.$politique->img);

                if(file_exists($url_file) && $politique->img !== null)
                {
                    try {
                        unlink($url_file);
                    } catch (Exception $e) {
                        $request->session()->flash('ess-msg', "Un problème se produit. Merci de recommencer le processus. \n" .$e);
                        return redirect()->back();
                    }
                }

                $file = $request->file('img');
                $filename =  $politique->id.'-'.$file->getClientOriginalName();

                $file->move(public_path('storage/'). config('global.image_politique'), $filename);

                $politique->img = $filename;
            }

            if($request->file('doc')){

                $url_file = public_path('storage/'.config('global.file_politique').'/'.$politique->doc);

                if(file_exists($url_file) && $politique->doc !== null)
                {
                    try {
                        unlink($url_file);
                    } catch (Exception $e) {
                        $request->session()->flash('ess-msg', "Un problème s'est produit. Merci de recommencer le processus. \n" .$e);
                        return redirect()->back();
                    }
                }

                $file = $request->file('doc');
                $filename =  $politique->id.'-'.$file->getClientOriginalName();

                $file->move(public_path('storage/'). config('global.file_politique'), $filename);

                $politique->doc = $filename;
            }

            $politique->save();
        }

        $request->session()->flash('ess-msg', "Les informations ont été mises à jour");
        return redirect()->back();
    }
}
