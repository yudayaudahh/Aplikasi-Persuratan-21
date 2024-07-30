@if ( auth()->user()->role  == 'admin')
	@include('layouts.menu.admin')
@else
	@include('layouts.menu.pegawai')
@endif