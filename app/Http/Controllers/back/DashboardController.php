<?php

namespace App\Http\Controllers\back;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\Contact;
use App\Models\Document;
use App\Models\PrestationType;
use App\Models\Reclamation;
use App\Models\Tarification;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $pIndex = 'dashboard';
        $title = 'Tableau de bord';
        $company = Company::first();
        $prestationType = PrestationType::query()->get();
        $tarifications = Tarification::query()->get();
        $documents = Document::query()->get();
        $contacts = Contact::query()->where('isRead', 0)->get();
        $reclamation = Reclamation::query()->where('isRead', 0)->get();

        $param = [
            'pIndex' => $pIndex,
            'title' => $title,
            'company' => $company,
            'prestationType' => $prestationType,
            'tarifications' => $tarifications,
            'documents' => $documents,
            'contacts' => $contacts,
            'reclamation' => $reclamation,
        ];
        return view('admin.dashboard', $param);
    }
}
