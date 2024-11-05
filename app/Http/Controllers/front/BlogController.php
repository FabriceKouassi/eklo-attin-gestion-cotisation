<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Company;
use App\Models\PrestationType;
use App\Models\Referencement;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index()
    {
        $pIndex = 'blog';
        $title = 'Blog';

        $company = Company::query()->first();
        $prestationType = PrestationType::query()->where('isNav', 1)->get();
        $blog = Blog::query()->latest()->paginate(6);
        $referencement = Referencement::query()->where('pageCible', $pIndex)->first();

        $param = [
            'pIndex' => $pIndex,
            'title' => $title,
            'company' => $company,
            'prestationType' => $prestationType,
            'blog' => $blog,
            'referencement' => $referencement,
        ];

        return view('front.blog.index', $param);
    }

    public function detail(string $slug)
    {

        $pIndex = 'blog';
        $title = 'Blog';

        $company = Company::query()->first();
        $blog = Blog::query()->where('slug', $slug)->first();
        $prestationType = PrestationType::query()->where('isNav', 1)->get();
        $referencement = Referencement::query()->where('pageCible', $pIndex)->first();

        $param = [
            'pIndex' => $pIndex,
            'title' => $title,
            'company' => $company,
            'prestationType' => $prestationType,
            'blog' => $blog,
            'referencement' => $referencement,
        ];

        return view('front.blog.detail', $param);
    }
}
