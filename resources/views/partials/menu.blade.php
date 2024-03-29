@if (auth()->user()->level == 'mahasiswa' || auth()->user()->level == 'dosen')
<li class="nav-item">
    <a class="nav-link {{ request()->is('request', 'acception') ? '' : 'collapsed' }}" data-bs-target="#keperluan-mhs-nav" data-bs-toggle="collapse" href="#">
        <i class="bi bi-journals"></i><span>Keperluan</span><i class="bi bi-chevron-down ms-auto"></i>
    </a>
    <ul id="keperluan-mhs-nav" class="nav-content collapse {{ request()->is('request', 'acception') ? 'show' : '' }}" data-bs-parent="#sidebar-nav">
        <li>
        <a href="{{ url('request') }}" class="{{ request()->is('request') ? 'active':'' }}">
            <i class="bi bi-circle"></i><span>Minta Surat</span>
        </a>
        </li>
        <li>
        <a href="{{ url('acception') }}" class="{{ request()->is('acception') ? 'active':'' }}">
            <i class="bi bi-circle"></i><span>Terima Surat</span>
        </a>
        </li>
    </ul>
</li>

<li class="nav-item">
    <a class="nav-link {{ request()->is('history') ? '':'collapsed' }}" href="{{ url('history') }}">
    <i class="bi bi-inboxes"></i>
    <span>Riwayat</span>
    </a>
</li>


@elseif (auth()->user()->level == 'admin')
<li class="nav-item">
    <a class="nav-link {{ request()->is('receive', 'assignment') ? '' : 'collapsed' }}" data-bs-target="#keperluan-dosen-nav" data-bs-toggle="collapse" href="#">
        <i class="bi bi-journals"></i><span>Keperluan</span><i class="bi bi-chevron-down ms-auto"></i>
    </a>
    <ul id="keperluan-dosen-nav" class="nav-content collapse {{ request()->is('receive', 'assignment', 'broadcast') ? 'show' : '' }}" data-bs-parent="#sidebar-nav">
        <li>
            <a href="/receive" class="{{ request()->is('receive') ? 'active':'' }}">
                <i class="bi bi-circle"></i><span>Terima Surat</span>
            </a>
        </li>
        <li>
            <a href="/assignment" class="{{ request()->is('assignment') ? 'active':'' }}">
                <i class="bi bi-circle"></i><span>Kirim Surat</span>
            </a>
        </li>
        <li>
            <a href="/broadcast" class="{{ request()->is('broadcast') ? 'active':'' }}">
                <i class="bi bi-circle"></i><span>Siaran Surat</span>
            </a>
        </li>
    </ul>
</li>

<li class="nav-item">
    <a class="nav-link {{ request()->is('history') ? '' : 'collapsed' }}" href="/history">
    <i class="bi bi-inboxes"></i>
    <span>Riwayat</span>
    </a>
</li>


@elseif (auth()->user()->level == 'superadmin')
<li class="nav-item">
    <a class="nav-link {{ request()->is('master/*') ? '' : 'collapsed' }}" data-bs-target="#master-super-nav" data-bs-toggle="collapse" href="#">
        <i class="bi bi-collection"></i><span>Data Master</span><i class="bi bi-chevron-down ms-auto"></i>
    </a>
    <ul id="master-super-nav" class="nav-content collapse {{ request()->is('mahasiswa', 'mahasiswa/*', 'dosen', 'dosen/*', 'admin', 'admin/*','category', 'category/*', 'surat', 'surat/*') ? 'show' : '' }}" data-bs-parent="#sidebar-nav">
        <li>
            <a href="{{ url('mahasiswa') }}" class="{{ request()->is('mahasiswa', 'mahasiswa/*') ? 'active' : '' }}">
                <i class="bi bi-circle"></i><span>Mahasiswa</span>
            </a>
        </li>
        <li>
            <a href="{{ url('dosen') }}" class="{{ request()->is('dosen', 'dosen/*') ? 'active' : '' }}">
                <i class="bi bi-circle"></i><span>Dosen</span>
            </a>
        </li>
        <li>
            <a href="{{ url('admin') }}" class="{{ request()->is('admin', 'admin/*') ? 'active' : '' }}">
                <i class="bi bi-circle"></i><span>Admin</span>
            </a>
        </li>
        <li>
            <a href="{{ url('category') }}" class="{{ request()->is('category', 'category/*') ? 'active' : '' }}">
                <i class="bi bi-circle"></i><span>Jenis Surat</span>
            </a>
        </li>
        <li>
            <a href="{{ url('surat') }}" class="{{ request()->is('surat' ,'surat/*') ? 'active' : '' }}">
                <i class="bi bi-circle"></i><span>Surat</span>
            </a>
        </li>
    </ul>
</li>
@endif