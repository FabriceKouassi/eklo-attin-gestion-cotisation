<?php

namespace App\Http\Controllers\back;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{Company};
use Illuminate\Support\Facades\Validator;

class CompanyController extends Controller
{
    public function showForm(Request $request)
    {
        $company = Company::first();

        $param = [
          "title" => "Tableau de bord",
          "pIndex" => "company.infos",
          "company" => $company,
        ];

        return view('admin.company.infos', $param);
    }

    //---Enregistrement ou mise à jour des des infos
    public function saveForm(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email1' => 'required|email',
            'phone1' => 'required',
            'alt' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $Company = Company::first();

        //---Creation
        if($Company==null){
            $Company = Company::create([
                'name' => $request->name,
                'slogan' => $request->slogan,
                'adress' => $request->adress,
                'phone1' => $request->phone1,
                'phone2' => $request->phone2,
                'phone3' => $request->phone3,
                'email1' => $request->email1,
                'email2' => $request->email2,
                'email3' => $request->email3,
                'facebook' => $request->facebookLink,
                'linkedin' => $request->linkedinLink,
                'twitter' => $request->twitterLink,
                'youtube' => $request->youtubeLink,
                'vision' => $request->vision,
                'alt' => $request->alt,
                'aspiration' => $request->aspiration,
                'mission' => $request->mission,
            ]);
            if($request->file('logo1')){
                $file = $request->file('logo1');
                $filename = $file->getClientOriginalName();
                $file->move(public_path('storage/'). config('global.image_logo'), $filename);

                $Company->logo1 = $filename;
            }
            if($request->file('logo2')){
                $file = $request->file('logo2');
                $filename = $file->getClientOriginalName();
                $file->move(public_path('storage/'). config('global.image_logo'), $filename);

                $Company->logo2 = $filename;
            }

            $Company->save();
        }
        //---Mise à jour
        else{
            $Company->name = $request->name;
            $Company->slogan = $request->slogan;
            $Company->adress = $request->adress;
            $Company->phone1 = $request->phone1;
            $Company->phone2 = $request->phone2;
            $Company->phone3 = $request->phone3;
            $Company->email1 = $request->email1;
            $Company->email2 = $request->email2;
            $Company->email3 = $request->email3;
            $Company->facebook = $request->facebookLink;
            $Company->linkedin = $request->linkedinLink;
            $Company->youtube = $request->youtubeLink;
            $Company->twitter = $request->twitterLink;
            $Company->vision = $request->vision;
            $Company->alt = $request->alt;
            $Company->aspiration = $request->aspiration;
            $Company->mission = $request->mission;

            if($request->file('logo1')){
                // unlink(public_path('storage/'.config('global.image_logo1').'/'.$Company->logo1));

                $file = $request->file('logo1');
                $filename = $file->getClientOriginalName();
                $file->move('storage/'.config('global.image_logo'), $filename);

                $Company->logo1 = $filename;
            }
            if($request->file('logo2')){
                // unlink(public_path('storage/'.config('global.image_logo').'/'.$Company->logo2));

                $file = $request->file('logo2');
                $filename = $file->getClientOriginalName();
                $file->move('storage/'.config('global.image_logo'), $filename);

                $Company->logo2 = $filename;
            }

            $Company->save();
        }

        $request->session()->flash('ess-msg', "Les informations ont été mises à jour");
        return redirect()->back();
    }
}
