<?php

namespace App\Http\Controllers\back;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Models\{Client, Company};
use Exception;
use Illuminate\Support\Facades\Validator;


class ClientController extends Controller
{
    /**
     *  Ce controller est dédié uniquement a l'enregestrement des partenaires de l'INHP
    */

    public function index()
    {
        $client = Client::oldest('name')->get();
        $company = Company::first();

        $param = [
            "title" => "Partenaires",
            "pIndex" => "client.all",
            "client" => $client,
            "company" => $company
        ];

        return view('admin.client.all', $param);
    }


    public function showSaveForm()
    {
        $company = Company::first();

        $param = [
          "title" => "Nouveau Partenaires",
          "pIndex" => "client.all",
          "company" => $company,
        ];

        return view('admin.client.new', $param);
    }

     public function saveForm(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'alt' => 'required',
            // 'isPartener' => 'required',
            'img' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $client = Client::create([
            'name' => $request->name,
            'link' => $request->link,
            'alt' => $request->alt,
            // 'isPartener' => $request->isPartener,
        ]);

        if($request->file('img')){
            $file = $request->file('img');
            $filename = $client->id . '-' . $file->getClientOriginalName();
            //$path = $file->storeAs('public/'.config('global.image_client'), $filename); //In production
            $file->move(public_path('storage/').config('global.image_client'), $filename);

            $client->img = $filename;
        }

        $client->save();

        $request->session()->flash('ess-msg', "Le partenaire à été ajouté");
        return redirect()->route('client.updateForm', [$client->id]);
    }


    public function showUpdateForm(int $id)
    {
        $client = Client::where('id', $id)->first();
        $company = Company::first();
        if($client == null) return redirect()->route('admin.client.all');

        $param = [
          "title" => "Nos Partenaires",
          "pIndex" => "client.infos",
          "client" => $client,
          "company" => $company,
        ];

        return view('admin.client.infos', $param);
    }


    public function updateForm(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'alt' => 'required',
            // 'isPartener' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $client = Client::where('id', $request->clientId)->first();
        if($client==null) return redirect()->back();

        $client->name = $request->name;
        $client->link = $request->link;
        $client->alt = $request->alt;
        // $client->isPartener = $request->isPartener;

        if($request->file('img')){

            $url_file = public_path('storage/'.config('global.image_client').'/'.$client->img);

            if(file_exists($url_file) && $client->img !== null)
            {
                try {
                    unlink($url_file);
                } catch (Exception $e) {
                    $request->session()->flash('ess-msg', "Un problème s'est produit. Merci de recommencer le processus. \n" .$e);
                    return redirect()->back();
                }
            }

            $file = $request->file('img');
            $filename = $client->id . '-' . $file->getClientOriginalName();

            $file->move(public_path('storage/').config('global.image_client'), $filename);

            $client->img = $filename;
        }

        $client->save();

        $request->session()->flash('ess-msg', "Modification effectuée");
        return redirect()->back();
    }


    public function delete(Request $request, int $id)
    {
        $client = Client::where('id', $id)->first();
        if($client==null) return redirect()->back();

        $url_file = public_path('storage/'.config('global.image_client').'/'.$client->img);

        if(file_exists($url_file) && $client->img !== null)
        {
            try {
                unlink($url_file);
            } catch (Exception $e) {
                $request->session()->flash('ess-msg', "Un problème s'est produit. Merci de recommencer le processus. \n" .$e);
                return redirect()->back();
            }
        }

        $client->delete();

        $request->session()->flash('ess-msg', "Le partenaire à été suprimé");
        return redirect()->back();
    }
}
