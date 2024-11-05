@extends('admin/_.app')


@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800"><?= $title ?></h1>
      <a href="{{ route('admin.member.new') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
        <i class="fas fa-plus fa-sm text-white-50"></i> Nouveau Membre</a>
    </div>


    <div class="card shadow mb-4">
      <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered ess-dataTable" width="100%" cellspacing="0">
                <thead class="thead-dark">
                    <tr>
                        <th>Profils</th>
                        <th>Noms</th>
                        <th>Fonctions</th>
                        <th class="text-center">URL</th>
                        <th width="90">Actions</th>
                    </tr>
                </thead>
                <tfoot class="thead-dark">
                    <th>Profils</th>
                    <th>Noms</th>
                    <th>Fonctions</th>
                    <th class="text-center">URL</th>
                    <th width="90">Actions</th>
                </thead>

                <tbody>
                    <?php
                    foreach ($member as $key => $member) {
                        ?>
                        <tr>
                            <td class="text-center" width="70">
                                <a class="img" style="background-image: url('{{ $member->getImg($member->img) }}');"></a>
                            </td>
                            <td>{{ $member->name }}</td>
                            <td>{{ $member->fonction }}</td>
                            <td><a href="{{ $member->url }}">{{ $member->url }}</a></td>
                            <td class="text-center">
                                <a href="{{ route('admin.member.infos', [$member->id]) }}" class="btn btn-warning btn-circle btn-sm">
                                    <i class="fas fa-info-circle"></i>
                                </a>
                                <a href="{{ route('admin.member.remove', ["memberId"=>$member->id]) }}" class="btn btn-danger btn-circle btn-sm ess-link-checked"
                                    data-msg="Souhaitez-vous suprimer définitivement ?">
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
