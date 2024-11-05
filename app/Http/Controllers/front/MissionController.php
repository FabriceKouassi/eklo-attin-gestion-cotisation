<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\Mission;
use App\Models\PrestationType;
use App\Models\Referencement;
use Illuminate\Http\Request;

class MissionController extends Controller
{
    public function index()
    {
        $pIndex = 'mission';
        $title = 'Mission';

        $prestationType = PrestationType::query()->where('isNav', 1)->get();
        $company = Company::query()->first();
        $mission = Mission::query()->first();
        $referencement = Referencement::query()->where('pageCible', $pIndex)->first();

        $param = [
            'pIndex' => $pIndex,
            'title' => $title,
            'company' => $company,
            'prestationType' => $prestationType,
            'mission' => $mission,
            'referencement' => $referencement,
        ];

        return view('front.mission.index', $param);
    }
}
