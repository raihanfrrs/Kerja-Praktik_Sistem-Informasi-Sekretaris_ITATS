@if (auth()->user()->level == 'mahasiswa')
<li class="nav-item">
    <a class="nav-link {{ request()->is('Request') ? '' : (request()->is('Accept') ? '' : 'collapsed') }}" data-bs-target="#keperluan-mhs-nav" data-bs-toggle="collapse" href="#">
        <i class="bi bi-journals"></i><span>Keperluan</span><i class="bi bi-chevron-down ms-auto"></i>
    </a>
    <ul id="keperluan-mhs-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
        <li>
        <a href="{{ url('keperluan/request') }}" class="{{ request()->is('keperluan/request') ? 'active':'' }}" >
            <i class="bi bi-circle"></i><span>Minta Surat</span>
        </a>
        </li>
        <li>
        <a href="{{ url('keperluan/accept') }}" class="{{ request()->is('keperluan/accept') ? 'active':'' }}">
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


@elseif (auth()->user()->level == 'dosen')
<li class="nav-item">
    <a class="nav-link collapsed" data-bs-target="#master-dosen-nav" data-bs-toggle="collapse" href="#">
        <i class="bi bi-collection"></i><span>Data Master</span><i class="bi bi-chevron-down ms-auto"></i>
    </a>
    <ul id="master-dosen-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
        <li>
        <a href="icons-bootstrap.html">
            <i class="bi bi-circle"></i><span>Surat</span>
        </a>
        </li>
    </ul>
</li>

<li class="nav-item">
    <a class="nav-link collapsed" data-bs-target="#keperluan-dosen-nav" data-bs-toggle="collapse" href="#">
        <i class="bi bi-journals"></i><span>Keperluan</span><i class="bi bi-chevron-down ms-auto"></i>
    </a>
    <ul id="keperluan-dosen-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
        <li>
        <a href="icons-bootstrap.html">
            <i class="bi bi-circle"></i><span>Kirim Surat</span>
        </a>
        </li>
        <li>
        <a href="icons-bootstrap.html">
            <i class="bi bi-circle"></i><span>Terima Surat</span>
        </a>
        </li>
    </ul>
</li>

<li class="nav-item">
    <a class="nav-link collapsed" href="index.html">
    <i class="bi bi-inboxes"></i>
    <span>Riwayat</span>
    </a>
</li>


@elseif (auth()->user()->level == 'superadmin')
<li class="nav-item">
    <a class="nav-link {{ request()->is('master/*') ? '' : 'collapsed' }}" data-bs-target="#master-super-nav" data-bs-toggle="collapse" href="#">
        <i class="bi bi-collection"></i><span>Data Master</span><i class="bi bi-chevron-down ms-auto"></i>
    </a>
    <ul id="master-super-nav" class="nav-content collapse {{ request()->is('mahasiswa', 'mahasiswa/*', 'dosen', 'dosen/*', 'surat', 'surat/*') ? 'show' : '' }}" data-bs-parent="#sidebar-nav">
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
            <a href="{{ url('surat') }}" class="{{ request()->is('surat' ,'surat/*') ? 'active' : '' }}">
                <i class="bi bi-circle"></i><span>Surat</span>
            </a>
        </li>
    </ul>
</li>

<li class="nav-item">
    <a class="nav-link collapsed" href="index.html">
    <i class="bi bi-inboxes"></i>
    <span>Riwayat</span>
    </a>
</li>
@endif