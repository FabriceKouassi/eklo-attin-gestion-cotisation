<?php

namespace App\Http\Controllers\back;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\Mission;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MissionController extends Controller
{
    public function showForm(Request $request)
    {
        $company = Company::first();
        $mission = Mission::first();

        $param = [
          "title" => "Mission",
          "pIndex" => "mission.infos",
          "company" => $company,
          "mission" => $mission,
        ];

        return view('admin.mission.infos', $param);
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

        $mission = Mission::first();

        //---Creation
        if($mission==null){
            $mission = Mission::create([
                'content' => $request->content,
                'alt' => $request->alt,
            ]);

            if($request->file('img')){
                $file = $request->file('img');
                $filename = $mission->id . '-' . $file->getClientOriginalName();
                $file->move(public_path('storage/'). config('global.image_mission'), $filename);

                $mission->img = $filename;
            }

            if($request->file('doc')){
                $file = $request->file('doc');
                $filename =  $mission->id.'-'.$file->getClientOriginalName();

                $file->move(public_path('storage/'). config('global.file_mission'), $filename);

                $mission->doc = $filename;
            }

            $mission->save();
        }
        //---Mise à jour
        else {
            $mission->content = $request->content;
            $mission->alt = $request->alt;

            if($request->file('img')){
                $url_file = public_path('storage/'.config('global.image_mission').'/'.$mission->img);

                if(file_exists($url_file) && $mission->img !== null)
                {
                    try {
                        unlink($url_file);
                    } catch (Exception $e) {
                        $request->session()->flash('ess-msg', "Un problème se produit. Merci de recommencer le processus. \n" .$e);
                        return redirect()->back();
                    }
                }

                $file = $request->file('img');
                $filename =  $mission->id.'-'.$file->getClientOriginalName();

                $file->move(public_path('storage/'). config('global.image_mission'), $filename);

                $mission->img = $filename;
            }

            if($request->file('doc')){

                $url_file = public_path('storage/'.config('global.file_mission').'/'.$mission->doc);

                if(file_exists($url_file) && $mission->doc !== null)
                {
                    try {
                        unlink($url_file);
                    } catch (Exception $e) {
                        $request->session()->flash('ess-msg', "Un problème s'est produit. Merci de recommencer le processus. \n" .$e);
                        return redirect()->back();
                    }
                }

                $file = $request->file('doc');
                $filename =  $mission->id.'-'.$file->getClientOriginalName();

                $file->move(public_path('storage/'). config('global.file_mission'), $filename);

                $mission->doc = $filename;
            }

            $mission->save();
        }

        $request->session()->flash('ess-msg', "Les informations ont été mises à jour");
        return redirect()->back();
    }
}
