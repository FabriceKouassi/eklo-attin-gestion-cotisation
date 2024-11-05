<?php

namespace App\Http\Controllers\back;

use App\Http\Controllers\Controller;
use App\Models\Agenda;
use App\Models\Company;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class AgendaController extends Controller
{
    public function index()
    {
        $agenda = Agenda::oldest()->get();

        $company = Company::first();

        $pIndex = 'agenda.all';
        $title = 'Agenda';

        $param = [
            'agenda' => $agenda,
            'pIndex' => $pIndex,
            'title' => $title,
            'company' => $company,
        ];

        return view('admin.agenda.all',$param);
    }

    public function showSaveForm()
    {
        $company = Company::first();

        $pIndex = 'agenda.new';
        $title = 'Agenda';

        $param = [
            'pIndex' => $pIndex,
            'title' => $title,
            'company' => $company,
        ];

        return view('admin.agenda.new',$param);
    }

    public function saveForm(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
        ]);

        if($validator->fails()){
            // $request->session()->flash('ess-msg', "Libelle et type de agenda sont obligatoires.");
            return redirect()->back()->withErrors($validator)->withInput();
        };

        $agenda = Agenda::create([
            'title' => $request->title,
            'slug' => Str::slug($request->title, '-'),
            'content' => $request->content,
            'location' => $request->location,
            'eventDate' => $request->eventDate,
            'eventHour' => $request->eventHour,
        ]);

        if($request->file('img')){
            $file = $request->file('img');
            $filename = $agenda->id.'-'.$file->getClientOriginalName();

            $file->move(public_path('storage/'). config('global.image_agenda'), $filename);

            $agenda->img = $filename;
        }
        if($request->file('doc')){
            $file = $request->file('doc');
            $filename =  $agenda->id.'-'.$file->getClientOriginalName();

            $file->move(public_path('storage/'). config('global.file_agenda'), $filename);

            $agenda->doc = $filename;
        }

        $agenda->save();

        $request->session()->flash('ess-msg', "Enregistrment effectuée avec succès");
        return redirect()->route('agenda.updateForm', [$agenda->id]) ;
    }

    public function showUpdateForm(int $id)
    {
        $agenda = Agenda::where('id', $id)->first();
        $company = Company::first();
        $pIndex = 'agenda.new';
        $title = 'Agenda';

        $param = [
            'agenda' => $agenda,
            'pIndex' => $pIndex,
            'title' => $title,
            'company' => $company,
        ];

        return view('admin.agenda.infos', $param);
    }

    public function updateForm(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'content' => 'required',
        ]);

        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        };

        $agenda = Agenda::where('id', $request->itemId)->first();
        if($agenda==null) return redirect()->back();

        $agenda->title = $request->title;
        $agenda->slug = Str::slug($request->title, '-');
        $agenda->content = $request->content;
        $agenda->location = $request->location;
        $agenda->eventDate = $request->eventDate;
        $agenda->eventHour = $request->eventHour;

        if($request->file('img')){
            $url_file = public_path('storage/'.config('global.image_agenda').'/'.$agenda->img);

            if(file_exists($url_file) && $agenda->img !== null)
            {
                try {
                    unlink($url_file);
                } catch (Exception $e) {
                    $request->session()->flash('ess-msg', "Un problème se produit. Merci de recommencer le processus. \n" .$e);
                    return redirect()->back();
                }
            }

            $file = $request->file('img');
            $filename =  $agenda->id.'-'.$file->getClientOriginalName();

            $file->move(public_path('storage/'). config('global.image_agenda'), $filename);

            $agenda->img = $filename;
        }
        if($request->file('doc')){

            $url_file = public_path('storage/'.config('global.file_agenda').'/'.$agenda->doc);

            if(file_exists($url_file) && $agenda->doc !== null)
            {
                try {
                    unlink($url_file);
                } catch (Exception $e) {
                    $request->session()->flash('ess-msg', "Un problème s'est produit. Merci de recommencer le processus. \n" .$e);
                    return redirect()->back();
                }
            }

            $file = $request->file('doc');
            $filename =  $agenda->id.'-'.$file->getClientOriginalName();

            $file->move(public_path('storage/'). config('global.file_agenda'), $filename);

            $agenda->doc = $filename;
        }

        $agenda->save();

        $request->session()->flash('ess-msg', "Modification effectuée");
        return redirect()->back();
    }

    public function delete(Request $request, int $id)
    {
        $agenda = Agenda::where('id', $id)->first();
        if($agenda==null) return redirect()->back();

        $url_doc = public_path('storage/'.config('global.file_agenda').'/'.$agenda->doc);
        $url_img = public_path('storage/'.config('global.image_agenda').'/'.$agenda->img);

        if(file_exists($url_img) && $agenda->img !== null)
        {
            try {
                unlink($url_img);
            } catch (Exception $e) {
                $request->session()->flash('ess-msg', "Un problème se produit. Merci de recommencer le processus. \n" .$e);
                return redirect()->back();
            }
        }
        if(file_exists($url_doc) && $agenda->doc !== null)
        {
            try {
                unlink($url_doc);
            } catch (Exception $e) {
                $request->session()->flash('ess-msg', "Un problème se produit. Merci de recommencer le processus. \n" .$e);
                return redirect()->back();
            }
        }

        $agenda->delete();

        $request->session()->flash('ess-msg', "Supression effectuée");
        return redirect()->back();
    }
}
