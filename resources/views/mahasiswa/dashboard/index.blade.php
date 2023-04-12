<div class="col-lg-8">
  <div class="row">

      <div class="col-xxl-4 col-md-6">
      <div class="card info-card sales-card">

          <div class="filter">
          <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
              <li class="dropdown-header text-start">
              <h6>Filter</h6>
              </li>

              <li><a class="dropdown-item request-out" href="#" id="day">Today</a></li>
              <li><a class="dropdown-item request-out" href="#" id="month">This Month</a></li>
              <li><a class="dropdown-item request-out" href="#" id="year">This Year</a></li>
          </ul>
          </div>

          <div class="card-body">
          <h5 class="card-title">Request Out <span>|</span> <span id="date-request-out">Today</span></h5>

          <div class="d-flex align-items-center">
              <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                <i class="bi bi-journal-arrow-up"></i>
              </div>
              <div class="ps-3">
              <h6 id="amount-request-out"></h6>
              <span class="text-success small pt-1 fw-bold" id="percent-request-out"></span> <span class="text-muted small pt-2 ps-1">increase</span>
              </div>
          </div>
          </div>

      </div>
      </div>

      <div class="col-xxl-4 col-md-6">
      <div class="card info-card revenue-card">

          <div class="filter">
          <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
              <li class="dropdown-header text-start">
              <h6>Filter</h6>
              </li>

              <li><a class="dropdown-item request-in-mahasiswa" href="#" id="day">Today</a></li>
              <li><a class="dropdown-item request-in-mahasiswa" href="#" id="month">This Month</a></li>
              <li><a class="dropdown-item request-in-mahasiswa" href="#" id="year">This Year</a></li>
          </ul>
          </div>

          <div class="card-body">
          <h5 class="card-title">Request In <span>|</span> <span id="date-request-in-mahasiswa">Today</span></h5>

          <div class="d-flex align-items-center">
              <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                <i class="bi bi-journal-arrow-down"></i>
              </div>
              <div class="ps-3">
              <h6 id="amount-request-in-mahasiswa"></h6>
              <span class="text-success small pt-1 fw-bold" id="percent-request-in-mahasiswa"></span> <span class="text-muted small pt-2 ps-1">increase</span>

              </div>
          </div>
          </div>

      </div>
      </div>

      <div class="col-xxl-4 col-xl-12">

      <div class="card info-card customers-card">

          <div class="filter">
          <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
              <li class="dropdown-header text-start">
              <h6>Filter</h6>
              </li>

              <li><a class="dropdown-item request-reject" href="#" id="day">Today</a></li>
              <li><a class="dropdown-item request-reject" href="#" id="month">This Month</a></li>
              <li><a class="dropdown-item request-reject" href="#" id="year">This Year</a></li>
          </ul>
          </div>

          <div class="card-body">
          <h5 class="card-title">Rejected <span>|</span> <span id="date-request-reject">Today</span></h5>

          <div class="d-flex align-items-center">
              <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                <i class="bi bi-envelope-exclamation"></i>
              </div>
              <div class="ps-3">
              <h6 id="amount-request-reject"></h6>
              <span class="text-success small pt-1 fw-bold" id="percent-request-reject"></span> <span class="text-muted small pt-2 ps-1">increase</span>

              </div>
          </div>

          </div>
      </div>

      </div>

  </div>
  </div>

  <div class="col-lg-4">

    <div class="card">
        <div class="card-body">
          <h5 class="card-title">Recent Activity</h5>

          <div class="activity" id="activity">
          </div>

        </div>
      </div>

</div>