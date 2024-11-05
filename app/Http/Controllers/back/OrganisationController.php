<?php

namespace App\Http\Controllers\back;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\Organisation;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class OrganisationController extends Controller
{
    public function showForm(Request $request)
    {
        $company = Company::first();
        $organisation = Organisation::first();

        $param = [
          "title" => "Organisation",
          "pIndex" => "organisation.infos",
          "company" => $company,
          "organisation" => $organisation,
        ];

        return view('admin.organisation.infos', $param);
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

        $organisation = Organisation::first();

        //---Creation
        if($organisation==null){
            $organisation = Organisation::create([
                'content' => $request->content,
                'alt' => $request->alt,
            ]);

            if($request->file('img')){
                $file = $request->file('img');
                $filename = $organisation->id . '-' . $file->getClientOriginalName();
                $file->move(public_path('storage/'). config('global.image_organisation'), $filename);

                $organisation->img = $filename;
            }

            if($request->file('doc')){
                $file = $request->file('doc');
                $filename =  $organisation->id.'-'.$file->getClientOriginalName();

                $file->move(public_path('storage/'). config('global.file_organisation'), $filename);

                $organisation->doc = $filename;
            }

            $organisation->save();
        }
        //---Mise à jour
        else {
            $organisation->content = $request->content;
            $organisation->alt = $request->alt;

            if($request->file('img')){
                $url_file = public_path('storage/'.config('global.image_organisation').'/'.$organisation->img);

                if(file_exists($url_file) && $organisation->img !== null)
                {
                    try {
                        unlink($url_file);
                    } catch (Exception $e) {
                        $request->session()->flash('ess-msg', "Un problème se produit. Merci de recommencer le processus. \n" .$e);
                        return redirect()->back();
                    }
                }

                $file = $request->file('img');
                $filename =  $organisation->id.'-'.$file->getClientOriginalName();

                $file->move(public_path('storage/'). config('global.image_organisation'), $filename);

                $organisation->img = $filename;
            }

            if($request->file('doc')){

                $url_file = public_path('storage/'.config('global.file_organisation').'/'.$organisation->doc);

                if(file_exists($url_file) && $organisation->doc !== null)
                {
                    try {
                        unlink($url_file);
                    } catch (Exception $e) {
                        $request->session()->flash('ess-msg', "Un problème s'est produit. Merci de recommencer le processus. \n" .$e);
                        return redirect()->back();
                    }
                }

                $file = $request->file('doc');
                $filename =  $organisation->id.'-'.$file->getClientOriginalName();

                $file->move(public_path('storage/'). config('global.file_organisation'), $filename);

                $organisation->doc = $filename;
            }

            $organisation->save();
        }

        $request->session()->flash('ess-msg', "Les informations ont été mises à jour");
        return redirect()->back();
    }
}
