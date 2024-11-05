<?php

namespace App\Http\Controllers\back;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\PrestationType;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;

class PrestationTypeController extends Controller
{
    public function index()
    {
        $prestationType = PrestationType::oldest('libelle')->get();
        $company = Company::first();

        $pIndex = 'prestationType.all';
        $title = 'Type de prestations';

        $param = [
            'prestationType' => $prestationType,
            'pIndex' => $pIndex,
            'title' => $title,
            'company' => $company,
        ];

        return view('admin.prestationType.all',$param);
    }

    public function showSaveForm()
    {
        $company = Company::first();

        $pIndex = 'prestationType.new';
        $title = 'Type de prestations';

        $param = [
            'pIndex' => $pIndex,
            'title' => $title,
            'company' => $company,
        ];

        return view('admin.prestationType.new',$param);
    }

    public function saveForm(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'libelle' => 'required|unique:prestation_types,libelle'
        ]);

        if($validator->fails()){
            // dd($validator->messages());
            $request->session()->flash('ess-msg', "Le libelle est requis ou doit être unique.");
            return redirect()->back()->withErrors($validator)->withInput();
        };

        $prestationType = PrestationType::create([
            'libelle' => $request->libelle,
            'slug' => Str::slug($request->libelle, '-'),
            'description' => $request->description,
            'isNav' => (int) $request->isNav,
        ]);

        if($request->file('img')){
            $file = $request->file('img');
            $filename = $file->getClientOriginalName();
            $file->move(public_path('storage/'). config('global.image_prestationType'), $filename);

            $prestationType->img = $filename;
        }

        $prestationType->save();

        $request->session()->flash('ess-msg', "Enregistrement effectuée avec succès");
        return redirect()->route('prestationType.updateForm', [$prestationType->id]) ;
    }

    public function showUpdateForm(int $id)
    {
        $prestationType = PrestationType::where('id', $id)->first();
        $company = Company::first();
        $pIndex = 'prestationType.new';
        $title = 'Type de prestations';

        $param = [
            'prestationType' => $prestationType,
            'pIndex' => $pIndex,
            'title' => $title,
            'company' => $company,
        ];

        return view('admin.prestationType.infos', $param);
    }

    public function updateForm(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'libelle' => 'required',
        ]);

        if($validator->fails()){
            $request->session()->flash('ess-msg', "Le libelle est requis ou doit être unique.");
            return redirect()->back()->withErrors($validator)->withInput();
        };

        $prestationType = PrestationType::where('id', $request->itemId)->first();
        if($prestationType==null) return redirect()->back();

        $prestationType->libelle = $request->libelle;
        $prestationType->slug = Str::slug($request->libelle, '-');
        $prestationType->description = $request->description;
        $prestationType->isNav = (int) $request->isNav;

        if($request->file('img')){
            $url_file = public_path('storage/'.config('global.image_prestationType').'/'.$prestationType->img);

            if(file_exists($url_file) && $prestationType->img !== null)
            {
                try {
                    unlink($url_file);
                } catch (Exception $e) {
                    $request->session()->flash('ess-msg', "Un problème se produit. Merci de recommencer le processus. \n" .$e);
                    return redirect()->back();
                }
            }

            $file = $request->file('img');
            $filename =  $prestationType->id.'-'.$file->getClientOriginalName();

            $file->move(public_path('storage/'). config('global.image_prestationType'), $filename);

            $prestationType->img = $filename;
        }

        $prestationType->save();

        $request->session()->flash('ess-msg', "Modification effectuée");
        return redirect()->back();
    }

    public function delete(Request $request, int $id)
    {
        $prestationType = PrestationType::where('id', $id)->first();
        if($prestationType==null) return redirect()->back();

        $url_img = public_path('storage/'.config('global.image_prestationType').'/'.$prestationType->img);

        if(file_exists($url_img) && $prestationType->img !== null)
        {
            try {
                unlink($url_img);
            } catch (Exception $e) {
                $request->session()->flash('ess-msg', "Un problème se produit. Merci de recommencer le processus. \n" .$e);
                return redirect()->back();
            }
        }

        $prestationType->delete();

        $request->session()->flash('ess-msg', "Supression effectuée");
        return redirect()->back();
    }
}
