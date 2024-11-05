<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use App\Models\About;
use App\Models\Actualite;
use App\Models\Antenne;
use App\Models\Client;
use App\Models\Company;
use App\Models\DocteurConseil;
use App\Models\DossierMois;
use App\Models\FlashInfo;
use App\Models\LaboratoireType;
use App\Models\Mediatheque;
use App\Models\Newsletter;
use App\Models\PrestationType;
use App\Models\Referencement;
use App\Models\Slide;
use App\Models\Tarification;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class IndexController extends Controller
{
    public function index()
    {
        $pIndex = 'accueil';
        $title = 'Accueil';
        $slides = Slide::query()->where('enabled', 1)->latest()->get();
        $flashInfos = FlashInfo::query()->latest()->get();
        $antennes = Antenne::oldest('nom')->get();
        $laboratoireType = LaboratoireType::query()->with('laboratoires')->oldest()->take(3)->get();

        $about = About::first();
        $tarifications = Tarification::oldest()->get();

        $referencement = Referencement::query()->where('pageCible', 'accueil')->first();

        $actualiteFirst = Actualite::oldest()->first();

        if (!empty($actualiteFirst)) {
            $actualites = Actualite::query()->where(function ($q) use($actualiteFirst){
                return $q->where('id', '!=', $actualiteFirst->id);
            })->take(2)->get();
        }

        $docteur = DocteurConseil::first();
        $dossier = DossierMois::first();
        $mediatheque = Mediatheque::query()->latest()->first();
        $prestationType = PrestationType::query()->where('isNav', 1)->get();
        $prestationTypeSlide = PrestationType::query()->get();
        $partenaires = Client::all();
        $company = Company::first();

        $param = [
            'pIndex' => $pIndex,
            'title' => $title,
            'slides'=>$slides,
            'flashInfos'=>$flashInfos,
            'antennes'=>$antennes,
            'laboratoireType'=>$laboratoireType,
            'about'=>$about,
            'tarifications'=>$tarifications,
            'actualiteFirst'=>$actualiteFirst,
            'actualites'=>$actualites,
            'docteur'=>$docteur,
            'dossier'=>$dossier,
            'mediatheque'=>$mediatheque,
            'partenaires'=>$partenaires,
            'company'=>$company,
            'prestationType'=>$prestationType,
            'prestationTypeSlide'=>$prestationTypeSlide,
            'referencement'=>$referencement,
        ];

        return view('front.index', $param);
    }

    public function search_antenne(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'antenne' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        if ($request->antenne == null) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $antenne = Antenne::query()->where('slug', $request->antenne)->first();

        return redirect()->route('front.antenne.detail', ['slug'=>$antenne->slug]);

    }

    public function saveNewsLetter(Request $request)
    {
        if ($request->filled('honeypot')) {
            return redirect()->back();
        }
        
        $validator = Validator::make($request->all(), [
            'nom' => 'required',
            'email' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $newsletter = Newsletter::create([
            'nom' => $request->nom,
            'email' => $request->email,
        ]);

        $newsletter->save();

        Toastr::success('Consulter votre mail puis confirmer votre instruction', 'Inscription avec succès');

        return redirect()->back();
    }
}
