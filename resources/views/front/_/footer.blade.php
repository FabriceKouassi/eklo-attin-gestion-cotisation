<footer class="mt-5">
    @if ($pIndex == 'accueil')
        <div class="section-full">
            <div class="container-grid footer-newsletter container-width p-3">
                <div class="item">
                    <h4 class="active">NEWSLETTER</h4>
                    <span class="body1">
                        Abonnez-vous à notre bulletin électronique pour obtenir des conseils utiles et des ressources précieuses.
                    </span>
                </div>
                <div class="form-newsletter item">
                    <form action="{{ route('front.save.newsletter') }}" method="POST">
                        @csrf
                        <div class="item">
                            <input type="text" name="honeypot" style="display:none;">
                        </div>
                        <div class="container-grid">
                            <div class="item">
                                <input type="text" placeholder="Nom" name="nom" required/>
                            </div>
                            <div class="item">
                                <input type="email" placeholder="Email" name="email" required/>
                            </div>
                        </div>
                        <div class="item isNotRobotDiv">
                            <input type="checkbox" name="isNotRobotBox" id="isNotRobotBox" class="isNotRobotBox" style="width: 10%;" onclick="checkedIsNotRobot()">
                            <label for="isNotRobotBox" onclick="checkedIsNotRobot()">Cocher si vous êtes un humain ?</label>
                        </div>
                        <button type="submit" class="btn-contained btn-error full-width submit-button" disabled>S'inscrire</button>
                    </form>
                </div>
            </div>
        </div>
    @endif
    <div class="footer-content container-grid">
        <div class="item">
            <a href="{{ route('front.index') }}">
                <img src="{{ !empty($company) ? $company->getLogo1() : '' }}" alt="{{ !empty($company) ? $company->alt : '' }}" style="width: 150px; object-fit: cover;">
            </a>
            <div>
                <ul class="menu-footer">
                    <li>
                        <a href="{{ route('front.index') }}">Accueil</a>
                    </li>
                    <li>
                        <a href="{{ route('front.about.index') }}">Presentation</a>
                    </li>
                    <li>
                        <a href="{{ route('front.prestation.index') }}">Prestation</a>
                    </li>
                    <li>
                        <a href="{{ route('front.tarification.index') }}">Tarification</a>
                    </li>
                    <li>
                        <a href="{{ route('front.document.index') }}">Documents</a>
                    </li>
                    <li>
                        <a href="{{ route('front.contact.index') }}">Contacts</a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="item">
            <p class="subtitle2">OÙ NOUS TROUVER?</p>
            <div class="divider mb-4"></div>

            <div class="cadre-icon-footer">
                <div class="cadre-svg">
                    <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 1200 1200">
                        <path fill="currentColor"
                            d="M600 0C350.178 0 147.656 202.521 147.656 452.344c0 83.547 16.353 169.837 63.281 232.031L600 1200l389.062-515.625c42.625-56.49 63.281-156.356 63.281-232.031C1052.344 202.521 849.822 0 600 0m0 261.987c105.116 0 190.356 85.241 190.356 190.356C790.356 557.46 705.116 642.7 600 642.7s-190.356-85.24-190.356-190.356S494.884 261.987 600 261.987" />
                    </svg>
                </div>
                <div class="body2">
                    {{ !empty($company) ? $company->adress : '' }}
                </div>
            </div>

            <div class="cadre-icon-footer">
                <div class="cadre-svg">
                    <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 16 16">
                        <path fill="currentColor"
                            d="M11 10c-1 1-1 2-2 2s-2-1-3-2s-2-2-2-3s1-1 2-2s-2-4-3-4s-3 3-3 3c0 2 2.055 6.055 4 8s6 4 8 4c0 0 3-2 3-3s-3-4-4-3" />
                    </svg>
                </div>
                <div class="body2">
                    {{ !empty($company) ? '(225)'.$company->phone1 : '' }} {{ !empty($company->phone2) ? '/ (225)'.$company->phone2 : '' }}
                </div>
            </div>

            <div class="cadre-icon-footer">
                <div class="cadre-svg">
                    <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24">
                        <path fill="currentColor"
                            d="M4 20q-.825 0-1.412-.587T2 18V6q0-.825.588-1.412T4 4h16q.825 0 1.413.588T22 6v12q0 .825-.587 1.413T20 20zm8-7l8-5V6l-8 5l-8-5v2z" />
                    </svg>
                </div>
                <div class="body2">
                    {{ !empty($company) ? $company->email1 : '' }}
                </div>
            </div>
        </div>
        <div class="item">
            <p class="subtitle2">À PROPOS DE L'INSTITUT</p>
            <div class="divider mb-4"></div>
            <span class="body2">
                {{ !empty($company) ? $company->vision : '' }}
            </span>
          </div>
    </div>
</footer>

@push('scripts-checked-is-not-robot')
    <script>
        function checkedIsNotRobot() {
            var checkbox = document.querySelector(".isNotRobotBox");
            var submitButton = document.querySelector(".submit-button");

            // Activer le bouton Envoyer si la case à cocher est cochée
            if (checkbox.checked) {
                submitButton.disabled = false;
                submitButton.style.transition = "all .5s ease";
            } else {
                submitButton.disabled = true;
            }
        }
    </script>
@endpush
