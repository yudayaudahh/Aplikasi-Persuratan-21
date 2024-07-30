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
				<form id="form" action="@if (isset($user)) {{ route('user.update', $user->id) }} @else {{ route('user.store') }} @endif" method="POST">
                    @if (isset($user))
                        @method('PUT')
                    @endif
                    @csrf
					<div class="form-group">
						<label> Nama  </label>
						<input type="text" name="name" class="form-control
                        @error('name')
                            is-invalid
                        @enderror" placeholder="Masukkan Nama user" value="{{ old('name') ?? $user->name ?? '' }}">
						@error('name')
                            <p class="invalid-feedback">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label> NIP  </label>
                        <input type="number" name="nip" class="form-control @error('nip')
                            is-invalid @enderror" placeholder="Masukkan NIP" value="{{ old('nip') ?? $user->nip ?? '' }}">
                        @error('nip')
                            <p class="invalid-feedback">{{ $message }}</p>
                        @enderror
                    </div>

					<div class="form-group">
						<label> Role  </label>
						<select type="text" name="role" class="form-control @error('role') is-invalid @enderror" >
                            <option value="" disabled selected>Pilih Role</option>
                            <option value="admin" {{ old('role') ?? $user->role ?? '' == 'admin' ? 'selected' : '' }}>Admin</option>
                            <option value="pegawai" {{ old('role') ?? $user->role ?? '' == 'pegawai' ? 'selected' : '' }}>Pegawai</option>
                        </select>
						@error('role')
                            <p class="invalid-feedback">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label> Password 
                            @if (isset($user))
                                (Isi Jika Ingin Diganti)
                            @endif
                        </label>
                        <input type="password" name="password" class="form-control @error('password')
                            is-invalid @enderror" placeholder="Masukkan Password">
                        @error('password')
                            <p class="invalid-feedback">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>Konfirmasi Password  </label>
                        <input type="password" name="confirm" class="form-control @error('confirm')
                            is-invalid @enderror" placeholder="Konfirmasi Password" >
                        @error('confirm')
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