@extends('front._.app')

@section('page-title', $pIndex)

@push('link-script-agenda-calendar')

    <link href="{{ asset("ej2/ej2-base.min.css") }}" rel="stylesheet">
    <link href="{{ asset("ej2/ej2-calendars.min.css") }}" rel="stylesheet">

    <style>
        .e-calendar .e-content td.e-disabled.e-today span.e-day, .e-bigger.e-small .e-calendar .e-content td.e-disabled.e-today span.e-day {
            box-shadow: none !important;
        }

        .e-calendar .e-content td.e-today.e-selected:hover span.e-day, .e-calendar .e-content td.e-selected:hover span.e-day, .e-calendar .e-content td.e-selected.e-focused-date span.e-day, .e-bigger.e-small .e-calendar .e-content td.e-today.e-selected:hover span.e-day, .e-bigger.e-small .e-calendar .e-content td.e-selected:hover span.e-day, .e-bigger.e-small .e-calendar .e-content td.e-selected.e-focused-date span.e-day {
            background-color: #009ef7 !important;
            color: #fff !important;
        }

        #search-calendar
        {
            z-index: 1;
        }
    </style>

@endpush

@section('content')
<section class="mediatheque">
    <div class="section-title d-flex-2">
        <div style="display: flex; align-items: center;">
            <img src="{{ asset('model/assets/images/molecule.png')}}" alt="">
            <h3>{{ $title }}</h3>
        </div>
    </div>
    <div id="search-calendar"></div>
    <div class="events-section">
        <div class="scroll-buttons">
            <button class="scroll-up">&#9650;</button>
            <div class="events-list" id="events-list">

                @forelse ($agendas as $item)
                <div class="event-card" id="event-card">
                    {{-- <img src="{{ asset('model/assets/images/docteur.jpg')}}" alt="Image de l'événement" class="event-image"> --}}
                    <img src="{{ $item->getImg() }}" alt="Image de l'événement" class="event-image-2">
                    <div class="event-content" id="event-content">
                        <div class="event-date">
                            <span class="date-icon">&#128197;</span>
                            <span class="date">{{ date('d/m/Y', strtotime($item->eventDate)) }}</span>
                        </div>
                        <div class="event-time">
                            <span class="time-icon">&#128337;</span>
                            <span class="time">{{ $item->eventHour }}</span>
                        </div>
                        <h3 class="event-title">
                            <a href="{{ route('front.agenda.detail', ['slug' => $item->slug]) }}" style="text-decoration: none; font-size: 18px">{{ $item->title }}</a>
                        </h3>
                        <p class="event-description">{{ $item->str_limit($item->content, 20) }}</p>
                        <div class="event-location">
                            <span class="location-icon">&#128205;</span>
                            <span class="location color-red">
                                {{ $item->location }}
                            </span>
                        </div>
                        @if ($item->doc !== null || !empty($item->doc))
                            <div class="download-card text-center mt-2">
                                <a href="{{ $item->getDoc() }}" download="{{ $item->title }}"> 
                                <svg xmlns="http://www.w3.org/2000/svg" width="1.2em" height="1.2em" viewBox="0 0 24 24"><path fill="currentColor" d="M5 20h14v-2H5zM19 9h-4V3H9v6H5l7 7z"/></svg>
                                    Brochure
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
                @empty
                {{-- <div class="event-card-2" id="event-card"> --}}
                    {{-- <div class="event-content-2" id="event-content"> --}}
                        {{-- <h3 class="event-title">
                            <a href="" style="text-decoration: none; font-size: 18px"></a>
                        </h3> --}}

                        @php
                            $date = request()->query('date', '');

                            if ($date === '') {
                                $date = $agendasAll[0]->eventDate;
                            }

                            $month = Carbon\Carbon::parse($date)->format('F');
                        @endphp


                        <p>
                            Aucun événement disponible pour ce mois.<br/>
                            Veuillez parcourir le calendrier pour rechercher les prochains événements.
                        </p>
                    {{-- </div> --}}
                {{-- </div> --}}
                @endforelse
            </div>
            <button class="scroll-down">&#9660;</button>
        </div>
        <div class="calendar-container">
            <div class="download-card text-center mt-2">
            </div>
        </div>
    </div>
</section>

@push('script-agenda-calendar')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.3/moment.min.js"></script>
    <script src="{{ asset('ej2/ej2-base.min.js') }}"></script>
    <script src="{{ asset('ej2/ej2-calendars.min.js') }}"></script>

    <script>

        var agendas = @json($agendasAll); // Convertir les données PHP en JSON
        const _agendas = @json($agendas)

        // Convertir les dates en objets JavaScript Date
        var jsDates = agendas.map(function(dateString) {
            return new Date(dateString.eventDate).toLocaleDateString("en-US");
        });

        var _jsDates = _agendas.map(function(dateString) {
            return new Date(dateString.eventDate).toLocaleDateString("en-US");
        });

        let currentDate = "{{ request()->query('date', '') }}"

        if (currentDate !== '') {
            currentDate = _jsDates[0]
        }

        var calendar = new ej.calendars.Calendar({
            value: currentDate,
            firstDayOfWeek: 1,
            change: function (args) {
                args.event.target.style.backgroundColor = '#009ef7'
                window.location.href = "{{ url('agenda?date=') }}" + moment(calendar.value).format('YYYY-MM-DD')
            },
            renderDayCell: function (args) {
                const currentDate = new Date(args.date).toLocaleDateString("en-US")

                isDisabled = !jsDates.includes(currentDate)
                args.isDisabled = isDisabled

                if (!isDisabled) {
                    args.element.querySelector(":first-child").style.fontWeight = 'bold'
                    args.element.querySelector(":first-child").style.color = '#009ef7'
                }
            },
        });

        calendar.appendTo('#search-calendar');


        const L10n = ej.base.L10n

            L10n.load({
                'fr': {
                    'calendar': {
                        'today': "Aujourd'hui"
                    }
                }
            })

            loadCultureFiles()

            calendar.locale = 'fr'

            function loadCultureFiles() {
                let files = ['ca-gregorian.json', 'numbers.json', 'timeZoneNames.json']
                let loader = ej.base.loadCldr

                let loadCulture = function (prop) {
                    let val, ajax

                    ajax = new ej.base.Ajax("{{ asset("/cldr-data/main/fr") }}/" + files[prop], 'GET', false)
                    ajax.onSuccess = function (value) { val = value }
                    ajax.send()

                    loader(JSON.parse(val))
                }

                for (let prop = 0; prop < files.length; prop++) {
                    loadCulture(prop)
                }
            }
    </script>
@endpush

@endsection
