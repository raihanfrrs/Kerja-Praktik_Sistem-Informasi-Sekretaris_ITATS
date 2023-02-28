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

                <li><a class="dropdown-item mahasiswa" href="#" id="day">Today</a></li>
                <li><a class="dropdown-item mahasiswa" href="#" id="month">This Month</a></li>
                <li><a class="dropdown-item mahasiswa" href="#" id="year">This Year</a></li>
            </ul>
            </div>

            <div class="card-body">
            <h5 class="card-title">Mahasiswa <span>|</span> <span id="mahasiswa-date">Today</span></h5>

            <div class="d-flex align-items-center">
                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                    <i class="bi bi-people"></i>
                </div>
                <div class="ps-3">
                <h6 id="amount-mahasiswa"></h6>
                <span class="text-success small pt-1 fw-bold" id="percent-mahasiswa"></span> <span class="text-muted small pt-2 ps-1">increase</span>
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

                <li><a class="dropdown-item dosen" href="#" id="day">Today</a></li>
                <li><a class="dropdown-item dosen" href="#" id="month">This Month</a></li>
                <li><a class="dropdown-item dosen" href="#" id="year">This Year</a></li>
            </ul>
            </div>

            <div class="card-body">
            <h5 class="card-title">Dosen <span>|</span> <span id="date-dosen">Today</span></h5>

            <div class="d-flex align-items-center">
                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                    <i class="bi bi-people-fill"></i>
                </div>
                <div class="ps-3">
                <h6 id="amount-dosen"></h6>
                <span class="text-success small pt-1 fw-bold" id="percent-dosen"></span> <span class="text-muted small pt-2 ps-1">increase</span>

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

                <li><a class="dropdown-item request" href="#" id="day">Today</a></li>
                <li><a class="dropdown-item request" href="#" id="month">This Month</a></li>
                <li><a class="dropdown-item request" href="#" id="year">This Year</a></li>
            </ul>
            </div>

            <div class="card-body">
            <h5 class="card-title">Request <span>|</span> <span id="date-request">Today</span></h5>

            <div class="d-flex align-items-center">
                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                    <i class="bi bi-envelope-open"></i>
                </div>
                <div class="ps-3">
                <h6 id="amount-request"></h6>
                <span class="text-success small pt-1 fw-bold" id="percent-request"></span> <span class="text-muted small pt-2 ps-1">increase</span>

                </div>
            </div>

            </div>
        </div>

        </div>

    </div>
    </div>

    <div class="col-lg-4">

    <div class="card">
        <div class="filter">
        <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
            <li class="dropdown-header text-start">
            <h6>Filter</h6>
            </li>

            <li><a class="dropdown-item request-activity" href="#" id="day">Today</a></li>
            <li><a class="dropdown-item request-activity" href="#" id="month">This Month</a></li>
            <li><a class="dropdown-item request-activity" href="#" id="year">This Year</a></li>
        </ul>
        </div>

        <div class="card-body pb-0">
        <h5 class="card-title">Request Activity <span>|</span> <span id="date-request-activity">Today</span></h5>

        <div class="news">
            <div id="data-request-activity"></div>
        </div>

        </div>
    </div>

</div>