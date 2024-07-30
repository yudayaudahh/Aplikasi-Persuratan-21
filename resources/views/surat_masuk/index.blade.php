@extends('layouts.template')

@section('content')
    <div class="row">

        <div class="col-lg-11">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">
                        <span class="d-inline-block">
                            {{ $title ?? 'Judul' }}
                        </span>
                        <div class="float-right">
                            <a class="btn btn-success text-light" href="{{ route('surat-masuk.create') }}">
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
                                    <th>Kode Surat</th>
                                    <th>Tanggal Masuk</th>
                                    <th>Perihal</th>
                                    <th>Penerima</th>
                                    <th>Lampiran File</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($suratMasuk as $item)
                                    <tr>
                                        <td>{{ $item->nomor_surat }}</td>
                                        <td>{{ $item->tanggal_masuk }}</td>
                                        <td>{{ $item->kategori->nama ?? '-' }}</td>
                                        <td>{{ $item->instasi->nama ?? '-'}}</td>
                                        @if ($item->file)
                                            <td><a href="{{ asset('storage/file_surat_masuk/'.$item->file) }}" class="text-success" target="_blank">Lihat File</a></td>
                                        @else
                                            <td><span class="text-danger">Tidak ada lampiran</span></td>
                                        @endif
                                        <td>
                                            <div class="dropdown">
                                                <button class="btn btn-success px-2 py-1 dropdown-toggle" type="button"
                                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    Pilih Aksi
                                                </button>
                                                <div class="dropdown-menu">
                                                    <a class="dropdown-item edit"
                                                        href="{{ route('surat-masuk.export', $item->id) }}">
                                                        <i class="fas fa-file-alt mr-1" ></i> Install Laporan
                                                    </a>
                                                    <a class="dropdown-item edit"
                                                        href="{{ route('surat-masuk.edit', $item->id) }}">
                                                        <i class="fas fa-pencil-alt mr-1" ></i> Edit
                                                    </a>
                                                    <a class="dropdown-item edit"
                                                        href="{{ route('surat-masuk.destroy', $item->id) }}" data-confirm-delete="true">
                                                        <i class="fas fa-trash mr-1"></i> Edit
                                                    </a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>

                            <tfoot>
                                <tr>
                                    <th>Kode Surat</th>
                                    <th>Tanggal Masuk</th>
                                    <th>Perihal</th>
                                    <th>Penerima</th>
                                    <th>Lampiran File</th>
                                    <th>Aksi</th>
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