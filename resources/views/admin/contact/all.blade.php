@extends('admin/_.app')


@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">{{ $title }}</h1>
    </div>

    <div class="card shadow mb-4">
      <div class="card-body">
        <div class="table-responsive">
            <form action="{{ route('contact.manyDelete') }}" method="POST" style="overflow: hidden">
                @csrf
                @method('DELETE')
                <table class="table table-bordered ess-dataTable" width="100%" cellspacing="0">                                       
                    <thead class="thead-dark">
                            <tr>
                                <th class="text-center"><input type="checkbox" id="select-all"> Tous</th>
                                <th>Dates</th>
                                <th>Noms</th>
                                <th>Emails</th>
                                <th class="text-center">Phones</th>
                                <th class="text-center"></th>
                            </tr>
                    </thead>
    
                    <tbody>
                        @foreach ($contacts as $item)
                            <tr>
                                <td class="text-center">
                                    <input type="checkbox" name="ids[]" value="{{ $item->id }}">
                                </td>
                                <td width="80">
                                    @if ($item->isRead == 0)
                                        <span class="badge badge-success">Nouveau</span>
                                    @else
                                        <span class="badge badge-secondary">lu</span>
                                    @endif
                                    {{ date('d/m/Y', strtotime($item->created_at)) }}
                                </td>
                                <td class="text-center">
                                    {{ $item->fullName }}
                                </td>
                                <td>{{ $item->email }}</td>
                                <td class="text-center">
                                    {{ $item->phone }}
                                </td>
                                <td class="text-center">
                                    <a href="{{ route('contact.updateForm', ['id' => $item->id]) }}" class="btn btn-warning btn-circle btn-sm">
                                        <i class="fas fa-info-circle"></i>
                                    </a>
                                    <a href="{{ route('contact.delete', ['id' => $item->id]) }}" class="btn btn-danger btn-circle btn-sm ess-link-checked"
                                        data-msg="Souhaitez-vous suprimer définitivement ?">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <button type="submit" class="btn btn-danger mt-3">Supprimer la sélection</button>
            </form>
        </div>
      </div>
    </div>
</div>

<script>
    // Sélectionner/Désélectionner toutes les cases à cocher
    document.getElementById('select-all').addEventListener('click', function() {
        var checkboxes = document.querySelectorAll('input[name="ids[]"]');
        for (var checkbox of checkboxes) {
            checkbox.checked = this.checked;
        }
    });
</script>

@endsection
