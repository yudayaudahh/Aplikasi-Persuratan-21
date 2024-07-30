@extends('layouts.template')

@section('content')
    <div class="row">

        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">
                        <span class="d-inline-block">
                            {{ $title ?? 'Judul' }}
                        </span>
                        <div class="float-right">
                            <a class="btn btn-success text-light" href="{{ route('instasi.create') }}">
                                <i class="fas fa-plus mr-1"></i>Tambah
                            </a>
                        </div>
                    </h4>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable">

                            <thead>
                                <tr>
                                    <th>Nama</th>
                                    <th>Email</th>
                                    <th>Alamat</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($instasi as $item)
                                    <tr>
                                        <td>{{ $item->nama }}</td>
                                        <td>{{ $item->email }}</td>
                                        <td>{{ $item->alamat }}</td>
                                        <td>
                                            <div class="dropdown">
                                                <button class="btn btn-success px-2 py-1 dropdown-toggle" type="button"
                                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    Pilih Aksi
                                                </button>
                                                <div class="dropdown-menu">
                                                    <a class="dropdown-item edit"
                                                        href="{{ route('instasi.edit', $item->id) }}">
                                                        <i class="fas fa-pencil-alt mr-1" hre></i> Edit
                                                    </a>
                                                    <a class="dropdown-item delete" href="{{ route('instasi.destroy', $item->id) }}" data-confirm-delete="true">
                                                        <i class="fas fa-trash mr-1"></i> Hapus
                                                    </a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>

                            <tfoot>
                                <tr>
                                    <th>Nama</th>
                                    <th>Alamat</th>
                                    <th>Aksi</th>
                                    <th>Email</th>
                                </tr>
                            </tfoot>

                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            $('#dataTable').DataTable();
        });
    </script>
    
@endsection