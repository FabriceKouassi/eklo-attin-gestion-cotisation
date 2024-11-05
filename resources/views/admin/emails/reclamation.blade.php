<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('emails/mails.css') }}">
    <title>Réclamations et Suggestions</title>
</head>
<body style="background-color: #f2f2f2; padding: 50px;">
    <div class="mail-content" style="padding: 20px; font-size: 1rem; width: 80%; background-color: #fff; border-radius: 5px; margin: 0 auto;">
        <div class="logo">
            <img src="{{ asset('img/inhp-logo.png') }}" alt="logo {{ $company->name }}" width="50">
        </div>
        <div class="">
            <h2>Réclamations et Suggestions</h2>
            <p>
                Bonjour Mr / Mme  <strong>{{ $data->fullName }},</strong> <br>
                <strong>Type de message: </strong> {{ $data->type }}. <br>
                <strong>Objet: </strong> {{ $data->objet }}. <br>
                <strong>Message: </strong> <br> {{ $data->message }} <br>
                ----------------------------------- <br>
                Reponse: <strong class="otp-code" style="font-weight: 600; color: #088abd;"> {{ $data->reponse }} </strong>
            </p>
        </div>
    </div>
</body>
</html>
