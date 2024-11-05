<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\Mediatheque;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MediathequeController extends Controller
{
    public function index()
    {
        $mediatheque = Mediatheque::latest()->get();

        $company = Company::first();

        $pIndex = 'mediatheque.all';
        $title = 'Mediatheques';

        $param = [
            'mediatheque' => $mediatheque,
            'pIndex' => $pIndex,
            'title' => $title,
            'company' => $company,
        ];

        return view('admin.mediatheque.all',$param);
    }

    public function showSaveForm()
    {
        $company = Company::first();

        $pIndex = 'mediatheque.new';
        $title = 'Mediatheques';

        $param = [
            'pIndex' => $pIndex,
            'title' => $title,
            'company' => $company,
        ];

        return view('admin.mediatheque.new',$param);
    }

    public function saveForm(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
        ]);

        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        };

        $mediatheque = Mediatheque::create([
            'title' => $request->title,
            'content' => $request->content,
        ]);

        $imageItem = [];

        $files = $request->file('imgs');

        if ($files) {
            foreach ($files as $key => $file) {

                $filename = $mediatheque->id. '-' . $key . '-' . $file->getClientOriginalName();

                $file->move(public_path('storage/'). config('global.image_mediatheque'), $filename);

                array_push($imageItem,$filename);
            }
        }

        $mediatheque->imgs = json_encode($imageItem);
        $mediatheque->save();

        $request->session()->flash('ess-msg', "Enregistrment effectuée avec succès");
        return redirect()->route('mediatheque.updateForm', [$mediatheque->id]) ;
    }

    public function showUpdateForm(int $id)
    {
        $mediatheque = Mediatheque::where('id', $id)->first();
        $company = Company::first();
        $pIndex = 'mediatheque.new';
        $title = 'Mediatheques';

        $param = [
            'mediatheque' => $mediatheque,
            'pIndex' => $pIndex,
            'title' => $title,
            'company' => $company,
        ];

        return view('admin.mediatheque.infos', $param);
    }

    public function updateForm(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'imgs' => 'sometimes'
        ]);

        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        };

        $mediatheque = Mediatheque::where('id', $request->itemId)->first();
        if($mediatheque==null) return redirect()->back();

        $mediatheque->title = $request->title;
        $mediatheque->content = $request->content;

        $imageItem = json_decode($mediatheque->imgs, true) ?? [];

        $files = $request->file('imgs');

        if ($files) {
            foreach ($files as $key => $file) {

                $filename = $mediatheque->id. '-' . $key . '-' . $file->getClientOriginalName();

                $file->move(public_path('storage/'). config('global.image_mediatheque'), $filename);

                array_push($imageItem,$filename);
            }
            $mediatheque->imgs = json_encode($imageItem);
        }

        $mediatheque->save();

        $request->session()->flash('ess-msg', "Modification effectuée");
        return redirect()->back();
    }

    public function delete(Request $request, int $id)
    {
        $mediatheque = Mediatheque::where('id', $id)->first();
        if($mediatheque==null) return redirect()->back();

        $dbImgs = json_decode($mediatheque->imgs);

        foreach ($dbImgs as $dbImg) {
            $url_file = public_path('storage/'.config('global.image_mediatheque').'/'.$dbImg);
            if(file_exists($url_file))
            {
                try {
                    unlink($url_file);
                } catch (Exception $e) {
                    $request->session()->flash('ess-msg', "Un problème se produit. Merci de recommencer le processus. \n" .$e);
                    return redirect()->back();
                }
            }
        }

        $mediatheque->delete();

        $request->session()->flash('ess-msg', "Supression effectuée");
        return redirect()->back();
    }
    
    public function deleteFile(Request $request, int $id, int $key)
    {

        $mediatheque = Mediatheque::where('id', $id)->first();
        if($mediatheque==null) return redirect()->back();

        $dbImgs = json_decode($mediatheque->imgs);

        foreach ($dbImgs as $k => $dbImg) {
            $url_file = public_path('storage/'.config('global.image_mediatheque').'/'.$dbImg);
            if(file_exists($url_file) && (int) $k === $key)
            {
                try {
                    unlink($url_file);
                } catch (Exception $e) {
                    $request->session()->flash('ess-msg', "Un problème se produit. Merci de recommencer le processus. \n" .$e);
                    return redirect()->back();
                }
            }
        }

        unset($dbImgs[$key]);
        $dbImgs = array_values($dbImgs);
        
        $mediatheque->imgs = json_encode($dbImgs);
        $mediatheque->save();

        $request->session()->flash('ess-msg', "Supression de l'image effectuée");
        return redirect()->back();
    }
}
