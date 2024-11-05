<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use App\Models\Agenda;
use App\Models\Company;
use App\Models\PrestationType;
use App\Models\Referencement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AgendaController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->query('date');

        $pIndex = 'agenda';
        $title = 'Agenda';

        $company = Company::query()->first();
        $prestationType = PrestationType::query()->where('isNav', 1)->get();
        $agendasAll = Agenda::query()
            ->oldest('eventDate')
            ->get();
        $agendas = Agenda::query()
            ->when(!is_null($query), function ($q) use ($query) {
                $q->where(DB::raw('eventDate'), $query);
            })
            ->when(is_null($query), function ($q) {
                $q->whereMonth('eventDate', now()->month);
                //$q->whereYear('eventDate', now()->year);
            })
            ->oldest('eventDate')
            ->get();


            // if ($agendas->isEmpty()) {
            //     $agendas = Agenda::query()
            //         ->whereYear('eventDate', now()->year)
            //         ->when(!is_null($query), function ($q) use ($query) {
            //             $q->where(DB::raw('eventDate'), $query);
            //         })
            //         ->oldest('eventDate')
            //         ->get();
            // }

        $referencement = Referencement::query()->where('pageCible', $pIndex)->first();

        $param = [
            'pIndex' => $pIndex,
            'title' => $title,
            'company' => $company,
            'agendas' => $agendas,
            'prestationType' => $prestationType,
            'referencement' => $referencement,
            'agendasAll' => $agendasAll
        ];

        return view('front.agenda.index', $param);
    }

    public function detail(string $slug)
    {
        $pIndex = 'agenda';
        $title = 'Agenda';
        $referencement = Referencement::query()->where('pageCible', $pIndex)->first();

        $company = Company::query()->first();
        $prestationType = PrestationType::query()->where('isNav', 1)->get();
        $agenda = Agenda::query()->where('slug', $slug)->first();

        $agendas = Agenda::query()->oldest('eventDate')
            ->where(function ($q) use ($agenda) {
                $q->where('id', '!=', $agenda->id);
            })->get();

        $param = [
            'pIndex' => $pIndex,
            'title' => $title,
            'company' => $company,
            'agenda' => $agenda,
            'agendas' => $agendas,
            'prestationType' => $prestationType,
            'referencement' => $referencement,
        ];

        return view('front.agenda.detail', $param);
    }

    public function filter(Request $request)
    {
        $pIndex = 'agenda';
        $title = 'Agenda';

        $company = Company::query()->first();
        $prestationType = PrestationType::query()->where('isNav', 1)->get();
        $referencement = Referencement::query()->where('pageCible', $pIndex)->first();

        $id = $request->agenda;

        if (empty($id)) {
            return redirect()->route('front.agenda.index');
        }

        $agenda = Agenda::query()
            ->where(function ($q) use ($id){
                $q->where('id', 'like', '%'.$id.'%')->get();
            })
            ->oldest('title')
            ->first();

        $param = [
            'pIndex' => $pIndex,
            'title' => $title,
            'company' => $company,
            'agenda' => $agenda,
            // 'agendas' => $agendas,
            'prestationType' => $prestationType,
            'referencement' => $referencement,
        ];

        return  response()->json($agenda);
        //return view('front.agenda.filter', $param);
    }
}
