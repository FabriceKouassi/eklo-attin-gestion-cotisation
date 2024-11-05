<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\PrestationType;
use App\Models\Referencement;
use App\Models\StrategiqueActivite;
use App\Models\StrategiqueAxe;
use App\Models\StrategiqueObjectif;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PlanStrategiqueController extends Controller
{
    public function index()
    {
        $pIndex = 'plan';
        $title = 'Plan Stratégique';
        $prestationType = PrestationType::query()->where('isNav', 1)->get();

        $axes = StrategiqueAxe::query()->with('objectifs.activites')->oldest('libelle')->get();

        $company = Company::query()->first();
        $referencement = Referencement::query()->where('pageCible', $pIndex)->first();

        $param = [
            'pIndex' => $pIndex,
            'title' => $title,
            'prestationType' => $prestationType,
            'company' => $company,
            'axes' => $axes,
            'referencement' => $referencement,
        ];

        return view('front.plan.index', $param);
    }
}
