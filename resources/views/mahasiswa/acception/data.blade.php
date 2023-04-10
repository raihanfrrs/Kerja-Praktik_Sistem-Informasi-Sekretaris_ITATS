@if ($acceptions->count() == 0)
    <div class="alert alert-danger mx-2 text-center" role="alert">
        No request is being processed!
    </div>
@else
    @foreach ($acceptions as $acception)
      <div class="col-md-4">
          <div class="c-card-1 p-3 mb-4">
              <div class="d-flex justify-content-between">
                  <div class="d-flex flex-row align-items-center">
                      <div class="c-icon"> <i class="bi bi-send"></i> </div>
                      <div class="ms-2 c-details">
                          <h6 class="mb-0 fw-bold">Request #{{ $loop->iteration }}</h6> <span>{{ $acception->created_at->diffForHumans() }}</span>
                      </div>
                  </div>
                  <div class="c-badge"> 
                    @if ($acception->status === 'unfinished')
                        <span class="badge text-bg-warning text-white">Pending</span>
                    @elseif ($acception->status === 'processed')
                        <span class="badge text-bg-primary">Processed</span>
                    @elseif ($acception->status === 'finished')
                        <span class="badge text-bg-success">Finished</span>
                    @elseif ($acception->status === 'canceled' || $acception->status === 'rejected')
                        <span class="badge text-bg-danger">{{ $acception->status }}</span>
                    @endif
                  </div>
              </div>
              <div class="mt-2">
                  <div class="accordion accordion-flush" id="accordionFlush-{{ $acception->id }}">
                    <div class="accordion-item">
                      <h2 class="accordion-header" id="flush-heading-{{ $acception->id }}">
                        <button class="accordion-button collapsed fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapse-{{ $acception->id }}" aria-expanded="false" aria-controls="flush-collapse-{{ $acception->id }}">
                          Request Detail
                        </button>
                      </h2>
                      <div id="flush-collapse-{{ $acception->id }}" class="accordion-collapse collapse" aria-labelledby="flush-heading-{{ $acception->id }}" data-bs-parent="#accordionFlush-{{ $acception->id }}">
                        <div class="accordion-body">
                          <div class="list-group">
                            @php
                                $applied = 0;
                            @endphp
                            @foreach ($acception->detail_request as $item)
                              <a href="#" class="list-group-item list-group-item-action" aria-current="true">
                                <div class="d-flex w-100 justify-content-between">
                                  <h5 class="mb-1 fw-bold">{{ $item->Surat->name }}</h5>
                                  <small>
                                    @if ($item->status === 'pending')
                                      <span class="badge text-bg-warning text-white">Pending</span>
                                    @elseif ($item->status === 'accepted')
                                      <span class="badge text-bg-primary">Processed</span>
                                    @elseif ($item->status === 'done')
                                      @php
                                          $applied++; 
                                      @endphp
                                      <span class="badge text-bg-success">Finished</span>
                                    @elseif ($item->status === 'canceled' || $item->status === 'rejected')
                                      <span class="badge text-bg-danger">{{ $item->status }}</span>
                                    @endif
                                  </small>
                                </div>
                                <small>{{ $item->Surat->jenis_surat->jenis }}</small>
                              </a>
                            @endforeach
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                <div class="mt-2">
                    <div class="progress">
                      @if ($acception->status === 'unfinished')
                        <div class="progress-bar progress-bar-striped bg-warning progress-bar-animated" role="progressbar" style="width: 10%" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                      @elseif ($acception->status === 'processed')
                        <div class="progress-bar progress-bar-striped bg-primary progress-bar-animated" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                      @elseif ($acception->status === 'finished')
                        <div class="progress-bar bg-success" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                      @elseif ($acception->status === 'canceled' || $acception->status === 'rejected')
                        <div class="progress-bar bg-danger" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                      @endif
                  </div>
                  <div class="mt-3">
                    <div class="d-flex justify-content-between">
                      <div class="d-flex flex-row align-items-center">
                        <span class="text1">{{ $applied }} Applied <span class="text2">of {{ $acception->amount }} Amount</span></span>
                      </div>
                      @if ($acception->status === 'finished')
                        <a href="/acception/{{ $acception->request_id }}" class="text1">Detail</a>
                      @endif
                    </div>
                  </div>
              </div>
            </div>
          </div>
      </div>
    @endforeach
@endif