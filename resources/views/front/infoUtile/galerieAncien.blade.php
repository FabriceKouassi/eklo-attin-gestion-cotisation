<div class="box-nv1-row-wrap mt-5 mb-2">
    {{-- <div class="box-nv2-c4 back-img" style="background-image: url('{{ asset('model/assets/images/docteur.jpg')}}');"></div>
    <div class="box-nv2-c4 back-img" style="background-image: url('{{ asset('model/assets/images/young.jpg')}}');"></div>
    <div class="box-nv2-c4 back-img" style="background-image: url('{{ asset('model/assets/images/docteur.jpg')}}');"></div>
    <div class="box-nv2-c4 back-img" style="background-image: url('{{ asset('model/assets/images/young.jpg')}}');"></div>
    <div class="box-nv2-c4 back-img" style="background-image: url('{{ asset('model/assets/images/docteur.jpg')}}');"></div>
    <div class="box-nv2-c4 back-img" style="background-image: url('{{ asset('model/assets/images/young.jpg')}}');"></div>
    <div class="box-nv2-c4 back-img" style="background-image: url('{{ asset('model/assets/images/docteur.jpg')}}');"></div>
    <div class="box-nv2-c4 back-img" style="background-image: url('{{ asset('model/assets/images/young.jpg')}}');"></div>
    <div class="box-nv2-c4 back-img" style="background-image: url('{{ asset('model/assets/images/docteur.jpg')}}');"></div>
    <div class="box-nv2-c4 back-img" style="background-image: url('{{ asset('model/assets/images/young.jpg')}}');"></div> --}}

    @foreach ($mediatheques as $item)
        @foreach ($item->getImgs() as $img)
            <div class="box-nv2-c4 back-img" style="background-image: url('{{ $img ?? '' }}');"></div>
        @endforeach
    @endforeach
</div>
<div class="pagination">
    @if ($mediatheques->hasPages())
        <ul class="pager pagination">

            @if ($mediatheques->onFirstPage())
                <li class="disabled"><span></span></li>
            @else
                <li><a href="{{ $mediatheques->previousPageUrl() }}" rel="prev">← Précédent</a></li>
            @endif

            @foreach ($mediatheques as $element)

                @if (is_string($element))
                    <li class="disabled"><span>{{ $element }}</span></li>
                @endif

                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $mediatheques->currentPage())
                            <li class="active my-active"><span>{{ $page }}</span></li>
                        @else
                            <li><a href="{{ $url }}">{{ $page }}</a></li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            @if ($mediatheques->hasMorePages())
                <li><a href="{{ $mediatheques->nextPageUrl() }}" rel="next">Suivant →</a></li>
            @else
                <li class="disabled"><span></span></li>
            @endif
        </ul>
    @endif
</div>
