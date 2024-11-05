<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Models\Actualite;
use App\Models\Company;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class ActualiteController extends Controller
{
    public function index()
    {
        $actualite = Actualite::latest()->get();

        $company = Company::first();

        $pIndex = 'actualite.all';
        $title = 'Actualites';

        $param = [
            'actualite' => $actualite,
            'pIndex' => $pIndex,
            'title' => $title,
            'company' => $company,
        ];

        return view('admin.actualite.all',$param);
    }

    public function showSaveForm()
    {
        $company = Company::first();

        $pIndex = 'actualite.new';
        $title = 'Actualites';

        $param = [
            'pIndex' => $pIndex,
            'title' => $title,
            'company' => $company,
        ];

        return view('admin.actualite.new',$param);
    }

    public function saveForm(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'content' => 'required',
        ]);

        if($validator->fails()){
            // $request->session()->flash('ess-msg', "Libelle et type de actualite sont obligatoires.");
            return redirect()->back()->withErrors($validator)->withInput();
        };

        $actualite = Actualite::create([
            'title' => $request->title,
            'slug' => Str::slug($request->title, '-'),
            'content' => $request->content,
            'img_alt' => $request->img_alt,
            'doc_alt' => $request->doc_alt,
        ]);

        if($request->file('img')){
            $file = $request->file('img');
            $filename = $actualite->id.'-'.$file->getClientOriginalName();

            $file->move(public_path('storage/'). config('global.image_actualite'), $filename);

            $actualite->img = $filename;
        }
        if($request->file('doc')){
            $file = $request->file('doc');
            $filename =  $actualite->id.'-'.$file->getClientOriginalName();

            $file->move(public_path('storage/'). config('global.file_actualite'), $filename);

            $actualite->doc = $filename;
        }

        $actualite->save();

        $request->session()->flash('ess-msg', "Enregistrment effectuée avec succès");
        return redirect()->route('actualite.updateForm', [$actualite->id]) ;
    }

    public function showUpdateForm(int $id)
    {
        $actualite = Actualite::where('id', $id)->first();
        $company = Company::first();
        $pIndex = 'actualite.new';
        $title = 'Actualites';

        $param = [
            'actualite' => $actualite,
            'pIndex' => $pIndex,
            'title' => $title,
            'company' => $company,
        ];

        return view('admin.actualite.infos', $param);
    }

    public function updateForm(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'content' => 'required',
        ]);

        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        };

        $actualite = Actualite::where('id', $request->itemId)->first();
        if($actualite==null) return redirect()->back();

        $actualite->title = $request->title;
        $actualite->slug = Str::slug($request->title, '-');
        $actualite->content = $request->content;
        $actualite->img_alt = $request->img_alt;
        $actualite->doc_alt = $request->doc_alt;

        if($request->file('img')){
            $url_file = public_path('storage/'.config('global.image_actualite').'/'.$actualite->img);

            if(file_exists($url_file) && $actualite->img !== null)
            {
                try {
                    unlink($url_file);
                } catch (\Exception $e) {
                    $request->session()->flash('ess-msg', "Un problème se produit. Merci de recommencer le processus. \n" .$e->getMessage());
                    return redirect()->back();
                }
            }

            $file = $request->file('img');
            $filename =  $actualite->id.'-'.$file->getClientOriginalName();

            $file->move(public_path('storage/'). config('global.image_actualite'), $filename);

            $actualite->img = $filename;
        }
        if($request->file('doc')){

            $url_file = public_path('storage/'.config('global.file_actualite').'/'.$actualite->doc);

            if(file_exists($url_file) && $actualite->doc !== null)
            {
                try {
                    unlink($url_file);
                } catch (Exception $e) {
                    $request->session()->flash('ess-msg', "Un problème s'est produit. Merci de recommencer le processus. \n" .$e);
                    return redirect()->back();
                }
            }

            $file = $request->file('doc');
            $filename =  $actualite->id.'-'.$file->getClientOriginalName();

            $file->move(public_path('storage/'). config('global.file_actualite'), $filename);

            $actualite->doc = $filename;
        }

        $actualite->save();

        $request->session()->flash('ess-msg', "Modification effectuée");
        return redirect()->back();
    }

    public function delete(Request $request, int $id)
    {
        $actualite = Actualite::where('id', $id)->first();
        if($actualite==null) return redirect()->back();

        $url_doc = public_path('storage/'.config('global.file_actualite').'/'.$actualite->doc);
        $url_img = public_path('storage/'.config('global.image_actualite').'/'.$actualite->img);

        if(file_exists($url_img) && $actualite->img !== null)
        {
            try {
                unlink($url_img);
            } catch (Exception $e) {
                $request->session()->flash('ess-msg', "Un problème se produit. Merci de recommencer le processus. \n" .$e);
                return redirect()->back();
            }
        }
        if(file_exists($url_doc) && $actualite->doc !== null)
        {
            try {
                unlink($url_doc);
            } catch (Exception $e) {
                $request->session()->flash('ess-msg', "Un problème se produit. Merci de recommencer le processus. \n" .$e);
                return redirect()->back();
            }
        }

        $actualite->delete();

        $request->session()->flash('ess-msg', "Supression effectuée");
        return redirect()->back();
    }
}
