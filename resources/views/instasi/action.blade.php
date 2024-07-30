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
				<form id="form" action="@if (isset($instasi)) {{ route('instasi.update', $instasi->id) }} @else {{ route('instasi.store') }} @endif" method="POST">
                    @if (isset($instasi))
                        @method('PUT')
                    @endif
                    @csrf
					<div class="form-group">
						<label> Nama  </label>
						<input type="text" name="nama" class="form-control
                        @error('nama')
                            is-invalid
                        @enderror" placeholder="Masukkan Nama Instasi" value="{{ old('nama') ?? $instasi->nama ?? '' }}">
						@error('nama')
                            <p class="invalid-feedback">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label> Email  </label>
                        <input type="email" name="email" class="form-control @error('email')
                            is-invalid @enderror" placeholder="Masukkan Email Instasi" value="{{ old('email') ?? $instasi->email ?? '' }}">
                        @error('email')
                            <p class="invalid-feedback">{{ $message }}</p>
                        @enderror
                    </div>

					<div class="form-group">
						<label> Alamat  </label>
						<textarea type="text" name="alamat" class="form-control @error('alamat') is-invalid @enderror" placeholder="Masukkan Alamat Instasi">{{ old('alamat') ?? $instasi->alamat ?? '' }}</textarea>
						@error('alamat')
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