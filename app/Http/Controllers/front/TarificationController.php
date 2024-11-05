<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\PrestationType;
use App\Models\Referencement;
use App\Models\Tarification;
use Illuminate\Http\Request;

class TarificationController extends Controller
{
    public function index()
    {
        $pIndex = 'tarification';
        $title = 'Tarification';

        $company = Company::query()->first();
        $prestationType = PrestationType::query()->where('isNav', 1)->get();
        $tarifications = Tarification::query()->paginate(6);
        $referencement = Referencement::query()->where('pageCible', $pIndex)->first();

        $param = [
            'pIndex' => $pIndex,
            'title' => $title,
            'company' => $company,
            'tarifications' => $tarifications,
            'prestationType' => $prestationType,
            'referencement' => $referencement,
        ];

        return view('front.tarification.index', $param);
    }
}
