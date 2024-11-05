<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\LaboratoireType;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class LaboratoireTypeController extends Controller
{
    public function index()
    {
        $laboratoireType = LaboratoireType::oldest('nom')->get();
        $company = Company::first();

        $pIndex = 'laboratoireType.all';
        $title = 'Type de laboratoire';

        $param = [
            'laboratoireType' => $laboratoireType,

            'pIndex' => $pIndex,
            'title' => $title,
            'company' => $company,
        ];

        return view('admin.laboratoireType.all',$param);
    }

    public function showSaveForm()
    {
        $company = Company::first();

        $pIndex = 'laboratoireType.new';
        $title = 'Type de laboratoire';

        $param = [
            'pIndex' => $pIndex,
            'title' => $title,
            'company' => $company,

        ];

        return view('admin.laboratoireType.new',$param);
    }

    public function saveForm(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nom' => 'required|unique:laboratoires,nom',
        ]);

        if($validator->fails()){
            $request->session()->flash('ess-msg', "Le type du laboratoire est requis et dois être unique");
            return redirect()->back()->withErrors($validator)->withInput();
        };

        $laboratoireType = LaboratoireType::create([
            'nom' => $request->nom,
            'slug' => Str::slug($request->nom, '-'),
            'description' => $request->description,
        ]);

        if($request->file('icon')){
            $icon = $request->file('icon');
            $filename = $icon->getClientOriginalName();

            $icon->move(public_path('storage/'). config('global.icon_laboratoire'), $filename);

            $laboratoireType->icon = $filename;
        }

        if($request->file('doc')){
            $file = $request->file('doc');
            $filename = $laboratoireType->id . '-' . $file->getClientOriginalName();
            $file->move('storage/'.config('global.file_laboratoireType'), $filename);

            $laboratoireType->doc = $filename;
        }

        $laboratoireType->save();

        $request->session()->flash('ess-msg', "Enregistrement effectué avec succès");
        return redirect()->route('laboratoireType.updateForm', [$laboratoireType->id]) ;
    }

    public function showUpdateForm(int $id)
    {
        $laboratoireType = LaboratoireType::where('id', $id)->first();
        $company = Company::first();
        $pIndex = 'laboratoireType.new';
        $title = 'Type de laboratoire';

        $param = [
            'laboratoireType' => $laboratoireType,
            'pIndex' => $pIndex,
            'title' => $title,
            'company' => $company,
        ];

        return view('admin.laboratoireType.infos', $param);
    }

    public function updateForm(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nom' => 'sometimes',
            'icon' => 'sometimes',
            'doc' => 'sometimes',
        ]);

        if($validator->fails()){
            $request->session()->flash('ess-msg', "Le type du laboratoire est requis et dois être unique");
            return redirect()->back()->withErrors($validator)->withInput();
        };

        $laboratoireType = LaboratoireType::where('id', $request->itemId)->first();
        if($laboratoireType==null) return redirect()->back();

        $laboratoireType->nom = $request->nom;
        $laboratoireType->slug = Str::slug($request->nom, '-');
        $laboratoireType->description = $request->description;

        if($request->file('icon')){

            $url_file = public_path('storage/'.config('global.icon_laboratoire').'/'.$laboratoireType->icon);

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

            $laboratoireType->icon = $filename;
        }

        if($request->file('doc')){

            $url_file = public_path('storage/'.config('global.file_laboratoireType').'/'.$laboratoireType->doc);

            if(file_exists($url_file) && $laboratoireType->doc !== null)
            {
                try {
                    unlink($url_file);
                } catch (Exception $e) {
                    $request->session()->flash('ess-msg', "Un problème se produit. Merci de recommencer le processus. \n" .$e);
                    return redirect()->back();
                }
            }

            $file = $request->file('doc');
            $filename = $laboratoireType->id . '-' . $file->getClientOriginalName();
            $file->move('storage/'.config('global.file_laboratoireType'), $filename);

            $laboratoireType->doc = $filename;
        }

        $laboratoireType->save();

        $request->session()->flash('ess-msg', "Modification effectuée");
        return redirect()->back();
    }

    public function delete(Request $request, int $id)
    {
        $laboratoireType = LaboratoireType::where('id', $id)->first();
        if($laboratoireType==null) return redirect()->back();

        $laboratoireType->delete();

        $request->session()->flash('ess-msg', "Supression effectuée");
        return redirect()->back();
    }
}
