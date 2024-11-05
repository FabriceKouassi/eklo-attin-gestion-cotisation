<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\Faq;
use App\Models\PrestationType;
use App\Models\Referencement;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    public function index()
    {
        $pIndex = 'faq';
        $title = 'Faq';

        $prestationType = PrestationType::query()->where('isNav', 1)->get();
        $company = Company::query()->first();
        $faqs = Faq::query()->get();
        $referencement = Referencement::query()->where('pageCible', $pIndex)->first();

        $param = [
            'pIndex' => $pIndex,
            'title' => $title,
            'company' => $company,
            'faqs' => $faqs,
            'prestationType' => $prestationType,
            'referencement' => $referencement,
        ];

        return view('front.infoUtile.faq', $param);
    }
}
