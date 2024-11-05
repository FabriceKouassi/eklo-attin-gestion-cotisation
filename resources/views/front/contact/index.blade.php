@extends('front._.app')

@section('page-title', $title)

@section('content')
    <section class="section-contact">
        <div class="section-title">
            <img src="{{ asset('model/assets/images/molecule.png') }}" alt="">
            <h3>{{ $title }}</h3>
        </div>
        <p class="contact-subtitle body1">
            Nous serions heureux d'avoir un retour de votre part. Écrivez-nous, que ce soit un commentaire,
            une question, une proposition de travail ou juste un bonjour. Vous pouvez utiliser le formulaire
            ci-dessous ou les coordonnées sur la droite.
        </p>
        <div class="contact-section">
            <div class="contact-image">
                <img src="{{ asset('model/assets/icons/bg-form.svg') }}" alt="Contactez-nous">
            </div>
            <div class="contact-form-container">
                <form action="{{ route('front.save_contact.index') }}" method="POST" class="contact-form">
                    @csrf
                    <div class="input-group">
                        <input type="text" name="honeypot" style="display:none;">
                    </div>
                    <div class="input-group">
                        <input type="text" id="name" name="fullName" placeholder="Nom et Prénom" required>
                    </div>
                    <div class="input-group">
                        <input type="text" id="phone" name="phone" placeholder="Téléphone" required>
                    </div>
                    <div class="input-group">
                        <input type="email" id="email" name="email" placeholder="Email" required>
                    </div>
                    <div class="input-group">
                        <textarea id="message" name="message" placeholder="Votre Message" rows="5" required></textarea>
                    </div>
                    {{-- <div class="flex-box-form">
                    </div> --}}
                    <div class="input-group isNotRobotDiv">
                        <input type="checkbox" name="isNotRobotBox" id="isNotRobotBox" class="isNotRobotBox" style="width: 10%;" onclick="checkedIsNotRobot()">
                        <label for="isNotRobotBox" onclick="checkedIsNotRobot()">Cocher si vous êtes un humain ?</label>
                    </div>
                    <button type="submit" class="submit-button" disabled>Envoyer</button>
                </form>
            </div>
        </div>

    </section>


@endsection
