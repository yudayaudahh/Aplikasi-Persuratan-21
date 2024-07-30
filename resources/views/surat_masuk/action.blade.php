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
				</h4>
			</div>

			<div class="card-body">
				<form id="form" enctype="multipart/form-data" action="@if(isset($suratMasuk)) {{ route('surat-masuk.update', $suratMasuk->id) }} @else {{ route('surat-masuk.store') }} @endif" method="POST">
                    @if (isset($suratMasuk))
                        @method('PUT')
                    @endif
                    @csrf
					<div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label> Kode Surat  </label>
                                <input type="text" name="nomor_surat" class="form-control
                                @error('nomor_surat')
                                    is-invalid
                                @enderror" value="{{ old('nomor_surat') ?? $suratMasuk->nomor_surat ?? App\Models\SuratMasuk::createFormatKode() }}" readonly>
                                @error('nomor_surat')
                                    <p class="invalid-feedback">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label> Tanggal Masuk  </label>
                                <input type="date" name="tanggal_masuk" class="form-control @error('tanggal_masuk')
                                    is-invalid @enderror" value="{{ old('tanggal_masuk') ?? $suratMasuk->tanggal_masuk ?? date('Y-m-d') }}">
                                @error('email')
                                    <p class="invalid-feedback">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>


                        <div class="col-lg-6">
                            <div class="form-group">
                                <label> Perihal  </label>
                                <select name="id_kategori" class="form-control">
                                    <option value=""></option>
                                    @if (isset($suratMasuk))
                                        @foreach (App\Models\Kategori::all() as $item)
                                            <option value="{{ $item->id }}"  {{ $item->id == $suratMasuk->id_kategori ? 'selected' : '' }}>{{ $item->nama }}</option>
                                        @endforeach
                                    @else
                                        @foreach (App\Models\Kategori::all() as $item)
                                            <option value="{{ $item->id }}">{{ $item->nama }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                        
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label> Asal Surat  </label>
                                <select name="id_instasi" class="form-control">
                                    <option value=""></option>
                                    @if (isset($suratMasuk))
                                        @foreach (App\Models\Instasi::all() as $item)
                                            <option value="{{ $item->id }}" {{ $item->id == $suratMasuk->id_instasi ?'selected' : '' }}>{{ $item->nama }}</option>
                                        @endforeach
                                    @else
                                        @foreach (App\Models\Instasi::all() as $item)
                                            <option value="{{ $item->id }}">{{ $item->nama }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                    </div>
                    

					<div class="form-group">
						<label> File  </label>
						<input type="file" name="file" class="form-control @error('file') is-invalid @enderror">
						@error('file')
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

@section('scripts')
<script>
    $(function(){
        $(`[name="id_kategori"]`).select2({
            placeholder: "Pilih Perihal",
            allowClear: true
        })

        $(`[name="id_instasi"]`).select2({
            placeholder: "Pilih Penerima",
            allowClear: true
        })
    })
</script>
    
@endsection