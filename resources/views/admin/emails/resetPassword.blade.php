<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('emails/mails.css') }}">
    <title>Rénitialisation de mot de passe</title>
</head>
<body style="background-color: #f2f2f2;">
    <div class="mail-content" style="padding: 20px; font-size: 1rem; width: 80%; background-color: #fff; border-radius: 5px;">
        <h2>Rénitialisation de mot de passe</h2>
        <p>
            Bonjour Mr / Mme  {{ $data['user']->nom }} {{ $data['user']->prenoms }}, <br>
            Pour réinitialiser votre mot de passe, veuillez saisir ce code :
            <strong class="otp-code" style="font-weight: 800; font-size: 2rem; color: #088abd;">{{ $data['otp'] }} </strong>
        </p>
        <a href="{{ route('resetVerification.form') }}" class="mail-btn" style="padding: 1rem; background-color: #d0eefa; text-align: center;">Cliquez ici pour confirmer la rénitialisation</a>
        {{--
            <p>
                Merci d'utiliser notre service. Si vous n'êtes pas à l'origine de cette demande, il est fort possible que quelqu'un
                essai de se connecter à votre compte.
            </p>

            <p>
                Soyez prudent !

                Cordialement.
            </p>
        --}}
    </div>
</body>
</html>
