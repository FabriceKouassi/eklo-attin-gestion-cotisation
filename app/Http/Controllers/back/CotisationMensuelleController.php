<?php

namespace App\Http\Controllers\back;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\CotisationMensuelle;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class CotisationMensuelleController extends Controller
{
    public function index()
    {
        $cotisationMensuelle = CotisationMensuelle::query()->with(['user', 'gestionnaire'])->latest()->get();

        $company = Company::first();

        $pIndex = 'cotisationMensuelle.all';
        $title = 'Cotisations Mensuelles';

        $param = [
            'pIndex' => $pIndex,
            'title' => $title,
            'company' => $company,
            'cotisationMensuelle' => $cotisationMensuelle,
        ];

        return view('admin.cotisationMensuelle.all',$param);
    }

    public function showSaveForm()
    {
        $company = Company::first();
        $users = User::query()->where('id', '!=', Auth::user()->id)->get();

        $pIndex = 'cotisationMensuelle.new';
        $title = 'Demandes';

        $param = [
            'pIndex' => $pIndex,
            'title' => $title,
            'company' => $company,
            'users' => $users,
        ];

        return view('admin.cotisationMensuelle.new',$param);
    }

    public function saveForm(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|integer|exists:users,id',
            'status' => 'required',
            'periods' => 'required|array|min:1',
            'periods.*' => 'string|regex:/^\d{1,2}-\d{4}$/', // Assurer le format mois-année
        ], [
            'status.required' => 'Cocher payé pour continuer le processus',
            'user_id.required' => 'L\'utilisateur est obligatoire',
            'user_id.integer' => 'Cette valeur de l\'utilisateur n\'est pas acceptée',
            'user_id.exists' => 'Cet utilisateur n\'existe pas dans le système',
            'periods.required' => 'La période est obligatoire',
            'periods.string' => 'La période doit être une chaîne de caractère',
            'periods.regex' => 'La période doit être de ce type xx-xxxx',
        ]);

        if ($validator->fails()) {
            $firstErrorMessage = $validator->errors()->first();
            $request->session()->flash('ess-msg-error', $firstErrorMessage);

            return redirect()->back()->withErrors($validator)->withInput();
        }

        $user = User::findOrFail($request->user_id);

        $cotisations = [];

        foreach ($request->periods as $period) {
            list($mois, $annee) = explode('-', $period); // Séparer le mois et l'année

            // Ajouter à la collection des cotisations
            $cotisations[] = [
                'user_id' => $user->id,
                'mois' => $mois,
                'annee' => $annee,
                'date_paiement' => Carbon::createFromDate($annee, $mois, Carbon::now()->day),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'status' => $request->status
            ];
        }

        $cotisationMensuelle = CotisationMensuelle::insert($cotisations);

        $request->session()->flash('ess-msg', "Enregistrement effectué");
        return redirect()->back();
        // return redirect()->route('cotisationMensuelle.updateForm', [$cotisationMensuelle->id]) ;
    }

    public function getNonPaidPeriodsFromRegistration(Request $request, int $userId)
    {
        // Récupérer l'utilisateur avec la relation 'fonction'
        $user = User::with('fonction')->find($userId);
    
        // Si l'utilisateur n'existe pas
        if (!$user) {
            return response()->json([], 404);
        }
    
        // Date d'inscription de l'utilisateur (en utilisant created_at)
        $registrationDate = Carbon::parse($user->created_at);
    
        // Récupérer les périodes payées à partir de la table cotisation_mensuelle
        $paidPeriods = CotisationMensuelle::query()
            ->where('user_id', $userId)
            ->whereNotNull('date_paiement')  // Assurer qu'il y a bien une date de paiement
            ->get();
    
        // Créer un tableau pour stocker les périodes non payées
        $unpaidPeriods = collect();
    
        // Tableau des périodes payées : année => mois => true
        $paidMonths = [];
        foreach ($paidPeriods as $paidPeriod) {
            // Nous utilisons l'année et le mois de la date de paiement
            $paidDate = Carbon::parse($paidPeriod->date_paiement);
            $paidMonths[$paidDate->year][$paidDate->month] = true;
        }
    
        // Définir l'année et le mois de début de la recherche à partir de la date d'inscription
        $currentYear = Carbon::now()->year;
        $startYear = $registrationDate->year;
        $startMonth = $registrationDate->month;
    
        // Boucler à partir de l'année et du mois d'inscription jusqu'à l'année actuelle
        for ($year = $startYear; $year <= $currentYear; $year++) {
            // Pour l'année d'inscription, on commence depuis le mois d'inscription
            $startMonthForYear = ($year == $startYear) ? $startMonth : 1;
    
            // Parcourir les mois de l'année
            for ($month = $startMonthForYear; $month <= 12; $month++) {
                // Vérifier si cette période a été payée ou non
                if (!isset($paidMonths[$year]) || !isset($paidMonths[$year][$month])) {
                    // Ajouter cette période comme non payée
                    $unpaidPeriods->push([
                        'mois' => $month,
                        'annee' => $year,
                        'montant' => $user->fonction->montant
                    ]);
                }
            }
        }
    
        // Retourner uniquement les périodes non payées sous forme de réponse JSON
        return response()->json($unpaidPeriods);
    }
    


}
