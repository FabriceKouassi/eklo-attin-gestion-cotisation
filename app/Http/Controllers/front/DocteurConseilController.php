<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\DocteurConseil;
use App\Models\PrestationType;
use App\Models\Referencement;
use Illuminate\Http\Request;

class DocteurConseilController extends Controller
{
    public function index()
    {
        $pIndex = 'docteur';
        $title = 'Docteur Conseil';

        $prestationType = PrestationType::query()->where('isNav', 1)->get();
        $company = Company::query()->first();
        $docteur = DocteurConseil::query()->first();
        $referencement = Referencement::query()->where('pageCible', $pIndex)->first();

        $param = [
            'pIndex' => $pIndex,
            'title' => $title,
            'company' => $company,
            'docteur' => $docteur,
            'prestationType' => $prestationType,
            'referencement' => $referencement,
        ];

        return view('front.docteur.index', $param);
    }
}
