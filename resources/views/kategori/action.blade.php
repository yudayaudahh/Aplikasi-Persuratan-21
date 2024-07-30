@extends('layouts.template')

@section('content')
<div class="row">

	<div class="col-lg-6">
		<div class="card">
			<div class="card-header">
				<h4 class="card-title"> 
					<span class="d-inline-block">
						{{ $title ?? 'Judul' }}
					</span>
				</h4>
			</div>

			<div class="card-body">
				<form id="form" action="@if (isset($kategori)) {{ route('kategori.update', $kategori->id) }} @else {{ route('kategori.store') }} @endif" method="POST">
                    @if (isset($kategori))
                        @method('PUT')
                    @endif
                    @csrf
					<div class="form-group">
						<label> Nama  </label>
						<input type="text" name="nama" class="form-control
                        @error('nama')
                            is-invalid
                        @enderror" placeholder="Masukkan Nama Kategori" value="{{ old('nama') ?? $kategori->nama ?? '' }}">
						@error('nama')
                            <p class="invalid-feedback">{{ $message }}</p>
                        @enderror
                    </div>

					<div class="form-group">
						<label> Deskripsi  </label>
						<textarea type="text" name="deskripsi" class="form-control @error('deskripsi') is-invalid @enderror" placeholder="Masukkan Deskripsi Kategori">{{ old('deskripsi') ?? $kategori->deskripsi ?? '' }}</textarea>
						@error('deskripsi')
                            <p class="invalid-feedback">{{ $message }}</p>
                        @enderror
                    </div>


                    <hr class="mt-5">
					<button class="btn btn-success" type="submit">
						<i class="fas fa-check mr-2"></i> Simpan
					</button>
				</form>
			</div>
		</div>
	</div>

</div>
@endsection