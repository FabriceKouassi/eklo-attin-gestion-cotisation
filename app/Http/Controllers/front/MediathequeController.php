<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\Mediatheque;
use App\Models\PrestationType;
use App\Models\Referencement;
use Illuminate\Http\Request;

class MediathequeController extends Controller
{
    public function index()
    {
        $pIndex = 'galerie';
        $title = 'Galerie Photos';

        $prestationType = PrestationType::query()->where('isNav', 1)->get();
        $company = Company::query()->first();
        $mediatheques = Mediatheque::query()->latest()->paginate(2);
        $referencement = Referencement::query()->where('pageCible', $pIndex)->first();

        $param = [
            'pIndex' => $pIndex,
            'title' => $title,
            'company' => $company,
            'prestationType' => $prestationType,
            'mediatheques' => $mediatheques,
            'referencement' => $referencement,
        ];

        return view('front.infoUtile.galerie', $param);
    }
}
