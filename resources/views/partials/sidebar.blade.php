<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

      <li class="nav-item">
        <a class="nav-link {{ count(Request::segments()) == 0 ? '' : 'collapsed' }}" href="{{ url('/') }}">
          <i class="bi bi-grid"></i>
          <span>Dashboard</span>
        </a>
      </li>

      @include('partials.menu')
    </ul>
</aside><!-- End Sidebar-->