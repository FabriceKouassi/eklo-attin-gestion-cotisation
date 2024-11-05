@extends('admin/_.app')


@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">{{ $title }}</h1>
        <div class="d-flex">
            <a href="{{ route('newsletter.export') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm mr-2">
                Exporter (CSV) <i class="fas fa-file-export fa-sm text-white-50"></i>
            </a>
        </div>
    </div>

    <div class="card shadow mb-4">
      <div class="card-body">
        <div class="table-responsive">
            <form action="{{ route('newsletter.manyDelete') }}" method="post" style="overflow: hidden">
                @csrf
                @method('DELETE')

                <table class="table table-bordered ess-dataTable" style="width: 100%;" cellspacing="0">
                    <thead class="thead-dark">
                            <tr>
                                <th class="text-center"><input type="checkbox" id="select-all"> Tous</th>
                                <th>Noms & prénoms</th>
                                <th>
                                    Emails
                                </th>
                                <th width="70"></th>
                            </tr>
                    </thead>
                    <tbody>
                        @foreach ($newsLetter as $item)
                            <tr>
                                <td class="text-center">
                                    <input type="checkbox" name="ids[]" value="{{ $item->id }}">
                                </td>
                                <td>
                                    {{ $item->nom }}
                                </td>
                                <td>
                                    {{ $item->email }}
                                </td>
                                <td>
                                    <a href="{{ route('newsletter.updateForm', ['id'=>$item->id]) }}" class="btn btn-warning btn-circle btn-sm">
                                        <i class="fas fa-info-circle"></i>
                                    </a>
    
                                    <a href="{{ route('newsletter.delete', ['id'=>$item->id]) }}" class="btn btn-danger btn-circle btn-sm ess-link-checked"
                                        data-msg="Souhaitez-vous suprimer ce mail ?">
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
