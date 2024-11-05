@extends('admin/_.app')


@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">{{ $title }}</h1>
        <div class="">
            <strong class="text-white bg-warning p-2 m-2" style="border-radius: 5px; {{ $prestationType == 0 ? 'visibility: visible;' : 'visibility: hidden;'}}">
                <i class="fas fa-info fa-md text-white-50 m-1"></i> Veuillez créer au moins un type de prestation dans la rubrique <em>Types->Type de prestations</em>
            </strong>
            <a href="{{ route('prestation.new') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm {{ $prestationType == 0 ? 'disabled' : ''}}">
                <i class="fas fa-plus fa-sm text-white-50"></i> {{ config('global.btn_save_name') }}
            </a>
        </div>
    </div>

    <div class="card shadow mb-4">
      <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered ess-dataTable" width="100%" cellspacing="0">
                <thead class="thead-dark">
                    <tr>
                        <th>Type de prestation</th>
                        <th>Libelles</th>
                        <th width="90">Actions</th>
                    </tr>
                </thead>
                <tbody>
                       @foreach ($prestation as $item)
                        <tr>
                            <td class="text-center">
                                {{ $item->prestationType->libelle }}
                            </td>
                            <td class="text-center">
                                {{ $item->libelle }}
                            </td>
                            <td class="text-center">
                                <a href="{{ route('prestation.updateForm', ['id'=>$item->id]) }}" class="btn btn-warning btn-circle btn-sm">
                                    <i class="fas fa-info-circle"></i>
                                </a>
                                <a href="{{ route('prestation.delete', ['id'=>$item->id]) }}" class="btn btn-danger btn-circle btn-sm ess-link-checked"
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
