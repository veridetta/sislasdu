<li class="navigation-header">
    <span>Menu</span>
    <i data-feather="more-horizontal"></i>
  </li>

@if (auth()->user()->role=='admin')
<li class="nav-item {{(request()->is('admin'))? 'active' : ''}}">
    <a href="{{route('dashboard-admin')}}" class="d-flex align-items-center" target="_self">
        <i data-feather="home"></i>
        <span class="menu-title text-truncate">Dashboard</span>
    </a>
</li>
<li class="nav-item has-sub {{(request()->is('admin/m/*'))? ' open' : ''}}">
    <a href="#" class="d-flex align-items-center" target="_self">
        <i data-feather="briefcase"></i>
        <span class="menu-title text-truncate">Master Data</span>
    </a>
    <ul class="menu-content">
        <li class="{{(request()->is('admin/m/aparat'))? 'active' : ''}}">
            <a href="{{route('aparat-admin')}}" class="d-flex align-items-center" target="_self">
                <i data-feather="briefcase"></i>
                <span class="menu-title text-truncate">Aparat Desa</span>
            </a>
        </li>
        <li class="{{(request()->is('admin/m/rtrw'))? 'active' : ''}}">
            <a href="{{route('rtrw-admin')}}" class="d-flex align-items-center" target="_self">
                <i data-feather="briefcase"></i>
                <span class="menu-title text-truncate">Ketua RT/RW</span>
            </a>
        </li>
        <li class="{{(request()->is('admin/m/jenissurat'))? 'active' : ''}}">
            <a href="{{route('jenissurat-admin')}}" class="d-flex align-items-center" target="_self">
                <i data-feather="briefcase"></i>
                <span class="menu-title text-truncate">Jenis Surat</span>
            </a>
        </li>
    </ul>
</li>
<li class="nav-item has-sub {{(request()->is('admin/d/*'))? ' open' : ''}}">
    <a href="#" class="d-flex align-items-center" target="_self">
        <i data-feather="users"></i>
        <span class="menu-title text-truncate">Data Warga</span>
    </a>
    <ul class="menu-content">
        <li class="{{(request()->is('admin/d/warga'))? 'active' : ''}}">
            <a href="{{route('warga-admin')}}" class="d-flex align-items-center" target="_self">
                <i data-feather="users"></i>
                <span class="menu-title text-truncate">Warga</span>
            </a>
        </li>
        <li class="{{(request()->is('admin/d/rt'))? 'active' : ''}}">
            <a href="{{route('rt-admin')}}" class="d-flex align-items-center" target="_self">
                <i data-feather="users"></i>
                <span class="menu-title text-truncate">Ketua RT</span>
            </a>
        </li>
        <li class="{{(request()->is('admin/d/rw'))? 'active' : ''}}">
            <a href="{{route('rw-admin')}}" class="d-flex align-items-center" target="_self">
                <i data-feather="users"></i>
                <span class="menu-title text-truncate">Ketua RW</span>
            </a>
        </li>
    </ul>
</li>
<li class="nav-item {{(request()->is('admin/l/surat'))? 'active' : ''}}">
    <a href="{{route('surat-admin')}}" class="d-flex align-items-center" target="_self">
        <i data-feather="mail"></i>
        <span class="menu-title text-truncate">Layanan Surat</span>
    </a>
</li>
<li class="nav-item {{(request()->is('admin/l/pengaduan'))? 'active' : ''}}">
    <a href="{{route('pengaduan-admin')}}" class="d-flex align-items-center" target="_self">
        <i data-feather="folder"></i>
        <span class="menu-title text-truncate">Data Pengaduan</span>
    </a>
</li>
<li class="nav-item {{(request()->is('admin/info'))? 'active' : ''}}">
    <a href="{{route('info-admin')}}" class="d-flex align-items-center" target="_self">
        <i data-feather="info"></i>
        <span class="menu-title text-truncate">Informasi Desa</span>
    </a>
</li>
<li class="nav-item has-sub {{(request()->is('admin/r/*'))? ' open' : ''}}">
    <a href="#" class="d-flex align-items-center" target="_self">
        <i data-feather="check-circle"></i>
        <span class="menu-title text-truncate">Laporan</span>
    </a>
    <ul class="menu-content">
        <li class=" {{(request()->is('admin/r/lap_surat'))? 'active' : ''}}">
            <a href="{{route('lap_surat-admin')}}" class="d-flex align-items-center" target="_self">
                <i data-feather="mail"></i>
                <span class="menu-title text-truncate">Laporan Surat Warga</span>
            </a>
        </li>
        <li class=" {{(request()->is('admin/r/lap_pengaduan'))? 'active' : ''}}">
            <a href="{{route('lap_pengaduan-admin')}}" class="d-flex align-items-center" target="_self">
                <i data-feather="users"></i>
                <span class="menu-title text-truncate">Laporan Pengaduan</span>
            </a>
        </li>
    </ul>
</li>
@elseif (auth()->user()->role=='kades')
<li class="nav-item {{(request()->is('kades'))? 'active' : ''}}">
    <a href="{{route('dashboard-kades')}}" class="d-flex align-items-center" target="_self">
        <i data-feather="home"></i>
        <span class="menu-title text-truncate">Dashboard</span>
    </a>
</li>
<li class="nav-item has-sub {{(request()->is('kades/m/*'))? ' open' : ''}}">
    <a href="#" class="d-flex align-items-center" target="_self">
        <i data-feather="briefcase"></i>
        <span class="menu-title text-truncate">Master Data</span>
    </a>
    <ul class="menu-content">
        <li class="{{(request()->is('kades/m/aparat'))? 'active' : ''}}">
            <a href="{{route('aparat-kades')}}" class="d-flex align-items-center" target="_self">
                <i data-feather="briefcase"></i>
                <span class="menu-title text-truncate">Aparat Desa</span>
            </a>
        </li>
        <li class="{{(request()->is('kades/m/rtrw'))? 'active' : ''}}">
            <a href="{{route('rtrw-kades')}}" class="d-flex align-items-center" target="_self">
                <i data-feather="briefcase"></i>
                <span class="menu-title text-truncate">Ketua RT/RW</span>
            </a>
        </li>
        <li class="{{(request()->is('kades/m/jenissurat'))? 'active' : ''}}">
            <a href="{{route('jenissurat-kades')}}" class="d-flex align-items-center" target="_self">
                <i data-feather="briefcase"></i>
                <span class="menu-title text-truncate">Jenis Surat</span>
            </a>
        </li>
    </ul>
</li>
<li class="{{(request()->is('kades/d/warga'))? 'active' : ''}}">
    <a href="{{route('warga-kades')}}" class="d-flex align-items-center" target="_self">
        <i data-feather="users"></i>
        <span class="menu-title text-truncate">Data Warga</span>
    </a>
</li>
<li class="nav-item has-sub {{(request()->is('kades/r/*'))? ' open' : ''}}">
    <a href="#" class="d-flex align-items-center" target="_self">
        <i data-feather="check-circle"></i>
        <span class="menu-title text-truncate">Laporan</span>
    </a>
    <ul class="menu-content">
        <li class=" {{(request()->is('kades/r/lap_surat'))? 'active' : ''}}">
            <a href="{{route('lap_surat-kades')}}" class="d-flex align-items-center" target="_self">
                <i data-feather="mail"></i>
                <span class="menu-title text-truncate">Laporan Rekapitulasi Surat Warga</span>
            </a>
        </li>
        <li class=" {{(request()->is('admin/r/lap_pengaduan'))? 'active' : ''}}">
            <a href="{{route('lap_pengaduan-admin')}}" class="d-flex align-items-center" target="_self">
                <i data-feather="users"></i>
                <span class="menu-title text-truncate">Laporan Pengaduan</span>
            </a>
        </li>
    </ul>
</li>
@elseif (auth()->user()->role=='rt' or auth()->user()->role=='rw')
<li class="nav-item {{(request()->is('rtrw'))? 'active' : ''}}">
    <a href="{{route('dashboard-rtrw')}}" class="d-flex align-items-center" target="_self">
        <i data-feather="home"></i>
        <span class="menu-title text-truncate">Dashboard</span>
    </a>
</li>
<li class="{{(request()->is('rtrw/d/warga'))? 'active' : ''}}">
    <a href="{{route('warga-rtrw')}}" class="d-flex align-items-center" target="_self">
        <i data-feather="users"></i>
        <span class="menu-title text-truncate">Data Warga</span>
    </a>
</li>
<li class="nav-item {{(request()->is('admin/l/surat'))? 'active' : ''}}">
    <a href="{{route('surat-admin')}}" class="d-flex align-items-center" target="_self">
        <i data-feather="mail"></i>
        <span class="menu-title text-truncate">Layanan Surat</span>
    </a>
</li>
<li class="nav-item {{(request()->is('rtrw/l/pengaduan'))? 'active' : ''}}">
    <a href="{{route('pengaduan-rtrw')}}" class="d-flex align-items-center" target="_self">
        <i data-feather="folder"></i>
        <span class="menu-title text-truncate">Data Pengaduan</span>
    </a>
</li>
@elseif (auth()->user()->role=='warga')
<li class="nav-item {{(request()->is('warga'))? 'active' : ''}}">
    <a href="{{route('dashboard-warga')}}" class="d-flex align-items-center" target="_self">
        <i data-feather="home"></i>
        <span class="menu-title text-truncate">Dashboard</span>
    </a>
</li>
<li class="nav-item {{(request()->is('warga/d/*'))? 'active' : ''}}">
    <a href="{{route('warga-warga')}}" class="d-flex align-items-center" target="_self">
        <i data-feather="user"></i>
        <span class="menu-title text-truncate">Data Saya</span>
    </a>
</li>
<li class="nav-item has-sub {{(request()->is('warga/l/*'))? ' open' : ''}}">
    <a href="#" class="d-flex align-items-center" target="_self">
        <i data-feather="users"></i>
        <span class="menu-title text-truncate">Layanan</span>
    </a>
    <ul class="menu-content">
        <li class="{{(request()->is('warga/l/surat'))? 'active' : ''}}">
            <a href="{{route('surat-warga')}}" class="d-flex align-items-center" target="_self">
                <i data-feather="mail"></i>
                <span class="menu-title text-truncate">Layanan Surat</span>
            </a>
        </li>
        <li class="{{(request()->is('warga/l/pengaduan'))? 'active' : ''}}">
            <a href="{{route('pengaduan-warga')}}" class="d-flex align-items-center" target="_self">
                <i data-feather="users"></i>
                <span class="menu-title text-truncate">Layanan Pengaduan</span>
            </a>
        </li>
    </ul>
</li>
@endif