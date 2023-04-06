@extends('layouts.main')

@section('section')
    @foreach ($requests as $key => $item)
        @if ($item->surat)
            <div class="col-md-3">
                <div class="card">
                    <h5 class="card-title text-center">{{ $item->Surat->name }}</h5>
                    <img src="{{ asset('/') }}assets/img/{{ $files[$key] }}" class="card-img-top w-75 h-75 mx-auto d-block mb-4" alt="...">
                    <div class="card-body">
                        <div class="accordion mb-2" id="accordion-{{ $key }}">
                            <div class="accordion-item">
                              <h2 class="accordion-header" id="heading-{{ $key }}">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-{{ $key }}" aria-expanded="false" aria-controls="collapse-{{ $key }}">
                                  Acception Detail
                                </button>
                              </h2>
                              <div id="collapse-{{ $key }}" class="accordion-collapse collapse" aria-labelledby="heading-{{ $key }}" data-bs-parent="#accordion-{{ $key }}">
                                <div class="accordion-body">
                                    <table style="width:100%">
                                        <tr>
                                          <th class="fw-normal">Send By</th>
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
        @endif
    @endforeach
@endsection