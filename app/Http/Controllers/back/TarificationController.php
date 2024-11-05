<?php

namespace App\Http\Controllers\back;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\Tarification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TarificationController extends Controller
{
    public function index()
    {
        $tarification = Tarification::oldest('title')->get();
        $company = Company::first();

        $pIndex = 'tarification.all';
        $title = 'Tarification';

        $param = [
            'tarification' => $tarification,

            'pIndex' => $pIndex,
            'title' => $title,
            'company' => $company,
        ];

        return view('admin.tarification.all',$param);
    }

    public function showSaveForm()
    {
        $company = Company::first();

        $pIndex = 'tarification.new';
        $title = 'Tarification';

        $param = [
            'pIndex' => $pIndex,
            'title' => $title,
            'company' => $company,

        ];

        return view('admin.tarification.new',$param);
    }

    public function saveForm(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|unique:tarifications,title',
        ]);

        if($validator->fails()){
            $request->session()->flash('ess-msg', "Le titre de la tarification est requis et dois être unique");
            return redirect()->back()->withErrors($validator)->withInput();
        };

        $tarification = Tarification::create([
            'title' => $request->title,
            'content' => $request->content,
        ]);

        $tarification->save();

        $request->session()->flash('ess-msg', "Enregistrement effectué avec succès");
        return redirect()->route('tarification.updateForm', [$tarification->id]) ;
    }

    public function showUpdateForm(int $id)
    {
        $tarification = Tarification::where('id', $id)->first();
        $company = Company::first();
        $pIndex = 'tarification.new';
        $title = 'Tarification';

        $param = [
            'tarification' => $tarification,
            'pIndex' => $pIndex,
            'title' => $title,
            'company' => $company,
        ];

        return view('admin.tarification.infos', $param);
    }

    public function updateForm(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'sometimes',
        ]);

        if($validator->fails()){
            $request->session()->flash('ess-msg', "Le titre de la tarification est requis et dois être unique");
            return redirect()->back()->withErrors($validator)->withInput();
        };

        $tarification = Tarification::where('id', $request->itemId)->first();
        if($tarification==null) return redirect()->back();

        $tarification->title = $request->title;
        $tarification->content = $request->content;

        $tarification->save();

        $request->session()->flash('ess-msg', "Modification effectuée");
        return redirect()->back();
    }

    public function delete(Request $request, int $id)
    {
        $tarification = Tarification::where('id', $id)->first();
        if($tarification==null) return redirect()->back();

        $tarification->delete();

        $request->session()->flash('ess-msg', "Supression effectuée");
        return redirect()->back();
    }
}
