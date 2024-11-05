<?php

namespace App\Http\Controllers\back;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{Company, Slide};
use Exception;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image;

class SlideController extends Controller
{
    public function index()
    {
        $slides = Slide::oldest()->get();
        $company = Company::first();

        $param = [
            "title" => "Slides",
            "pIndex" => "slide.all",
            "slides" => $slides,
            "company" => $company,
        ];

        return view('admin.slide.all', $param);
    }

    public function showSaveForm()
    {
        $company = Company::first();

        $param = [
            "title" => "Slide",
            "pIndex" => "slide.new",
            "company" => $company,
        ];

        return view('admin.slide.new', $param);
    }

    public function saveForm(Request $request)
    {

        $slide = Slide::create([
            'text' => $request->text,
            'alt' => $request->alt,
            'enabled' => $request->enabled,
        ]);

        if($request->file('img')){
            $file = $request->file('img');
            $filename = $file->getClientOriginalName();

            //$path = $file->storeAs('public/'.config('global.image_slide'), $filename);
            $file->move('storage/'.config('global.image_slide'), $filename);

            $slide->img = $filename;
        }

        $slide->save();

        $request->session()->flash('ess-msg', "Le slide à été ajouté");
        return redirect()->route('slide.updateForm', [$slide->id]) ;
    }


    public function showUpdateForm(Request $request, $itemId)
    {
        $slide = Slide::where('id', $itemId)->first();
        $company = Company::first();

        if($slide==null) return redirect()->route('slide.all');

        $param = [
          "title" => "Slide",
          "pIndex" => "slide.infos",
          "slide" => $slide,
          "company" => $company,
        ];

        return view('admin.slide.infos', $param);
    }


    public function updateForm(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'itemId' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $slide = Slide::where('id', $request->itemId)->first();
        if($slide==null) return redirect()->back();

        $slide->text = $request->text;
        $slide->alt = $request->alt;
        $slide->enabled = $request->enabled;

        if($request->file('img')){

            $url_file = public_path('storage/'.config('global.image_slide').'/'.$slide->img);

            if(file_exists($url_file && $slide->img !== null))
            {
                try {
                    unlink($url_file);
                } catch (Exception $e) {
                    $request->session()->flash('ess-msg', "Un problème s'est produit. Merci de recommencer le processus. \n" .$e);
                    return redirect()->back();
                }
            }

            $file = $request->file('img');
            $filename = $file->getClientOriginalName();
            // $file->resize(800, 600);
            $file->move('storage/'.config('global.image_slide'), $filename);

            $slide->img = $filename;
        }

        $slide->save();

        $request->session()->flash('ess-msg', "Le slide à été modifier");
        return redirect()->back();
    }

    public function delete(Request $request, int $id)
    {
        $slide = Slide::where('id', $id)->first();
        if($slide==null) return redirect()->back();

        $url_file = public_path('storage/'.config('global.image_slide').'/'.$slide->img);

        if(file_exists($url_file))
        {
            try {
                unlink($url_file);
            } catch (Exception $e) {
                $request->session()->flash('ess-msg', "Un problème s'est produit. Merci de recommencer le processus. \n" .$e);
                return redirect()->back();
            }
        }

        $slide->delete();

        $request->session()->flash('ess-msg', "Le slide à été suprimé");
        return redirect()->back();
    }
}
