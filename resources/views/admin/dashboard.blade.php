@extends('admin/_.app')

@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800"><?= $title ?></h1>
    </div>


    <div class="row">
        <!-- Earnings (Monthly) Card Example -->
        <div class="col-md mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Type de Prestations</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $prestationType->count() }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-user-edit fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-md mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Tarifications</div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $tarifications->count() }}</div>
                    </div>
                    <div class="col-auto">
                    <i class="fas fa-pen fa-2x text-gray-300"></i>
                    </div>
                </div>
                </div>
            </div>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-md mb-4">
            <div class="card border-left-danger shadow h-100 py-2">
                <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Documents</div>
                    <div class="row no-gutters align-items-center">
                        <div class="col-auto">
                        <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">{{ $documents->count() }}</div>
                        </div>
                    </div>
                    </div>
                    <div class="col-auto">
                    <i class="fas fa-globe fa-2x text-gray-300"></i>
                    </div>
                </div>
                </div>
            </div>
        </div>

        <div class="col-md mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Nouveaux contacts</div>
                    <div class="row no-gutters align-items-center">
                        <div class="col-auto">
                        <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">{{ $contacts->count() }}</div>
                        </div>
                    </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-phone fa-2x text-gray-300"></i>
                    </div>
                </div>
                </div>
            </div>
        </div>

        <div class="col-md mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Reclamations</div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $reclamation->count() }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-user-edit fa-2x text-gray-300"></i>
                    </div>
                </div>
                </div>
            </div>
        </div>

    </div>

    <div class="row">
        <div class="col-md-6">
            <!-- Illustrations -->
            <div class="card shadow">
                <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">{{ $company ? $company->name : '' }}</h6>
                </div>
                <div class="card-body">
                <div class="text-center">
                    <img src="{{ $company ? $company->getLogo1() : '' }}" alt="" width="155px">
                </div>
                <br>
                <p class="text-justify">{{ $company ? $company->vision : '' }}</p>
                <a target="_blank" rel="nofollow" href="https://undraw.co/">Browse Illustrations on unDraw &rarr;</a>
                </div>
            </div>
        </div>

        </div>
    </div>

    {{-- <div class="card shadow mb-4 mt-3">
        <div class="card-body">
          <div class="table-responsive">
              <table class="table table-bordered ess-dataTable" width="100%" cellspacing="0">

              </table>
          </div>
        </div>
    </div> --}}
@endsection
