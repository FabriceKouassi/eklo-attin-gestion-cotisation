<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\DossierMois;
use App\Models\PrestationType;
use App\Models\Referencement;
use Illuminate\Http\Request;

class DossierConseilController extends Controller
{
    public function index()
    {
        $pIndex = 'dossier';
        $title = 'Dossier du mois';

        $prestationType = PrestationType::query()->where('isNav', 1)->get();
        $company = Company::query()->first();
        $dossier = DossierMois::query()->first();
        $referencement = Referencement::query()->where('pageCible', $pIndex)->first();

        $param = [
            'pIndex' => $pIndex,
            'title' => $title,
            'company' => $company,
            'dossier' => $dossier,
            'prestationType' => $prestationType,
            'referencement' => $referencement,
        ];

        return view('front.dossier.index', $param);
    }
}
