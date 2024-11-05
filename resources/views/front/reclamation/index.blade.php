@extends('front._.app')

@section('page-title', $title)

@section('content')
    <section class="section-reclamation">
        <div class="section-title">
            <img src="{{ asset('model/assets/images/molecule.png') }}" alt="">
            {{-- <img src="{{ asset('img/reclamations et suggestions.png') }}" alt=""> --}}
            <h3>{{ $title }}</h3>
        </div>
        <div class="reclamation-img-card">
            <div class="reclamation-img-illustration">
                <img src="{{ asset('img/reclamations et suggestions.png') }}" alt="">
            </div>
            <div class="reclamation-section">
                <div class="contact-image">
                    <img src="{{ asset('model/assets/icons/bg-form.svg') }}" alt="Reclamations et Suggestions" style="opacity: 0.5">
                </div>
                <div class="contact-form-container">
                    <form action="{{ route('front.save_reclamation.index') }}" method="POST" class="contact-form">
                        @csrf
                        <div class="input-group">
                            <input type="text" name="honeypot" style="display:none;">
                        </div>
                        <div class="input-group">
                            <input type="text" id="name" name="fullName" placeholder="Nom et Prénom" required>
                        </div>
                        <div class="flex-box-form">
                            <div class="input-group">
                                <input type="text" id="phone" name="phone" placeholder="Téléphone" required>
                            </div>
                            <div class="input-group">
                                <input type="email" id="email" name="email" placeholder="Email" required>
                            </div>
                        </div>
                        <div class="input-group" style="width: 100%;">
                            <select name="type" id="" required>
                                <option value="" selected disabled>Choisir le type de message</option>
                                <option value="reclamation">Réclamation</option>
                                <option value="suggestion">Suggestion</option>
                            </select>
                        </div>
                        <div class="input-group">
                            <input type="text" id="objet" name="objet" placeholder="Objet" required>
                        </div>
                        <div class="input-group">
                            <textarea id="message" name="message" placeholder="Votre Message" rows="5" required></textarea>
                        </div>
                        <div class="input-group isNotRobotDiv">
                            <input type="checkbox" name="isNotRobotBox" id="isNotRobotBox" class="isNotRobotBox" style="width: 10%;" onclick="checkedIsNotRobot()">
                            <label for="isNotRobotBox" onclick="checkedIsNotRobot()">Cocher si vous êtes un humain ?</label>
                        </div>
                        <button type="submit" class="submit-button" disabled>Envoyer</button>
                    </form>
                </div>
            </div>
            {{-- <div class="reclamation-img-card" style="background-image: url('{{ asset('img/reclamations et suggestions1.png') }}')">
                <div class="reclamation-image">
                    <img src="{{ asset('img/reclamations et suggestions1.png') }}" alt="Reclamations et Suggestions">
                </div>
            </div> --}}
        </div>
    </section>

@endsection
