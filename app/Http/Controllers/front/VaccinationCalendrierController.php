<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\PrestationType;
use App\Models\Referencement;
use App\Models\VaccinationCalendrier;
use App\Models\VaccinFamille;
use Illuminate\Http\Request;

class VaccinationCalendrierController extends Controller
{
    public function index()
    {
        $pIndex = 'calendrier';
        $title = 'Calendrier de vaccination';

        $prestationType = PrestationType::query()->where('isNav', 1)->get();
        $company = Company::query()->first();
        $calendrier = VaccinFamille::query()->with('vaccinationCalendriers')->get();
        $referencement = Referencement::query()->where('pageCible', $pIndex)->first();

        $param = [
            'pIndex' => $pIndex,
            'title' => $title,
            'company' => $company,
            'prestationType' => $prestationType,
            'calendrier' => $calendrier,
            'referencement' => $referencement,
        ];

        return view('front.infoUtile.calendrier', $param);
    }
}
