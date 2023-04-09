@extends('layouts.main')

@section('section')
    @foreach ($requestsNotNull as $key => $item)
      <div class="col-md-3">
          <div class="card">
              <h5 class="card-title text-center">{{ $item->Surat->name }}</h5>
              <img src="{{ asset('/') }}assets/img/{{ $files[$key] }}" class="card-img-top w-75 h-75 mx-auto d-block mb-4" alt="...">
              <div class="card-body">
                  <div class="accordion mb-2" id="accordion-{{ $item->id }}">
                      <div class="accordion-item">
                        <h2 class="accordion-header" id="heading-{{ $item->id }}">
                          <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-{{ $item->id }}" aria-expanded="false" aria-controls="collapse-{{ $item->id }}">
                            Acception Detail
                          </button>
                        </h2>
                        <div id="collapse-{{ $item->id }}" class="accordion-collapse collapse" aria-labelledby="heading-{{ $item->id }}" data-bs-parent="#accordion-{{ $item->id }}">
                          <div class="accordion-body">
                              <table style="width:100%">
                                  <tr>
                                    <th class="fw-normal">Dikirim</th>
                                    <td class="text-end fw-bold">{{ $item->dosen->name }}</td>
                                  </tr>
                                  <tr>
                                    <th class="fw-normal">Updated</th>
                                    <td class="text-end fw-bold fst-italic">{{ $item->updated_at->diffForHumans() }}</td>
                                  </tr>
                              </table>
                          </div>
                        </div>
                      </div>
                  </div>
                  <div class="col-12">
                      <p class="card-text"><a href="/acception/download/{{ $item->id }}" class="btn btn-primary btn-md w-100"><i class="bi bi-download"></i> Download</a></p>
                  </div>
              </div>
          </div>
      </div>
    @endforeach

    @foreach ($requestsNull as $key => $item)
      <div class="col-md-3">
          <div class="card">
              <h5 class="card-title text-center">{{ $item->Surat->name }}</h5>
              <img src="{{ asset('/') }}assets/img/rejected.png" class="card-img-top w-75 h-75 mx-auto d-block mb-4" alt="...">
              <div class="card-body">
                  <div class="accordion mb-2" id="accordion-{{ $item->id }}">
                      <div class="accordion-item">
                        <h2 class="accordion-header" id="heading-{{ $item->id }}">
                          <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-{{ $item->id }}" aria-expanded="false" aria-controls="collapse-{{ $item->id }}">
                            Acception Detail
                          </button>
                        </h2>
                        <div id="collapse-{{ $item->id }}" class="accordion-collapse collapse" aria-labelledby="heading-{{ $item->id }}" data-bs-parent="#accordion-{{ $item->id }}">
                          <div class="accordion-body">
                              <table style="width:100%">
                                  <tr>
                                    <th class="fw-normal">Ditolak</th>
                                    <td class="text-end fw-bold">{{ $item->dosen->name }}</td>
                                  </tr>
                                  <tr>
                                    <th class="fw-normal">Updated</th>
                                    <td class="text-end fw-bold fst-italic">{{ $item->updated_at->diffForHumans() }}</td>
                                  </tr>
                              </table>
                          </div>
                        </div>
                      </div>
                  </div>
                  <div class="col-12">
                      <p class="card-text"><a href="#" class="btn btn-primary btn-md w-100 disabled"><i class="bi bi-download"></i> Download</a></p>
                  </div>
              </div>
          </div>
      </div>
    @endforeach
@endsection