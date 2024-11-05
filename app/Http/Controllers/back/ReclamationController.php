<?php

namespace App\Http\Controllers\back;

use App\Http\Controllers\Controller;
use App\Mail\ReclamationMail;
use App\Models\Company;
use App\Models\Reclamation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class ReclamationController extends Controller
{
    public function index()
    {
        $reclamations = Reclamation::latest()->get();

        $company = Company::first();

        $pIndex = 'reclamation.all';
        $title = 'Reclamation';

        $param = [
            'reclamations' => $reclamations,
            'pIndex' => $pIndex,
            'title' => $title,
            'company' => $company,
        ];

        return view('admin.reclamation.all',$param);
    }

    public function showUpdateForm(int $id)
    {
        $reclamation = Reclamation::where('id', $id)->first();
        $company = Company::first();
        $pIndex = 'reclamation.infos';
        $title = 'Reclamation';

        $reclamation->isRead = 1;

        $reclamation->save();

        $param = [
            'reclamation' => $reclamation,
            'pIndex' => $pIndex,
            'title' => $title,
            'company' => $company,
        ];

        return view('admin.reclamation.infos', $param);
    }

    public function updateForm(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'reponse' => 'required',
        ]);

        if($validator->fails()){
            $request->session()->flash('ess-msg', "La réponse est obligatoire");
            return redirect()->back()->withErrors($validator)->withInput();
        };

        $reclamation = Reclamation::where('id', $request->itemId)->first();

        if($reclamation==null) return redirect()->back();

        $reclamation->reponse = $request->reponse;

        $reclamation->save();

        $company = Company::query()->first();
        if($company==null) return redirect()->back();

        try {
            Mail::to($reclamation->email)->send(new ReclamationMail($reclamation, $company));
        } catch (\Exception $e) {
            $request->session()->flash('ess-msg', "Erreur lors de l'envoi de la réponse par mail". $e);
            return redirect()->back();
        }

        $request->session()->flash('ess-msg', "Modification effectuée");
        return redirect()->back();
    }

    public function delete(Request $request, int $id)
    {
        $reclamation = Reclamation::where('id', $id)->first();
        if($reclamation==null) return redirect()->back();

        $reclamation->delete();

        $request->session()->flash('ess-msg', "Supression effectuée");
        return redirect()->back();
    }

    public function manyDelete(Request $request)
    {
        if ($request->ids === null)
        {
            $request->session()->flash('ess-msg', "Veuillez selectionner au moins une ligne avant la suppression groupé");
            return redirect()->back();
        }

        $request->validate([
            'ids' => 'required|array',
            'ids.*' => 'exists:reclamations,id',
        ]);
    
        Reclamation::destroy($request->ids);
        $request->session()->flash('ess-msg', "Supression effectuée");

        return redirect()->back();
    }
}
