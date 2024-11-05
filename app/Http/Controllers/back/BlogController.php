<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Company;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class BlogController extends Controller
{
    public function index()
    {
        $blog = Blog::query()->get();

        $company = Company::first();

        $pIndex = 'blog.all';
        $title = 'Blogs';

        $param = [
            'blog' => $blog,
            'pIndex' => $pIndex,
            'title' => $title,
            'company' => $company,
        ];

        return view('admin.blog.all',$param);
    }

    public function showSaveForm()
    {
        $company = Company::first();

        $pIndex = 'blog.new';
        $title = 'Blogs';

        $param = [
            'pIndex' => $pIndex,
            'title' => $title,
            'company' => $company,
        ];

        return view('admin.blog.new',$param);
    }

    public function saveForm(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'img' => 'required',
            'content' => 'required',
        ]);

        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        };

        $blog = Blog::create([
            'title' => $request->title,
            'slug' => Str::slug($request->title, '-'),
            'content' => $request->content,
            'img_alt' => $request->img_alt,
            'doc_alt' => $request->doc_alt,
        ]);

        if($request->file('img')){
            $file = $request->file('img');
            $filename = $blog->id.'-'.$file->getClientOriginalName();

            $file->move(public_path('storage/'). config('global.image_blog'), $filename);

            $blog->img = $filename;
        }

        if($request->file('doc')){
            $file = $request->file('doc');
            $filename =  $blog->id.'-'.$file->getClientOriginalName();

            $file->move(public_path('storage/'). config('global.file_blog'), $filename);

            $blog->doc = $filename;
        }

        $blog->save();

        $request->session()->flash('ess-msg', "Enregistrment effectuée avec succès");
        return redirect()->route('blog.updateForm', [$blog->id]) ;
    }

    public function showUpdateForm(int $id)
    {
        $blog = Blog::where('id', $id)->first();
        $company = Company::first();
        $pIndex = 'blog.new';
        $title = 'Blogs';

        $param = [
            'blog' => $blog,
            'pIndex' => $pIndex,
            'title' => $title,
            'company' => $company,
        ];

        return view('admin.blog.infos', $param);
    }

    public function updateForm(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'img' => 'sometimes',
            'content' => 'required',
        ]);

        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        };

        $blog = Blog::where('id', $request->itemId)->first();
        if($blog==null) return redirect()->back();

        $blog->title = $request->title;
        $blog->slug = Str::slug($request->title, '-');
        $blog->content = $request->content;
        $blog->img_alt = $request->img_alt;
        $blog->doc_alt = $request->doc_alt;

        if($request->file('img')){
            $url_file = public_path('storage/'.config('global.image_blog').'/'.$blog->img);

            if(file_exists($url_file) && $blog->img !== null)
            {
                try {
                    unlink($url_file);
                } catch (Exception $e) {
                    $request->session()->flash('ess-msg', "Un problème se produit. Merci de recommencer le processus. \n" .$e);
                    return redirect()->back();
                }
            }

            $file = $request->file('img');
            $filename =  $blog->id.'-'.$file->getClientOriginalName();

            $file->move(public_path('storage/'). config('global.image_blog'), $filename);

            $blog->img = $filename;
        }

        if($request->file('doc')){

            $url_file = public_path('storage/'.config('global.file_blog').'/'.$blog->doc);

            if(file_exists($url_file) && $blog->doc !== null)
            {
                try {
                    unlink($url_file);
                } catch (Exception $e) {
                    $request->session()->flash('ess-msg', "Un problème s'est produit. Merci de recommencer le processus. \n" .$e);
                    return redirect()->back();
                }
            }

            $file = $request->file('doc');
            $filename =  $blog->id.'-'.$file->getClientOriginalName();

            $file->move(public_path('storage/'). config('global.file_blog'), $filename);

            $blog->doc = $filename;
        }

        $blog->save();

        $request->session()->flash('ess-msg', "Modification effectuée");
        return redirect()->back();
    }

    public function delete(Request $request, int $id)
    {
        $blog = Blog::where('id', $id)->first();
        if($blog==null) return redirect()->back();

        $url_doc = public_path('storage/'.config('global.file_blog').'/'.$blog->doc);
        $url_img = public_path('storage/'.config('global.image_blog').'/'.$blog->img);

        if(file_exists($url_img) && $blog->img !== null)
        {
            try {
                unlink($url_img);
            } catch (Exception $e) {
                $request->session()->flash('ess-msg', "Un problème se produit. Merci de recommencer le processus. \n" .$e);
                return redirect()->back();
            }
        }

        if(file_exists($url_doc) && $blog->doc !== null)
        {
            try {
                unlink($url_doc);
            } catch (Exception $e) {
                $request->session()->flash('ess-msg', "Un problème se produit. Merci de recommencer le processus. \n" .$e);
                return redirect()->back();
            }
        }

        $blog->delete();

        $request->session()->flash('ess-msg', "Supression effectuée");
        return redirect()->back();
    }
}
