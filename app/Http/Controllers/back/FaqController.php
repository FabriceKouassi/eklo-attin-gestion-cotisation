<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\Faq;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class FaqController extends Controller
{
    public function index()
    {
        $faq = Faq::latest()->get();
        $company = Company::first();

        $pIndex = 'faq.all';
        $title = 'Faq';

        $param = [
            'faq' => $faq,
            'pIndex' => $pIndex,
            'title' => $title,
            'company' => $company,
        ];

        return view('admin.faq.all',$param);
    }

    public function showSaveForm()
    {
        $company = Company::first();

        $pIndex = 'faq.new';
        $title = 'Faq';

        $param = [
            'pIndex' => $pIndex,
            'title' => $title,
            'company' => $company,

        ];

        return view('admin.faq.new',$param);
    }

    public function saveForm(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'question' => 'required|unique:faqs,question',
            'response' => 'required'
        ]);

        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        };

        $faq = Faq::create([
            'question' => $request->question,
            'response' => $request->response,
        ]);

        $faq->save();

        $request->session()->flash('ess-msg', "Enregistrement effectué avec succès");
        return redirect()->route('faq.updateForm', [$faq->id]);
    }

    public function showUpdateForm(int $id)
    {
        $faq = Faq::where('id', $id)->first();
        $company = Company::first();
        $pIndex = 'faq.new';
        $title = 'Faq';

        $param = [
            'faq' => $faq,
            'pIndex' => $pIndex,
            'title' => $title,
            'company' => $company,
        ];

        return view('admin.faq.infos', $param);
    }

    public function updateForm(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'question' => 'required',
            'response' => 'required',
        ]);
        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        };

        $faq = Faq::where('id', $request->itemId)->first();
        if($faq==null) return redirect()->back();

        $faq->question = $request->question;
        $faq->response = $request->response;

        $faq->save();

        $request->session()->flash('ess-msg', "Modification effectuée");
        return redirect()->back();
    }

    public function delete(Request $request, int $id)
    {
        $faq = Faq::where('id', $id)->first();
        if($faq==null) return redirect()->back();

        $faq->delete();

        $request->session()->flash('ess-msg', "Supression effectuée");
        return redirect()->back();
    }
}
