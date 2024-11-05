<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\PolitiqueQualite;
use App\Models\PrestationType;
use App\Models\Referencement;
use Illuminate\Http\Request;

class PolitiqueQualiteController extends Controller
{
    public function index()
    {
        $pIndex = 'politique';
        $title = 'Politique qualité';

        $prestationType = PrestationType::query()->where('isNav', 1)->get();
        $company = Company::query()->first();
        $politique = PolitiqueQualite::query()->first();
        $referencement = Referencement::query()->where('pageCible', $pIndex)->first();

        $param = [
            'pIndex' => $pIndex,
            'title' => $title,
            'company' => $company,
            'prestationType' => $prestationType,
            'politique' => $politique,
            'referencement' => $referencement,
        ];

        return view('front.politique.index', $param);
    }
}
