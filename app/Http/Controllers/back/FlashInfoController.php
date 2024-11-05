<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\FlashInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class FlashInfoController extends Controller
{
    public function index()
    {
        $flashInfo = FlashInfo::latest()->get();
        $company = Company::first();

        $pIndex = 'flashInfo.all';
        $title = 'Flash Info';

        $param = [
            'flashInfo' => $flashInfo,
            'pIndex' => $pIndex,
            'title' => $title,
            'company' => $company,
        ];

        return view('admin.flashInfo.all',$param);
    }

    public function showSaveForm()
    {
        $company = Company::first();

        $pIndex = 'flashInfo.new';
        $title = 'Flash Info';

        $param = [
            'pIndex' => $pIndex,
            'title' => $title,
            'company' => $company,
        ];

        return view('admin.flashInfo.new',$param);
    }

    public function saveForm(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'content' => 'required|unique:flash_infos,content'
        ]);

        if($validator->fails()){
            // dd($validator->messages());
            $request->session()->flash('ess-msg', "Le contenu est requis ou doit être unique.");
            return redirect()->back()->withErrors($validator)->withInput();
        };

        $flashInfo = FlashInfo::create([
            'content' => $request->content,
        ]);

        $flashInfo->save();

        $request->session()->flash('ess-msg', "Enregistrement effectuée avec succès");
        return redirect()->route('flashInfo.all', [$flashInfo->id]) ;
    }

    public function showUpdateForm(int $id)
    {
        $flashInfo = FlashInfo::where('id', $id)->first();
        $company = Company::first();
        $pIndex = 'flashInfo.new';
        $title = 'Flash Info';

        $param = [
            'flashInfo' => $flashInfo,
            'pIndex' => $pIndex,
            'title' => $title,
            'company' => $company,
        ];

        return view('admin.flashInfo.infos', $param);
    }

    public function updateForm(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'content' => 'required|unique:flash_infos,content',
        ]);

        if($validator->fails()){
            $request->session()->flash('ess-msg', "Le contenu est requis ou doit être unique.");
            return redirect()->back()->withErrors($validator)->withInput();
        };

        $flashInfo = FlashInfo::where('id', $request->itemId)->first();
        if($flashInfo==null) return redirect()->back();

        $flashInfo->content = $request->content;

        $flashInfo->save();

        $request->session()->flash('ess-msg', "Modification effectuée");
        return redirect()->back();
    }

    public function delete(Request $request, int $id)
    {
        $flashInfo = FlashInfo::where('id', $id)->first();
        if($flashInfo==null) return redirect()->back();

        $flashInfo->delete();

        $request->session()->flash('ess-msg', "Supression effectuée");
        return redirect()->back();
    }
}
