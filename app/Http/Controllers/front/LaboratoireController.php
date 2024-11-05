<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\Laboratoire;
use App\Models\LaboratoireType;
use App\Models\PrestationType;
use App\Models\Referencement;
use Illuminate\Http\Request;

class LaboratoireController extends Controller
{
    public function index()
    {

    }

    public function detail(string $slugLaboType, string $slugLabo)
    {
        $pIndex = 'laboratoire';
        $title = 'Laboratoire';

        $company = Company::query()->first();
        $prestationType = PrestationType::query()->where('isNav', 1)->get();
        $referencement = Referencement::query()->where('pageCible', $pIndex)->first();

        $laboratoireType = LaboratoireType::query()->where('slug', $slugLaboType)->first();

        $laboratoire = Laboratoire::query()->where('slug', $slugLabo)->firstOrFail();

        $param = [
            'pIndex' => $pIndex,
            'title' => $title,
            'company' => $company,
            'prestationType' => $prestationType,
            'referencement' => $referencement,
            'laboratoire' => $laboratoire,
            'laboratoireType' => $laboratoireType,
        ];

        return view('front.laboratoire.detail', $param);

    }
}
