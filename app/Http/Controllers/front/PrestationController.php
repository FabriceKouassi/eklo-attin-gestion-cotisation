<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\Prestation;
use App\Models\PrestationType;
use App\Models\Referencement;
use Illuminate\Http\Request;

class PrestationController extends Controller
{
    public function index()
    {
        $pIndex = 'prestationAll';
        $title = 'Prestations';
        $prestationTypes = PrestationType::query()->where('isNav', 0)->paginate(10);
        $prestationType = PrestationType::query()->where('isNav', 1)->get();
        $company = Company::query()->first();
        $referencement = Referencement::query()->where('pageCible', $pIndex)->first();

        $param = [
            'pIndex' => $pIndex,
            'title' => $title,
            'company' => $company,
            'prestationType' => $prestationType,
            'prestationTypes' => $prestationTypes,
            'referencement' => $referencement,
        ];

        return view('front.prestation.index', $param);
    }

    public function detail(string $slug)
    {
        $pIndex = 'prestation';

        $prestationType = PrestationType::query()->where('isNav', 1)->get();
        $referencement = Referencement::query()->where('pageCible', $pIndex)->first();

        $retourPrestationType = PrestationType::query()->where('slug', $slug)->first();

        $prestation = Prestation::query()
                ->where('prestation_types_id', $retourPrestationType->id)
                ->get();

        $company = Company::query()->first();

        $param = [
            'pIndex' => $pIndex,
            'company' => $company,
            'prestationType' => $prestationType,
            'prestation' => $prestation,
            'retourPrestationType' => $retourPrestationType,
            'referencement' => $referencement,
        ];

        return view('front.prestation.detail', $param);
    }

}
