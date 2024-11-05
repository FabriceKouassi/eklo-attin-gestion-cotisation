<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Models\Antenne;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class AntenneController extends Controller
{
    public function index()
    {
        $antenne = Antenne::oldest('nom')->get();
        $company = Company::first();

        $pIndex = 'antenne.all';
        $title = 'Antenne';

        $param = [
            'antenne' => $antenne,

            'pIndex' => $pIndex,
            'title' => $title,
            'company' => $company,
        ];

        return view('admin.antenne.all',$param);
    }

    public function showSaveForm()
    {
        $company = Company::first();

        $pIndex = 'antenne.new';
        $title = 'Antenne';

        $param = [
            'pIndex' => $pIndex,
            'title' => $title,
            'company' => $company,

        ];

        return view('admin.antenne.new',$param);
    }

    public function saveForm(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nom' => 'required|unique:antennes,nom',
        ]);

        if($validator->fails()){
            $request->session()->flash('ess-msg', "Le nom de l'antenne est requis et dois être unique");
            return redirect()->back()->withErrors($validator)->withInput();
        };

        $antenne = Antenne::create([
            'nom' => $request->nom,
            'slug' => Str::slug($request->nom, '-'),
            'phone' => $request->phone,
            'email' => $request->email,
            'adresse' => $request->adresse,
            'map' => $request->map,
        ]);

        $antenne->save();

        $request->session()->flash('ess-msg', "Enregistrement effectué avec succès");
        return redirect()->route('antenne.updateForm', [$antenne->id]) ;
    }

    public function showUpdateForm(int $id)
    {
        $antenne = Antenne::where('id', $id)->first();
        $company = Company::first();
        $pIndex = 'antenne.new';
        $title = 'Antenne';

        $param = [
            'antenne' => $antenne,
            'pIndex' => $pIndex,
            'title' => $title,
            'company' => $company,
        ];

        return view('admin.antenne.infos', $param);
    }

    public function updateForm(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nom' => 'sometimes',
        ]);

        if($validator->fails()){
            $request->session()->flash('ess-msg', "Le nom de l'antenne est requis et dois être unique");
            return redirect()->back()->withErrors($validator)->withInput();
        };

        $antenne = Antenne::where('id', $request->itemId)->first();
        if($antenne==null) return redirect()->back();

        $antenne->nom = $request->nom;
        $antenne->slug = Str::slug($request->nom, '-');
        $antenne->email = $request->email;
        $antenne->phone = $request->phone;
        $antenne->adresse = $request->adresse;
        $antenne->map = $request->map;

        $antenne->save();

        $request->session()->flash('ess-msg', "Modification effectuée");
        return redirect()->back();
    }

    public function delete(Request $request, int $id)
    {
        $antenne = Antenne::where('id', $id)->first();
        if($antenne==null) return redirect()->back();

        $antenne->delete();

        $request->session()->flash('ess-msg', "Supression effectuée");
        return redirect()->back();
    }
}
