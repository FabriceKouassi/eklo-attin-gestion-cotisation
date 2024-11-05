<?php

namespace App\Http\Controllers\front\API;

use App\Http\Controllers\Controller;
use App\Models\Document;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class DocumentController extends Controller
{
    public function index()
    {
        $documents = Document::all();
        return response()->json($documents);
    }
}
