<?php

namespace App\Http\Controllers\back;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\About;
use App\Models\Company;
use Exception;
use Illuminate\Support\Facades\Validator;

class AboutController extends Controller
{
    public function showForm()
    {
        $about = About::first();

        $title = "A PROPOS";
        $pIndex = "about.infos";
        $company = Company::first();
        $param = [
            "title" => $title,
            "pIndex" => $pIndex,
            "about" => $about,
            "company" => $company,
        ];

        return view('admin.about.infos', $param);

    }

    //---Enregistrement ou mise à jour des des infos
    public function saveForm(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'description' => 'required',
            'objectif' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $about = About::first();

        //---Creation
        if($about==null){
            $about = About::create([
                'description' => $request->description,
                'objectif' => $request->objectif,
            ]);

            if($request->file('img1')){
                $file = $request->file('img1');
                $filename = $about->id . '-' . $file->getClientOriginalName();
                //$path = $file->storeAs(config('global.image_actuality'), $filename);
                $file->move('storage/'.config('global.image_about'), $filename);

                $about->img1 = $filename;
            }

            if($request->file('img2')){
                $file = $request->file('img2');
                $filename = $about->id . '-' . $file->getClientOriginalName();
                //$path = $file->storeAs(config('global.image_actuality'), $filename);
                $file->move('storage/'.config('global.image_about'), $filename);

                $about->img2 = $filename;
            }

            if($request->file('doc')){
                $file = $request->file('doc');
                $filename = $about->id . '-' . $file->getClientOriginalName();
                //$path = $file->storeAs(config('global.image_actuality'), $filename);
                $file->move('storage/'.config('global.file_about'), $filename);

                $about->doc = $filename;
            }

            $about->save();
        }
        //---Mise à jour
        else{
            $about->description = $request->description;
            $about->objectif = $request->objectif;

            if($request->file('img1')){

                $url_file = public_path('storage/'.config('global.image_about').'/'.$about->img1);

                if(file_exists($url_file) && $about->img1 !== null)
                {
                    try {
                        unlink($url_file);
                    } catch (Exception $e) {
                        $request->session()->flash('ess-msg', "Un problème se produit. Merci de recommencer le processus. \n" .$e);
                        return redirect()->back();
                    }
                }
                $file = $request->file('img1');
                $filename = $about->id . '-' . $file->getClientOriginalName();
                //$path = $file->storeAs(config('global.image_actuality'), $filename);
                $file->move('storage/'.config('global.image_about'), $filename);

                $about->img1 = $filename;
            }

            if($request->file('img2')){

                $url_file = public_path('storage/'.config('global.image_about').'/'.$about->img2);

                if(file_exists($url_file) && $about->img2 !== null)
                {
                    try {
                        unlink($url_file);
                    } catch (Exception $e) {
                        $request->session()->flash('ess-msg', "Un problème se produit. Merci de recommencer le processus. \n" .$e);
                        return redirect()->back();
                    }
                }

                $file = $request->file('img2');
                $filename = '2-' . $file->getClientOriginalName();
                //$path = $file->storeAs(config('global.image_actuality'), $filename);
                $file->move('storage/'.config('global.image_about'), $filename);

                $about->img2 = $filename;
            }

            if($request->file('doc')){

                $url_file = public_path('storage/'.config('global.file_about').'/'.$about->doc);

                if(file_exists($url_file) && $about->doc !== null)
                {
                    try {
                        unlink($url_file);
                    } catch (Exception $e) {
                        $request->session()->flash('ess-msg', "Un problème se produit. Merci de recommencer le processus. \n" .$e);
                        return redirect()->back();
                    }
                }

                $file = $request->file('doc');
                $filename = $about->id . '-' . $file->getClientOriginalName();
                //$path = $file->storeAs(config('global.image_actuality'), $filename);
                $file->move('storage/'.config('global.file_about'), $filename);

                $about->doc = $filename;
            }

            $about->save();
        }

        $request->session()->flash('ess-msg', "Les informations ont été mises à jour");
        return redirect()->back();
    }
}
