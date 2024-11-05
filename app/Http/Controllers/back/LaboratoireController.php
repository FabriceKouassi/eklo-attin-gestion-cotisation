<?php

namespace App\Http\Controllers\back;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\Laboratoire;
use App\Models\LaboratoireType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class LaboratoireController extends Controller
{
    public function index()
    {
        $laboratoire = Laboratoire::query()->with('laboratoireType')->oldest('nom')->get();
        $company = Company::first();

        $pIndex = 'laboratoire.all';
        $title = 'Laboratoire';

        $param = [
            'laboratoire' => $laboratoire,

            'pIndex' => $pIndex,
            'title' => $title,
            'company' => $company,
        ];

        return view('admin.laboratoire.all',$param);
    }

    public function showSaveForm()
    {
        $company = Company::first();
        $laboratoireType = LaboratoireType::query()->latest('nom')->get();

        $pIndex = 'laboratoire.new';
        $title = 'Laboratoire';

        $param = [
            'pIndex' => $pIndex,
            'title' => $title,
            'company' => $company,
            'laboratoireType' => $laboratoireType,
        ];

        return view('admin.laboratoire.new',$param);
    }

    public function saveForm(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nom' => 'required|unique:laboratoires,nom',
        ]);

        if($validator->fails()){
            $request->session()->flash('ess-msg', "Le nom du laboratoire est requis et dois être unique");
            return redirect()->back()->withErrors($validator)->withInput();
        };

        $laboratoire = Laboratoire::create([
            'nom' => $request->nom,
            'slug' => Str::slug($request->nom, '-'),
            'description' => $request->description,
            'laboratoire_types_id' => $request->laboratoireType,
        ]);

        if($request->file('doc')){
            $file = $request->file('doc');
            $filename = $laboratoire->id . '-' . $file->getClientOriginalName();
            $file->move('storage/'.config('global.file_laboratoire'), $filename);

            $laboratoire->doc = $filename;
        }

        $laboratoire->save();

        $request->session()->flash('ess-msg', "Enregistrement effectué avec succès");
        return redirect()->route('laboratoire.updateForm', [$laboratoire->id]) ;
    }

    public function showUpdateForm(int $id)
    {
        $laboratoireType = LaboratoireType::query()->latest('nom')->get();
        $laboratoire = Laboratoire::where('id', $id)->first();
        $company = Company::first();
        $pIndex = 'laboratoire.new';
        $title = 'Laboratoire';

        $param = [
            'laboratoire' => $laboratoire,
            'pIndex' => $pIndex,
            'title' => $title,
            'company' => $company,
            'laboratoireType' => $laboratoireType,
        ];

        return view('admin.laboratoire.infos', $param);
    }

    public function updateForm(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nom' => 'sometimes',
            'icon' => 'sometimes',
            'doc' => 'sometimes',
        ]);

        if($validator->fails()){
            $request->session()->flash('ess-msg', "Le nom du laboratoire est requis et dois être unique");
            return redirect()->back()->withErrors($validator)->withInput();
        };

        $laboratoire = Laboratoire::where('id', $request->itemId)->first();
        if($laboratoire==null) return redirect()->back();

        $laboratoire->nom = $request->nom;
        $laboratoire->slug = Str::slug($request->nom, '-');
        $laboratoire->description = $request->description;
        $laboratoire->laboratoire_types_id = $request->laboratoireType;

        if($request->file('icon')){

            $url_file = public_path('storage/'.config('global.icon_laboratoire').'/'.$laboratoire->icon);

            if(file_exists($url_file))
            {
                try {
                    unlink($url_file);
                } catch (Exception $e) {
                    $request->session()->flash('ess-msg', "Un problème se produit. Merci de recommencer le processus. \n" .$e);
                    return redirect()->back();
                }
            }

            $icon = $request->file('icon');
            $filename = $icon->getClientOriginalName();

            $icon->move(public_path('storage/'). config('global.icon_laboratoire'), $filename);

            $laboratoire->icon = $filename;
        }

        if($request->file('doc')){

            $url_file = public_path('storage/'.config('global.file_laboratoire').'/'.$laboratoire->doc);

            if(file_exists($url_file) && $laboratoire->doc !== null)
            {
                try {
                    unlink($url_file);
                } catch (Exception $e) {
                    $request->session()->flash('ess-msg', "Un problème se produit. Merci de recommencer le processus. \n" .$e);
                    return redirect()->back();
                }
            }

            $file = $request->file('doc');
            $filename = $laboratoire->id . '-' . $file->getClientOriginalName();
            $file->move('storage/'.config('global.file_laboratoire'), $filename);

            $laboratoire->doc = $filename;
        }

        $laboratoire->save();

        $request->session()->flash('ess-msg', "Modification effectuée");
        return redirect()->back();
    }

    public function delete(Request $request, int $id)
    {
        $laboratoire = Laboratoire::where('id', $id)->first();
        if($laboratoire==null) return redirect()->back();

        $laboratoire->delete();

        $request->session()->flash('ess-msg', "Supression effectuée");
        return redirect()->back();
    }
}
