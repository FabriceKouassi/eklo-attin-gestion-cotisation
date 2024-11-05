@extends('admin/_.app')


@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800"><?= $title ?></h1>
      <a href="{{ route('admin.partener.new') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
        <i class="fas fa-plus fa-sm text-white-50"></i> Nouveau Partenaire</a>
    </div>


    <div class="card shadow mb-4">
      <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered ess-dataTable" width="100%" cellspacing="0">
                <thead class="thead-dark">
                        <tr>
                            <th>logo</th>
                            <th>Raison Social</th>
                            <th width="90"></th>
                        </tr>
                </thead>
                <tfoot class="thead-dark">
                      <tr>
                            <th>logo</th>
                            <th>Raison Social</th>
                            <th></th>
                      </tr>
                </thead>

                <tbody>
                    <?php
                    foreach ($parteners as $key => $partener) {
                        ?>
                        <tr>
                            <td class="text-center">
                                <a class="img" style="background-image: url('{{ $partener->getImg() }}');"></a>
                            </td>
                            <td>
                                {{ $partener->name }}
                            </td>
                            <td class="text-center">
                                <a href="{{ route('admin.partener.infos', [$partener->id]) }}" class="btn btn-warning btn-circle btn-sm">
                                    <i class="fas fa-info-circle"></i>
                                </a>
                                <a href="{{ route('admin.partener.remove', ["partenerId"=>$partener->id]) }}" class="btn btn-danger btn-circle btn-sm ess-link-checked"
                                    data-msg="Souhaitez-vous suprimer définitivement ce partenaire">
                                    <i class="fas fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                        <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
      </div>
    </div>


</div>
@endsection
