<div class="col-lg-8">
    <div class="row">

        <div class="col-xxl-4 col-md-6">
            <div class="card info-card revenue-card">
    
                <div class="card-body">
                    <h5 class="card-title">Permintaan Masuk <span>| {{ \Carbon\Carbon::now()->year }}</span></h5>
    
                    <div class="d-flex align-items-center">
                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                        <i class="bi bi-journal-arrow-down"></i>
                        </div>
                        <div class="ps-3">
                        <h6 id="amount-request-in-dosen"></h6>
                        <span class="text-success small pt-1 fw-bold" id="percent-request-in-dosen"></span> <span class="text-muted small pt-2 ps-1">Kenaikan</span>
        
                        </div>
                    </div>
                </div>
    
            </div>
        </div>
  
        <div class="col-xxl-4 col-md-6">
            <div class="card info-card sales-card">
    
                <div class="card-body">
                    <h5 class="card-title">Permintaan Keluar <span>| {{ \Carbon\Carbon::now()->year }}</span></h5>
    
                    <div class="d-flex align-items-center">
                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                        <i class="bi bi-journal-arrow-up"></i>
                        </div>
                        <div class="ps-3">
                        <h6 id="amount-request-out-dosen"></h6>
                        <span class="text-success small pt-1 fw-bold" id="percent-request-out-dosen"></span> <span class="text-muted small pt-2 ps-1">Kenaikan</span>
                        </div>
                    </div>
                </div>
    
            </div>
        </div>
  
        <div class="col-xxl-4 col-xl-12">
  
        <div class="card info-card customers-card">
  
            <div class="card-body">
                <h5 class="card-title">Permintaan Ditolak <span>| {{ \Carbon\Carbon::now()->year }}</span></h5>
  
                <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                    <i class="bi bi-envelope-exclamation"></i>
                    </div>
                    <div class="ps-3">
                    <h6 id="amount-request-reject-dosen"></h6>
                    <span class="text-success small pt-1 fw-bold" id="percent-request-reject-dosen"></span> <span class="text-muted small pt-2 ps-1">Kenaikan</span>
    
                    </div>
                </div>
  
            </div>
        </div>
  
        </div>
  
    </div>
    </div>
  
    <div class="col-lg-4">
  
        <div class="card">

            <div class="card-body pb-0">
              <h5 class="card-title">Permintaan Terbaru <span>| {{ \Carbon\Carbon::now()->year }}</span></h5>

              <div class="news" id="recent-request">
              </div>

            </div>
        </div>
  
  </div>