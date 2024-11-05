@extends('admin/_.app')


@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800">{{ $title }}</h1>
      <a href="{{ route('agenda.new') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
        <i class="fas fa-plus fa-sm text-white-50"></i> {{ config('global.btn_save_name') }}</a>
    </div>

    <div class="card shadow mb-4">
      <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered ess-dataTable" width="100%" cellspacing="0">
                <thead class="thead-dark">
                    <tr>
                        <th>Images</th>
                        <th>Titres</th>
                        <th>Dates et Heures</th>
                        <th width="90">Actions</th>
                    </tr>
                </thead>
                <tbody>
                       @foreach ($agenda as $item)
                            <tr>
                                <td class="text-center">
                                    <img src="{{ $item->getImg() }}" alt="{{ $item->img }}" style="width: 60px;">
                                </td>
                                <td class="text-center">
                                    {{ $item->title }}
                                </td>
                                <td class="text-center">
                                    {{ $item->eventDate }} - {{ $item->eventHour }}
                                </td>
                                <td class="text-center">
                                    <a href="{{ route('agenda.updateForm', ['id'=>$item->id]) }}" class="btn btn-warning btn-circle btn-sm">
                                        <i class="fas fa-info-circle"></i>
                                    </a>
                                    <a href="{{ route('agenda.delete', ['id'=>$item->id]) }}" class="btn btn-danger btn-circle btn-sm ess-link-checked"
                                        data-msg="Êtes vous sûr de vouloir supprimé ?">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                </tbody>
            </table>
        </div>
      </div>
    </div>
</div>
@endsection
