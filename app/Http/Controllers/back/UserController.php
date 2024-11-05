<?php

namespace App\Http\Controllers\back;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function index()
    {
        $pIndex = 'user.all';
        $title = 'Utilisateurs';
        $company = Company::first();
        $users = User::query()->oldest('nom')->where('id', '!=', auth()->user()->id)->where('email', '!=', 'fabrice.ako@dkbsolutions.com')->get();

        $param = [
            'pIndex' => $pIndex,
            'title' => $title,
            'company' => $company,
            'users' => $users,
        ];

        return view('admin.user.all', $param);
    }

    public function showSaveForm()
    {
        $company = Company::first();

        $param = [
          "title" => "Nouvel Utilisateur",
          "pIndex" => "user.new",
          "company" => $company
        ];

        return view('admin.user.new', $param);
    }

    public function saveForm(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nom' => 'required',
            'prenoms' => 'required',
            'email' => 'required',
            'password' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $users = User::all();
        foreach ($users as $key => $user) {
            if($user->email == $request->email)
            {
                $request->session()->flash('ess-msg', "Email déjà utilisé dans le systeme");
                return redirect()->back()->withErrors($validator)->withInput();
            }
            if($user->phone == $request->phone)
            {
                $request->session()->flash('ess-msg', "Contact déjà utilisé dans le systeme");
                return redirect()->back()->withErrors($validator)->withInput();
            }
        }
        $user = User::create([
            'nom' => $request->nom,
            'prenoms' => $request->prenoms,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => $request->role,
            'phone' => $request->phone,
            'enabled' => $request->enabled,
        ]);

        if($request->file('img')){
            $file = $request->file('img');
            $filename = $file->getClientOriginalName();
            //$path = $file->storeAs('public/'.config('global.image_user'), $filename);
            $file->move(public_path('storage/').config('global.image_user'), $filename);

            $user->img = $filename;
        }

        $user->save();

        $request->session()->flash('ess-msg', "L'utilisateur à été ajouté");
        return redirect()->route('user.updateForm', [$user->id]);
    }

    public function showUpdateForm(int $id)
    {
        $user = User::where('id', $id)->first();
        $company = Company::first();
        if($user == null) return redirect()->route('user.all');

        $param = [
          "title" => "Profil",
          "pIndex" => "user.infos",
          "user" => $user,
          "company" => $company,
        ];

        return view('admin.user.infos', $param);
    }

    public function updateForm(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nom' => 'required',
            'prenoms' => 'required',
            'email' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $user = User::where('id', $request->userId)->first();
        if($user==null) return redirect()->back();

        $user->nom = $request->nom;
        $user->prenoms = $request->prenoms;
        $user->email = $request->email;
        $user->phone = $request->phone;

        if($request->role != ""){
            $user->role = $request->role;
        }

        if($request->enabled != ""){
            $user->enabled = $request->enabled;
        }

        if($request->password != ""){
            $user->password = $request->password;
        }

        if($request->file('img')){

            if ($user->img !== null && file_exists(public_path('storage/'.config('global.image_user').'/'.$user->img))) {
                unlink(public_path('storage/'.config('global.image_user').'/'.$user->img));
            }

            $file = $request->file('img');
            $filename = $file->getClientOriginalName();

            $file->move(public_path('storage/').config('global.image_user'), $filename);

            $user->img = $filename;
        }

        $user->save();

        $request->session()->flash('ess-msg', "Modification effectuée");
        return redirect()->back();
    }

    public function delete(Request $request, int $id)
    {
        $user = User::where('id', $id)->first();
        if($user==null) return redirect()->back();

        if ($user->img !== null && file_exists(public_path('storage/'.config('global.image_user').'/'.$user->img))) {
            unlink(public_path('storage/'.config('global.image_user').'/'.$user->img));
        }

        $user->delete();

        $request->session()->flash('ess-msg', "L'utilisateur à été suprimé");
        return redirect()->back();
    }
}
