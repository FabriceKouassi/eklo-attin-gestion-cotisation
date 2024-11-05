<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use App\Models\About;
use App\Models\Company;
use App\Models\PrestationType;
use App\Models\Referencement;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function index()
    {
        $pIndex = 'apropos';
        $title = 'A propos';

        $company = Company::query()->first();
        $prestationType = PrestationType::query()->where('isNav', 1)->get();
        $about = About::query()->first();

        $referencement = Referencement::query()->where('pageCible', $pIndex)->first();

        $param = [
            'pIndex' => $pIndex,
            'title' => $title,
            'company' => $company,
            'about' => $about,
            'prestationType' => $prestationType,
            'referencement' => $referencement,
        ];

        return view('front.about.index', $param);
    }
}
