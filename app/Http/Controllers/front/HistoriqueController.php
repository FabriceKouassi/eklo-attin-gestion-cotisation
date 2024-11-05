<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\Historique;
use App\Models\PrestationType;
use App\Models\Referencement;
use Illuminate\Http\Request;

class HistoriqueController extends Controller
{
    public function index()
    {
        $pIndex = 'historique';
        $title = 'Historique';

        $prestationType = PrestationType::query()->where('isNav', 1)->get();
        $company = Company::query()->first();
        $historique = Historique::query()->first();
        $referencement = Referencement::query()->where('pageCible', $pIndex)->first();

        $param = [
            'pIndex' => $pIndex,
            'title' => $title,
            'company' => $company,
            'prestationType' => $prestationType,
            'historique' => $historique,
            'referencement' => $referencement,
        ];

        return view('front.historique.index', $param);
    }
}
