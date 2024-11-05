<?php

namespace App\Http\Controllers\back;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\Prestation;
use App\Models\PrestationType;
use Carbon\Exceptions\Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PrestationController extends Controller
{
    public function index()
    {
        $prestation = Prestation::oldest()->get();
        $prestationType = PrestationType::count();

        $company = Company::first();

        $pIndex = 'prestation.all';
        $title = 'Prestations';

        $param = [
            'prestation' => $prestation,
            'prestationType' => $prestationType,
            'pIndex' => $pIndex,
            'title' => $title,
            'company' => $company,
        ];

        return view('admin.prestation.all',$param);
    }

    public function showSaveForm()
    {
        $company = Company::first();

        $prestationType = PrestationType::get();

        $pIndex = 'prestation.new';
        $title = 'Prestations';

        $param = [
            'pIndex' => $pIndex,
            'title' => $title,
            'company' => $company,
            'prestationType' => $prestationType,
        ];

        return view('admin.prestation.new',$param);
    }

    public function saveForm(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'libelle' => 'required',
            'prestationType' => 'required|numeric',
            'doc' => 'sometimes',
        ]);

        if($validator->fails()){
            // $request->session()->flash('ess-msg', "Libelle et type de prestation sont obligatoires.");
            return redirect()->back()->withErrors($validator)->withInput();
        };

        $prestation = Prestation::create([
            'libelle' => $request->libelle,
            'prestation_types_id' => $request->prestationType,
        ]);

        if($request->file('doc')){
            $file = $request->file('doc');
            $filename = $file->getClientOriginalName();

            $file->move(public_path('storage/'). config('global.file_prestation'), $filename);

            $prestation->doc = $filename;
        }

        $prestation->save();

        $request->session()->flash('ess-msg', "Enregistrment effectuée avec succès");
        return redirect()->route('prestation.updateForm', [$prestation->id]) ;
    }

    public function showUpdateForm(int $id)
    {
        $prestation = Prestation::where('id', $id)->first();
        $prestationType = PrestationType::oldest('libelle')->get();
        $company = Company::first();
        $pIndex = 'prestation.new';
        $title = 'Prestations';

        $param = [
            'prestation' => $prestation,
            'pIndex' => $pIndex,
            'title' => $title,
            'company' => $company,
            'prestationType' => $prestationType,
        ];

        return view('admin.prestation.infos', $param);
    }

    public function updateForm(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'libelle' => 'sometimes',
            'prestationType' => 'sometimes',
        ]);

        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        };

        $prestation = Prestation::where('id', $request->itemId)->first();
        if($prestation==null) return redirect()->back();

        $prestation->libelle = $request->libelle;
        $prestation->prestation_types_id = $request->prestationType;

        if($request->file('doc')){

            $file = $request->file('doc');
            $filename = $file->getClientOriginalName();

            $file->move(public_path('storage/'). config('global.file_prestation'), $filename);

            $prestation->doc = $filename;
        }

        $prestation->save();

        $request->session()->flash('ess-msg', "Modification effectuée");
        return redirect()->back();
    }

    public function delete(Request $request, int $id)
    {
        $prestation = Prestation::where('id', $id)->first();
        if($prestation==null) return redirect()->back();

        if(file_exists($prestation->doc))
        {
            try {
                unlink(public_path('storage/'.config('global.file_prestation').'/'.$prestation->doc));
            } catch (Exception $e) {
                return redirect()->back();
            }
        }

        $prestation->delete();

        $request->session()->flash('ess-msg', "Supression effectuée");
        return redirect()->back();
    }
}
