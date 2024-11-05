<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\Directeur;
use App\Models\PrestationType;
use App\Models\Referencement;

class DirecteurController extends Controller
{
    public function index()
    {
        $pIndex = 'directeur';
        $title = 'Mot du directeur';

        $prestationType = PrestationType::query()->where('isNav', 1)->get();
        $company = Company::query()->first();
        $directeur = Directeur::query()->first();
        $referencement = Referencement::query()->where('pageCible', $pIndex)->first();

        $param = [
            'pIndex' => $pIndex,
            'title' => $title,
            'prestationType' => $prestationType,
            'company' => $company,
            'directeur' => $directeur,
            'referencement' => $referencement,
        ];

        return view('front.directeur.index', $param);
    }
}
