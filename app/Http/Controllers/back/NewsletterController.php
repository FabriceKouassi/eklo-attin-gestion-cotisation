<?php

namespace App\Http\Controllers\back;

use App\Exports\NewsLetterExport;
use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\Newsletter;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class NewsletterController extends Controller
{
    public function index()
    {
        $newsLetter = Newsletter::latest()->get();

        $company = Company::first();

        $pIndex = 'newsletter.all';
        $title = 'NewsLetter';

        $param = [
            'newsLetter' => $newsLetter,
            'pIndex' => $pIndex,
            'title' => $title,
            'company' => $company,
        ];

        return view('admin.newsLetter.all',$param);
    }

    public function showUpdateForm(int $id)
    {
        $newsLetter = NewsLetter::where('id', $id)->first();
        $company = Company::first();
        $pIndex = 'newsletter.infos';
        $title = 'NewsLetter';

        $newsLetter->save();

        $param = [
            'newsLetter' => $newsLetter,
            'pIndex' => $pIndex,
            'title' => $title,
            'company' => $company,
        ];

        return view('admin.newsLetter.infos', $param);
    }

    public function delete(Request $request, int $id)
    {
        $newsLetter = NewsLetter::where('id', $id)->first();
        if($newsLetter==null) return redirect()->back();

        $newsLetter->delete();

        $request->session()->flash('ess-msg', "Supression effectuée");
        return redirect()->back();
    }

    public function export()
    {
        return Excel::download(new NewsLetterExport, 'newsletters.csv', \Maatwebsite\Excel\Excel::CSV, [
            'Content-Type' => 'text/csv',
        ]);
    }

    public function manyDelete(Request $request)
    {
        if ($request->ids === null)
        {
            $request->session()->flash('ess-msg', "Veuillez selectionner au moins une ligne avant la suppression groupé");
            return redirect()->back();
        }

        $request->validate([
            'ids' => 'required|array',
            'ids.*' => 'exists:newsletters,id',
        ]);

        Newsletter::destroy($request->ids);
        $request->session()->flash('ess-msg', "Supression effectuée");

        return redirect()->back();
    }
}
