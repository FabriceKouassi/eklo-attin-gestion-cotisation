@extends('admin/_.app')

@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800"></h1>
      <a href="{{ route('laboratoire.new') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
        <i class="fas fa-plus fa-sm text-white-50"></i> Nouveau Laboratoire</a>
    </div>

    <div class="card shadow mb-4">
      <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered ess-dataTable" width="100%" cellspacing="0">
                <thead class="thead-dark">
                    <tr>
                        <th>Type</th>
                        <th>Noms</th>
                        <th width="90">Actions</th>
                    </tr>
                </thead>
                <tbody>
                       @foreach ($laboratoire as $item)
                        <tr>
                            <td class="text-center">
                                {{ $item->laboratoireType->nom }}
                            </td>
                            <td class="text-center">
                                {{ $item->nom }}
                            </td>
                            <td class="text-center">
                                <a href="{{ route('laboratoire.updateForm', ['id'=>$item->id]) }}" class="btn btn-warning btn-circle btn-sm">
                                    <i class="fas fa-info-circle"></i>
                                </a>
                                <a href="{{ route('laboratoire.delete', ['id'=>$item->id]) }}" class="btn btn-danger btn-circle btn-sm ess-link-checked"
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
