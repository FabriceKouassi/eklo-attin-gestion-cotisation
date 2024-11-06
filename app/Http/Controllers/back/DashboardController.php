<?php

namespace App\Http\Controllers\back;

use App\Http\Controllers\Controller;
use App\Models\Company;

class DashboardController extends Controller
{
    public function index()
    {
        $pIndex = 'dashboard';
        $title = 'Tableau de bord';
        $company = Company::first();

        $param = [
            'pIndex' => $pIndex,
            'title' => $title,
            'company' => $company,
        ];
        return view('admin.dashboard', $param);
    }
}
