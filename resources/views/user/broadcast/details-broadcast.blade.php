@extends('layouts.main')

@section('section')
    @foreach ($files as $key => $item)
    <div class="col-md-3">
        <div class="card">
            <h5 class="card-title text-center">{{ $names[$key] }}</h5>
            <img src="{{ asset('/') }}assets/img/{{ $icon[$key] }}" class="card-img-top w-75 h-75 mx-auto d-block mb-4" alt="...">
            <div class="card-body">
                <div class="accordion mb-2" id="accordion-{{ $key }}">
                    <div class="accordion-item">
                    <h2 class="accordion-header" id="heading-{{ $key }}">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-{{ $key }}" aria-expanded="false" aria-controls="collapse-{{ $key }}">
                        Rincian
                        </button>
                    </h2>
                    <div id="collapse-{{ $key }}" class="accordion-collapse collapse" aria-labelledby="heading-{{ $key }}" data-bs-parent="#accordion-{{ $key }}">
                        <div class="accordion-body">
                        <table style="width:100%">
                            <tr>
                                <th class="fw-normal">Dikirim</th>
                                <td class="text-end fw-bold"><small>{{ $broadcast->user->dosen->name }}</small></td>
                            </tr>
                            <tr>
                                <th class="fw-normal">Kontak</th>
                                <td class="text-end fw-bold"><a href="https://api.whatsapp.com/send?phone={{ contact($broadcast->user->dosen->phone) }}" target="_blank" class="text-success" title="{{ $broadcast->user->dosen->phone }}"><small><i class="bi bi-whatsapp"></i> WhatsApp</small></a></td>
                            </tr>
                            <tr>
                                <th class="fw-normal">Diperbaharui</th>
                                <td class="text-end fw-bold fst-italic"><small>{{ $broadcast->updated_at->diffForHumans() }}</small></td>
                            </tr>
                        </table>
                        </div>
                    </div>
                    </div>
                </div>
                <div class="col-12">
                    <p class="card-text"><a href="/acception/broadcast/download/{{ $broadcast->id }}/{{ $key }}" class="btn btn-primary btn-md w-100"><i class="bi bi-download"></i> Unduh</a></p>
                </div>
            </div>
        </div>
    </div>
    @endforeach
@endsection