@extends('front._.app')

@section('page-title', $pIndex)

@section('content')
    <section class="faq doctor-message">
        <div class="section-title">
            <img src="{{ asset('model/assets/images/molecule.png')}}" alt="">
            <h3>{{ $title }}</h3>
        </div>
        <div class="box-nv1-row">
            <div class="faq-box-img box-nv2-c2">
                <img src="{{ asset('model/assets/images/doctor.png')}}" alt="">
            </div>
            <div class="faq-box box-nv2-c2">
                <div class="accordion">
                    @foreach ($faqs as $item)
                        <div class="accordion-item">
                            <div class="accordion-header">
                                {{ $item->question }}
                                <span class="accordion-icon">+</span>
                            </div>
                            <div class="accordion-content">
                                {{ $item->response }}
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
@endsection
