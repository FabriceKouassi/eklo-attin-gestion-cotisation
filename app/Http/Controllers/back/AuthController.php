<?php

namespace App\Http\Controllers\back;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Mail\ResetPasswordMail;
use App\Models\Company;
use App\Models\ResetPassword;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    protected $email;

    public function showLoginForm()
    {
        $pIndex = 'login';
        $title = 'login';
        $company = Company::first();

        $param = [
            'pIndex' => $pIndex,
            'title' => $title,
            'company' => $company,
        ];

        return view('admin.login', $param);
    }

    public function loginUser(LoginRequest $request)
    {
        $data = $request->validated();

        // Tentez de connecter l'utilisateur
        if (auth()->attempt(['email' => $data['email'], 'password' => $data['password']])) {

            $user = User::query()->where('id', Auth::user()->id)->first();
            $user->last_login = now();
            $user->save();

            return redirect()->route('dashboard');

        } else {
            $request->session()->flash('ess-msg', "Email ou mot de passe incorrect");
            return back()->withInput()->withErrors(['email' => 'Email ou mot de passe incorrect.']);
        }
    }

    public function showRegisterForm()
    {
        $pIndex = 'register';
        $title = 'Register';

        $param = [
            'pIndex' => $pIndex,
            'title' => $title,
        ];

        return view('admin.register', $param);
    }

    public function registerUser(RegisterRequest $request)
    {
        $data = $request->validated();
        $data['password'] = bcrypt($data['password']);

        $user = User::create($data);

        auth()->login($user);

        return redirect()->route('dashboard');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login.form');
    }

    public function resetPasswordShowForm()
    {
        $pIndex = 'reset_password';
        $title = 'Réinitialiser le mot de passe';
        $company = Company::first();

        $param = [
            'pIndex' => $pIndex,
            'title' => $title,
            'company' => $company,
        ];

        return view('admin.resetPassword', $param);
    }

    public function resetPassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required |exists:users,email',
        ]);

        if($validator->fails()){
            // dd($validator->messages());
            $request->session()->flash('ess-msg', "Email non valide");
            return redirect()->back()->withErrors($validator)->withInput();
        };

        $users = User::where('email', $request->email)->get();

        if($users !== null && count($users) == 1)
        {
            foreach ($users as $user) {
                $otp = rand(000000, 999999);

                $reset = ResetPassword::create([
                    'email' => $user->email,
                    'isVerified' => 0,
                    'expires_at' => now()->addMinutes(2),
                    'otp'=>$otp
                ]);

                $data = [
                    'user' => $user,
                    'otp' => $otp,
                ];

                //envoie de mail
                Mail::to($user['email'])->send(new ResetPasswordMail([$data]));
            }
            $request->session()->flash('ess-msg', "Verifier votre code de rénitialisation via mail");
            return redirect()->route('resetVerification.form');
        }
        else
        {
            $request->session()->flash('ess-msg', "Désolé, une erreur s'est produite. Veuillez réesayé svp !");
            return redirect()->back()->withErrors($validator)->withInput();
        }

    }

    public function resetVerificationForm()
    {
        $pIndex = 'reset_verification';
        $title = 'Réinitialiser le mot de passe';
        $company = Company::first();

        $param = [
            'pIndex' => $pIndex,
            'title' => $title,
            'company' => $company,
        ];

        return view('admin.resetVerification', $param);
    }

    public function resetVerification(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'otp' => 'required|numeric',
        ]);

        if($validator->fails()){
            // dd($validator->messages());
            $request->session()->flash('ess-msg', "OTP obligatoire et dois être de type numérique");
            return redirect()->back()->withErrors($validator)->withInput();
        };

        $otp = ResetPassword::where('otp', $request->otp)->get();

        if(!$otp || count($otp) == 0)
        {
            $request->session()->flash('ess-msg', "Le code OTP est incorrect ou a expiré.");
            return redirect()->back();
        }else{
            foreach ($otp as $value) {
                if(now() < $value->expires_at || now() == $value->expires_at) {
                    if($value->isVerified == 0) {
                        $value->isVerified = 1;
                        $value->save();

                        return redirect()->route('update.passwordForm', [$value->email]);
                    }
                    else
                    {
                        $request->session()->flash('ess-msg', "OTP déjà utilisé !");
                        return redirect()->back()->withErrors($validator)->withInput();
                    }
                }
                else
                {
                    $request->session()->flash('ess-msg', "OTP Expiré. Merci de recommancé le processus.");
                    return redirect()->back()->withErrors($validator)->withInput();
                }
            }
        }
    }

    public function changePasswordForm(string $email)
    {
        $pIndex = 'reset_verification';
        $title = 'Réinitialiser le mot de passe';
        $company = Company::first();
        $users = User::where('email', $email)->get();

        foreach ($users as $user) {
            $value = $user;
        }

        $param = [
            'pIndex' => $pIndex,
            'title' => $title,
            'company' => $company,
            'user' => $value,
        ];

        return view('admin.changePassword', $param);
    }

    public function changePassword(Request $request)
    {
        $this->email =  $request->email;
        $email = $this->email;

        $validator = Validator::make($request->all(), [
            'password' => 'required',
            'confirm_password' => 'required'
        ]);

        if($validator->fails()){
            $request->session()->flash('ess-msg', "Champ requis");
            return redirect()->back()->withErrors($validator)->withInput();
        };

        if ($request->password  !=  $request->confirm_password) {
            $request->session()->flash('ess-msg', "Le nouveau et la confirmation du mot de passe ne sont pas identiques.");
            return redirect()->back()->withErrors($validator)->withInput();
        }
        else
        {
            $newPass = bcrypt($request->password);
            User::where('email',$email)->update([
                'password'=>$newPass,
                'updated_at' => now()
            ]);
            $request->session()->flash('ess-msg', "Votre mot de passe a été modifié avec succès. Merci de vous connecté a nouveau");
            return redirect()->route('login.form');
        }
    }
}
