@if (auth()->user()->level == 'mahasiswa')
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


@elseif (auth()->user()->level == 'dosen')
<li class="nav-item">
    <a class="nav-link {{ request()->is('receive', 'assign') ? '' : 'collapsed' }}" data-bs-target="#keperluan-dosen-nav" data-bs-toggle="collapse" href="#">
        <i class="bi bi-journals"></i><span>Keperluan</span><i class="bi bi-chevron-down ms-auto"></i>
    </a>
    <ul id="keperluan-dosen-nav" class="nav-content collapse {{ request()->is('receive', 'assign') ? 'show' : '' }}" data-bs-parent="#sidebar-nav">
        <li>
            <a href="/receive" class="{{ request()->is('receive') ? 'active':'' }}">
                <i class="bi bi-circle"></i><span>Terima Surat</span>
            </a>
        </li>
        <li>
            <a href="/assign" class="{{ request()->is('assign') ? 'active':'' }}">
                <i class="bi bi-circle"></i><span>Kirim Surat</span>
            </a>
        </li>
    </ul>
</li>

<li class="nav-item">
    <a class="nav-link collapsed" href="/history">
    <i class="bi bi-inboxes"></i>
    <span>Riwayat</span>
    </a>
</li>


@elseif (auth()->user()->level == 'superadmin')
<li class="nav-item">
    <a class="nav-link {{ request()->is('master/*') ? '' : 'collapsed' }}" data-bs-target="#master-super-nav" data-bs-toggle="collapse" href="#">
        <i class="bi bi-collection"></i><span>Data Master</span><i class="bi bi-chevron-down ms-auto"></i>
    </a>
    <ul id="master-super-nav" class="nav-content collapse {{ request()->is('mahasiswa', 'mahasiswa/*', 'dosen', 'dosen/*', 'category', 'category/*', 'surat', 'surat/*','role', 'role/*') ? 'show' : '' }}" data-bs-parent="#sidebar-nav">
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
            <a href="{{ url('category') }}" class="{{ request()->is('category', 'category/*') ? 'active' : '' }}">
                <i class="bi bi-circle"></i><span>Category</span>
            </a>
        </li>
        <li>
            <a href="{{ url('surat') }}" class="{{ request()->is('surat' ,'surat/*') ? 'active' : '' }}">
                <i class="bi bi-circle"></i><span>Surat</span>
            </a>
        </li>
        <li>
            <a href="{{ url('role') }}" class="{{ request()->is('role' ,'role/*') ? 'active' : '' }}">
                <i class="bi bi-circle"></i><span>Role</span>
            </a>
        </li>
    </ul>
</li>
@endif