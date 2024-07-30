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
				<form id="form" action="@if (isset($pegawai)) {{ route('pegawai.update', $pegawai->id) }} @else {{ route('pegawai.store') }} @endif" method="POST">
                    @if (isset($pegawai))
                        @method('PUT')
                    @endif
                    @csrf
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label> Nama  </label>
                                <input type="text" name="nama" class="form-control
                                @error('nama')
                                    is-invalid
                                @enderror" placeholder="Masukkan Nama Pegawai" value="{{ old('nama') ?? $pegawai->nama ?? '' }}">
                                @error('nama')
                                    <p class="invalid-feedback">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label> NIP  </label>
                                <input type="text" name="nip" class="form-control
                                @error('nip')
                                    is-invalid
                                @enderror" placeholder="Masukkan NIP Pegawai" value="{{ old('nip') ?? $pegawai->nip ?? '' }}">
                                @error('nip')
                                    <p class="invalid-feedback">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label> Email  </label>
                                <input type="email" name="email" class="form-control
                                @error('email')
                                    is-invalid
                                @enderror" placeholder="Masukkan Email Pegawai" value="{{ old('email') ?? $pegawai->email ?? '' }}">
                                @error('email')
                                    <p class="invalid-feedback">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label> No. Telp  </label>
                                <input type="text" name="no_telp" class="form-control
                                @error('no_telp')
                                    is-invalid
                                @enderror" placeholder="Masukkan No.Telp Pegawai" value="{{ old('no_telp') ?? $pegawai->no_telp ?? '' }}">
                                @error('no_telp')
                                    <p class="invalid-feedback">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

					<div class="form-group">
						<label> Alamat  </label>
						<textarea type="text" name="alamat" class="form-control @error('alamat') is-invalid @enderror" placeholder="Masukkan Alamat pegawai">{{ old('alamat') ?? $pegawai->alamat ?? '' }}</textarea>
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