<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\LaboratoireType;
use App\Models\PrestationType;
use App\Models\Referencement;
use Illuminate\Http\Request;

class LaboratoireTypeController extends Controller
{
    public function index()
    {

    }

    public function detail(string $slug)
    {
        $pIndex = 'laboratoire';
        $title = 'Laboratoire';

        $company = Company::query()->first();
        $prestationType = PrestationType::query()->where('isNav', 1)->get();
        $referencement = Referencement::query()->where('pageCible', $pIndex)->first();

        $laboratoireType = LaboratoireType::query()->where('slug', $slug)->first();

        $param = [
            'pIndex' => $pIndex,
            'title' => $title,
            'company' => $company,
            'prestationType' => $prestationType,
            'referencement' => $referencement,
            'laboratoireType' => $laboratoireType,
        ];

        return view('front.laboratoireType.detail', $param);

    }
}
