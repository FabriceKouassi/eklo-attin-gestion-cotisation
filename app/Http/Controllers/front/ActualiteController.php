<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use App\Models\Actualite;
use App\Models\Company;
use App\Models\PrestationType;
use App\Models\Referencement;
use Illuminate\Http\Request;

class ActualiteController extends Controller
{
    public function index()
    {
        $pIndex = 'actualite';
        $title = 'Actualite';

        $company = Company::query()->first();
        $prestationType = PrestationType::query()->where('isNav', 1)->get();
        $actualite = Actualite::query()->oldest()->get();
        $referencement = Referencement::query()->where('pageCible', $pIndex)->first();

        $param = [
            'pIndex' => $pIndex,
            'title' => $title,
            'company' => $company,
            'prestationType' => $prestationType,
            'referencement' => $referencement,
            'actualite' => $actualite,
        ];

        return view('front.actualite.index', $param);
    }

    public function detail(string $slug)
    {

        $pIndex = 'actualite';
        $title = 'Actualite';

        $company = Company::query()->first();
        $actualite = Actualite::query()->where('slug', $slug)->first();
        $prestationType = PrestationType::query()->where('isNav', 1)->get();
        $referencement = Referencement::query()->where('pageCible', $pIndex)->first();

        $param = [
            'pIndex' => $pIndex,
            'title' => $title,
            'company' => $company,
            'actualite' => $actualite,
            'prestationType' => $prestationType,
            'referencement' => $referencement,
        ];

        return view('front.actualite.detail', $param);
    }
}
