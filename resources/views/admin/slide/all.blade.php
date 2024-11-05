@extends('admin/_.app')


@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800"><?= $title ?></h1>
      <a href="{{ route('slide.new') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
        <i class="fas fa-plus fa-sm text-white-50"></i> Nouveau slide</a>
    </div>


    <div class="card shadow mb-4">
      <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered ess-dataTable" width="100%" cellspacing="0">
                <thead class="thead-dark">
                        <tr>
                            <th></th>
                            <th>Texte</th>
                            <th class="text-center">Etat</th>
                            <th width="90">Actions</th>
                        </tr>
                </thead>

                <tbody>
                    @foreach ($slides as $item)
                        <tr>
                            <td class="text-center" width="70">
                                <a class="img" style="background-image: url('{{ $item->getImg() }}');"></a>
                            </td>
                            <td>{{ $item->text }}</td>
                            <td class="text-center">
                                @if ($item->enabled==1)
                                    <span class="badge badge-success">Actif</span>
                                @else
                                    <span class="badge badge-danger">Inactif</span>
                                @endif
                            </td>
                            <td class="text-center">
                                <a href="{{ route('slide.updateForm', [$item->id]) }}" class="btn btn-warning btn-circle btn-sm">
                                    <i class="fas fa-info-circle"></i>
                                </a>
                                <a href="{{ route('slide.delete', ["id"=>$item->id]) }}" class="btn btn-danger btn-circle btn-sm ess-link-checked"
                                    data-msg="Souhaitez-vous suprimer définitivement ?">
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
