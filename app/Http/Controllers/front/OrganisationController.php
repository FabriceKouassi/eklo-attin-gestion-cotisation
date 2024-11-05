<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\Organisation;
use App\Models\PrestationType;
use App\Models\Referencement;
use Illuminate\Http\Request;

class OrganisationController extends Controller
{
    public function index()
    {
        $pIndex = 'organisation';
        $title = 'Organisation';

        $company = Company::query()->first();
        $prestationType = PrestationType::query()->where('isNav', 1)->get();
        $organisation = Organisation::query()->first();
        $referencement = Referencement::query()->where('pageCible', $pIndex)->first();

        $param = [
            'pIndex' => $pIndex,
            'title' => $title,
            'company' => $company,
            'prestationType' => $prestationType,
            'organisation' => $organisation,
            'referencement' => $referencement,
        ];

        return view('front.organisation.index', $param);
    }
}
