<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use App\Models\Antenne;
use App\Models\Company;
use App\Models\PrestationType;
use App\Models\Referencement;
use Illuminate\Http\Request;

class AntenneController extends Controller
{
    public function index()
    {
        $pIndex = 'antenne';
        $title = 'Antenne & Postes';
        $prestationType = PrestationType::query()->where('isNav', 1)->get();
        $antennes = Antenne::query()->oldest('nom')->paginate(6);
        $allAntennes = Antenne::query()->oldest('nom')->get();
        $company = Company::query()->first();
        $referencement = Referencement::query()->where('pageCible', $pIndex)->first();

        $param = [
            'title' => $title,
            'pIndex' => $pIndex,
            'prestationType'=>$prestationType,
            'antennes' => $antennes,
            'company' => $company,
            'allAntennes' => $allAntennes,
            'referencement' => $referencement,
        ];

        return view('front.antenne.index', $param);
    }

    public function detail(string $slug)
    {
        $pIndex = 'antenne';
        $title = 'Antenne & Postes';
        $prestationType = PrestationType::query()->where('isNav', 1)->get();
        $antenne = Antenne::query()->where('slug', $slug)->first();
        $antennes = Antenne::query()->oldest('nom')
            ->where(function ($q) use ($antenne) {
                $q->where('id', '!=', $antenne->id);
            })->get();

        $company = Company::query()->first();
        $referencement = Referencement::query()->where('pageCible', $pIndex)->first();

        $param = [
            'title' => $title,
            'pIndex' => $pIndex,
            'prestationType'=>$prestationType,
            'antenne' => $antenne,
            'antennes' => $antennes,
            'company' => $company,
            'referencement' => $referencement,
        ];

        return view('front.antenne.detail', $param);
    }

}
