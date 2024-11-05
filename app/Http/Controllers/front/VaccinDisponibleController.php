<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\PrestationType;
use App\Models\Referencement;
use App\Models\VaccinDisponible;
use App\Models\VaccinFamille;
use Illuminate\Http\Request;

class VaccinDisponibleController extends Controller
{
    public function index()
    {
        $pIndex = 'vaccin';
        $title = 'Vaccin disponible';

        $prestationType = PrestationType::query()->where('isNav', 1)->get();
        $company = Company::query()->first();

        $vaccin = VaccinFamille::query()->with(['vaccinsDisponibles'])->get();
        $referencement = Referencement::query()->where('pageCible', $pIndex)->first();

        $param = [
            'pIndex' => $pIndex,
            'title' => $title,
            'prestationType' => $prestationType,
            'vaccin' => $vaccin,
            'company' => $company,
            'referencement' => $referencement,
        ];

        return view('front.infoUtile.vaccin', $param);
    }
}
