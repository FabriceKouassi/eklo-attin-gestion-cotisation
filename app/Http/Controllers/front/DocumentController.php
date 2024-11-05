<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\Document;
use App\Models\DocumentType;
use App\Models\PrestationType;
use App\Models\Referencement;
use App\Models\SecondDataBaseModels\Certificat;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Http;

class DocumentController extends Controller
{
    public function index(Request $request)
    {
        $pIndex = 'document';
        $title = 'Documents';

        $company = Company::query()->first();
        $prestationType = PrestationType::query()->where('isNav', 1)->get();
        $referencement = Referencement::query()->where('pageCible', $pIndex)->first();

        $documentType = DocumentType::query()->oldest('libelle')->get();

        $search = $request->query('certificat', 'all');
        $searchTypeCertificatSigne = $request->query('type-de-certificat');

        $dType = DocumentType::query()->where('slug', $search)->first();

        if ($search !== 'certificat-distant-signe') {

            $document = Document::query()
                ->when(($search !== 'all'), function ($q) use ($dType) {
                    $q->where('document_types_id', $dType?->id);
                })
                ->latest()
                ->get();


                $certificats_signes = [];

            if ($search === 'certificat-distant-signe' || $search === 'all') {
                $certificats_signes = Certificat::query()->where('statut', 'signé');

                if (!is_null($searchTypeCertificatSigne)) {
                    $certificats_signes = $certificats_signes->whereHas('demandeCertificat.typeCertificat', function (Builder $query) use ($searchTypeCertificatSigne) {
                        $query->where('libelle', 'like', '%'.$searchTypeCertificatSigne.'%');
                    });
                }

                $certificats_signes = $certificats_signes->latest()->get();
            }

            $combinedData = $document->merge($certificats_signes);

        } else {

            $document = [];
            $certificats_signes = [];

            if ($search === 'certificat-distant-signe' || $search === 'all' ) {
                $certificats_signes = Certificat::query()->where('statut', 'signé');

                if (!is_null($searchTypeCertificatSigne) && $searchTypeCertificatSigne !== 'all') {
                    $certificats_signes = $certificats_signes->whereHas('demandeCertificat.typeCertificat', function (Builder $query) use ($searchTypeCertificatSigne) {
                        $query->where('libelle', 'like', '%'.$searchTypeCertificatSigne.'%');
                    });
                }
                $certificats_signes = $certificats_signes->latest()->get();
            }

            $combinedData = $certificats_signes->merge([]);

        }

        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $perPage = 9; // Nombre d'éléments par page
        $pagedData = $combinedData->slice(($currentPage - 1) * $perPage, $perPage)->all();
        $combinedData = new LengthAwarePaginator($pagedData, $combinedData->count(), $perPage, $currentPage, [
            'path' => LengthAwarePaginator::resolveCurrentPath(), // Garder le chemin actuel
            'pageName' => 'page', // Nom du paramètre de pagination dans l'URL
            'query' => $request->query()
        ]);

        $type_certificats_signes = Certificat::query()
            ->where('certificats.statut', 'signé')
            ->whereHas('demandeCertificat.typeCertificat')
            ->with('demandeCertificat.typeCertificat') // Charge les relations nécessaires
            ->selectRaw('type_certificats.libelle')
            ->join('demande_certificats', 'certificats.demande_certificat_id', '=', 'demande_certificats.id')
            ->join('type_certificats', 'demande_certificats.type_certificat_id', '=', 'type_certificats.id')
            ->groupBy('type_certificats.libelle')
            ->get();


        $param = [
            'pIndex' => $pIndex,
            'title' => $title,
            'company' => $company,
            'document' => $document,
            'documentType' => $documentType,
            'prestationType' => $prestationType,
            'referencement' => $referencement,
            'certificats_signes' => $certificats_signes,
            'type_certificats_signes' => $type_certificats_signes,
            'data' => $combinedData,
        ];

        return view('front.document.index', $param);
    }

    public function filter(Request $request)
    {
        $search = $request->input('keyword');

        if($search == null)
        {
            return redirect()->route('front.document.index');
        }

        $pIndex = 'document';
        $title = 'Documents';

        $type_certificats_signes = Certificat::query()
            ->where('certificats.statut', 'signé')
            ->whereHas('demandeCertificat.typeCertificat')
            ->with('demandeCertificat.typeCertificat') // Charge les relations nécessaires
            ->selectRaw('type_certificats.libelle')
            ->join('demande_certificats', 'certificats.demande_certificat_id', '=', 'demande_certificats.id')
            ->join('type_certificats', 'demande_certificats.type_certificat_id', '=', 'type_certificats.id')
            ->groupBy('type_certificats.libelle')
            ->get();

        $allDocuments = Document::query()->oldest('title')->get();
        $prestationType = PrestationType::query()->get();
        $company = Company::query()->first();
        $documentType = DocumentType::query()->oldest('libelle')->get();



        $referencement = Referencement::query()->where('pageCible', $pIndex)->first();

        $results = Document::query()
            ->where(function ($q) use ($search){
                $q->where('title', 'like', '%'.$search.'%');
            })
            ->oldest('title');

            if($results->count() !== 0) {
                $results = $results->get();
            } else {
                $certif_dis = Certificat::query()->where('statut', 'signé')
                    ->where(function ($q) use ($search){
                        $q->where('numero_reference', 'like', '%'.$search.'%');
                        $q->orWhere('statut', 'like', '%'.$search.'%');
                        $q->orWhereHas('demandeCertificat.typeCertificat', function($query) use ($search) {
                            $query->where('libelle', 'like', '%'.$search.'%');
                        });
                        $q->orWhereHas('demandeCertificat.etablissement', function($query) use ($search) {
                            $query->where('nom', 'like', '%'.$search.'%');
                            $query->orWhere('ville_commune', 'like', '%'.$search.'%');
                            $query->orWhere('quartier', 'like', '%'.$search.'%');
                            $query->orWhere('adresse', 'like', '%'.$search.'%');
                        });
                    })
                    ->oldest()->get();

            }

        $param = [
            'pIndex' => $pIndex,
            'title' => $title,
            'search' => $search ?? '',
            'company' => $company,
            'results' => $results,
            'certif_dis' => $certif_dis ?? [],
            'prestationType' => $prestationType,
            'allDocuments' => $allDocuments,
            'referencement' => $referencement,
            'type_certificats_signes' => $type_certificats_signes,
            'documentType' => $documentType,
        ];

        return view('front.document.search', $param);
    }
}
