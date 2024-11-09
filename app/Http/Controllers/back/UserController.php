<?php

namespace App\Http\Controllers\back;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\Fonction;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function index()
    {
        $pIndex = 'user.all';
        $title = 'Utilisateurs';
        $company = Company::first();
        $users = User::query()->oldest('nom')->where('id', '!=', auth()->user()->id)->where('email', '!=', 'fabrice.ako@dkbsolutions.com')->get();
        $fonctionCount = Fonction::query()->count();
        
        $param = [
            'pIndex' => $pIndex,
            'title' => $title,
            'company' => $company,
            'users' => $users,
            'fonctionCount' => $fonctionCount,
        ];

        return view('admin.user.all', $param);
    }

    public function showSaveForm()
    {
        $company = Company::first();
        $fonctions = Fonction::query()->oldest('libelle')->get();

        $param = [
          "title" => "Nouvel Utilisateur",
          "pIndex" => "user.new",
          "company" => $company,
          "fonctions" => $fonctions,
        ];

        return view('admin.user.new', $param);
    }

    public function saveForm(Request $request)
    {
        $request->merge([
            'phone' => preg_replace('/\s+/', '', trim($request->phone)),
            'email' => preg_replace('/\s+/', '', trim($request->email)),
        ]);

        $validator = Validator::make($request->all(), [
            'nom' => 'required',
            'prenoms' => 'required',
            'phone' => 'required|unique:users,phone,except,id',
            'email' => 'nullable|email|unique:users,email,except,id',
        ], [
            'nom.required' => 'Le nom est obligatoire',
            'prenoms.required' => 'Les prénoms sont obligatoires',
            'phone.required' => 'Le téléphone est obligatoire',
            'phone.unique' => 'Le téléphone est déjà utilisé',
            'email.email' => 'L\'email est incorrect',
            'email.unique' => 'L\'email est déjà utilisé',            
        ]);

        if ($validator->fails()) {
            $firstErrorMessage = $validator->errors()->first();
            $request->session()->flash('ess-msg-error', $firstErrorMessage);

            return redirect()->back()->withErrors($validator)->withInput();
        }

        $user = User::create([
            'nom' => $request->nom,
            'prenoms' => $request->prenoms,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => $request->role,
            'phone' => $request->phone,
            'enabled' => $request->enabled,
            'fonction_id' => $request->fonction_id,
        ]);

        if($request->file('img')){
            $file = $request->file('img');
            $filename = $file->getClientOriginalName();
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
        $fonctions = Fonction::query()->oldest('libelle')->get();

        if($user == null) return redirect()->route('user.all');

        $param = [
          "title" => "Profil",
          "pIndex" => "user.infos",
          "user" => $user,
          "company" => $company,
          "fonctions" => $fonctions,
        ];

        return view('admin.user.infos', $param);
    }

    public function updateForm(Request $request)
    {
        $request->merge([
            'phone' => preg_replace('/\s+/', '', trim($request->phone)),
            'email' => preg_replace('/\s+/', '', trim($request->email)),
        ]);

        $validator = Validator::make($request->all(), [
            'nom' => 'required',
            'prenoms' => 'required',
            'phone' => 'sometimes|unique:users,phone,' . $request->userId,
            'email' => 'sometimes|nullable|email|unique:users,email,' . $request->userId,
        ], [
                'nom.required' => 'Le nom est obligatoire',
                'prenoms.required' => 'Les prénoms sont obligatoires',
                'phone.unique' => 'Le numéro de téléphone est déjà utilisé',
                'email.unique' => 'L\'email est déjà utilisé',
            ]
        );

        if ($validator->fails()) {
            $firstErrorMessage = $validator->errors()->first();
            $request->session()->flash('ess-msg-error', $firstErrorMessage);
            
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $user = User::where('id', $request->userId)->first();
        if($user==null) return redirect()->back();

        $user->nom = $request->nom;
        $user->prenoms = $request->prenoms;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->fonction_id = $request->fonction_id;

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
