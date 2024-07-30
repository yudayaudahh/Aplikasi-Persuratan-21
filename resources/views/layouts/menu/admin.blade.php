<li class="nav-item">
	<a href="{{ route('dashboard') }}">
		<i class="fas fa-home"></i>
		<p> Dashboard </p>
	</a>
</li>

<li class="nav-section">
	<h4 class="text-section"> Menu </h4>
</li>

<li class="nav-item">
    <a href="{{ route('pegawai') }}">
        <i class="fas fa-address-book"></i>
        <p> Pegawai </p>
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('instasi') }}">
        <i class="fas fa-hotel"></i>
        <p> Instasi </p>
    </a>
</li>

<li class="nav-section">
	<span class="sidebar-mini-icon">
	<i class="fa fa-ellipsis-h"></i>
	</span>
	<h4 class="text-section"> Surat </h4>
</li>

<li class="nav-item">
	<a href="{{ route('kategori') }}">
		<i class="fas fa-layer-group"></i>
		<p> Kategori </p>
	</a>
</li>

<li class="nav-item">
	<a href="{{ route('surat-masuk') }}">
		<i class="fas fa-book"></i>
		<p> Surat Masuk </p>
	</a>
</li>

<li class="nav-item">
	<a href="{{ route('surat-keluar') }}">
		<i class="fas fa-book-open"></i>
		<p> Surat Keluar </p>
	</a>
</li>

<li class="nav-section">
	<span class="sidebar-mini-icon">
	<i class="fa fa-ellipsis-h"></i>
	</span>
	<h4 class="text-section"> Profile </h4>
</li>

<li class="nav-item">
	<a href="{{ route('user') }}">
		<i class="fas fa-user"></i>
		<p> Akun </p>
	</a>
</li>

<li class="nav-item">
	<a href="{{ route('logout') }}">
		<i class="fas fa-sign-out-alt"></i>
		<p> Log out </p>
	</a>
</li>
