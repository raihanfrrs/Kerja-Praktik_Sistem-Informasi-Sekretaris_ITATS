@extends('layouts.main')

@section('section')
<div class="col-md-3">
    <div class="card">
        <div class="card-body">
    
          <h5 class="card-title">Rincian <span>| {{ $request->user->level === 'mahasiswa' ? 'Mahasiswa' : 'Dosen' }}</span></h5>
    
            <div class="profile-card pt-2 d-flex flex-column align-items-center">
                    <img src="{{ asset('/') }}assets/img/profile-img.jpg" class="img-fluid rounded">
                    <h2 class="mt-3 card-title text-center fs-4">{{ $request->user->level === 'mahasiswa' ? $request->user->mahasiswa->name : $request->user->dosen->name }}</h2>
            </div>

            <div class="profile-card">
                <div class="accordion accordion-flush" id="accordionFlushExample">
                    <div class="accordion-item">
                      <h2 class="accordion-header" id="flush-headingOne">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                          Informasi {{ $request->user->level === 'mahasiswa' ? 'Mahasiswa' : 'Dosen' }}
                        </button>
                      </h2>
                      <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                        <div class="accordion-body">
                            <table style="width:100%" class="mb-4">
                                <tr>
                                  <th class="fw-normal">{{ $request->user->level === 'mahasiswa' ? 'NPM' : 'NIP' }}</th>
                                  <td class="text-end fw-bold">{{ $request->user->level === 'mahasiswa' ? $request->user->mahasiswa->npm : $request->user->dosen->nip }}</td>
                                </tr>
                                <tr>
                                  <th class="fw-normal">Nomor HP</th>
                                  <td class="text-end fw-bold"><a href="https://api.whatsapp.com/send?phone={{ contact($request->user->level === 'mahasiswa' ? $request->user->mahasiswa->phone : $request->user->dosen->phone) }}" target="_blank" class="text-success" title="{{ $request->user->level === 'mahasiswa' ? $request->user->mahasiswa->phone : $request->user->dosen->phone }}"><i class="bi bi-whatsapp"></i> WhatsApp</a></td>
                                </tr>
                                <tr>
                                  <th class="fw-normal">Email</th>
                                  <td class="text-end fw-bold fst-italic">{{ $request->user->level === 'mahasiswa' ? $request->user->mahasiswa->email : $request->user->dosen->email }}</td>
                                </tr>
                            </table>
                        </div>
                      </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="flush-headingTwo">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
                            Informasi Tambahan
                            </button>
                        </h2>
                        <div id="flush-collapseTwo" class="accordion-collapse collapse" aria-labelledby="flush-headingTwo" data-bs-parent="#accordionFlushExample">
                            <div class="accordion-body">
                                <table style="width:100%" class="mb-4">
                                    <tr>
                                      <th class="fw-normal">Jumlah Permintaan</th>
                                      <td class="text-end fw-bold">{{ $request->detail_request->count() }}</td>
                                    </tr>
                                    <tr>
                                      <th class="fw-normal">Dibuat</th>
                                      <td class="text-end fw-bold">{{ $request->created_at }}</td>
                                    </tr>
                                    <tr>
                                      <th class="fw-normal">Pembaharuan Terakhir</th>
                                      <td class="text-end fw-bold">{{ $request->updated_at }}</td>
                                    </tr>
                                    <tr>
                                      <th class="fw-normal">Status</th>
                                      @php
                                        $counter = 0;
                                        $done = 0;
                                        $rejected = 0;
                                      @endphp
                                      @foreach ($request->detail_request as $item)
                                          @if ($item->dosen_id == auth()->user()->dosen->id)
                                              @php $counter++ @endphp
                                          @endif

                                          @if ($item->status === 'done' && $item->dosen_id == auth()->user()->dosen->id)
                                              @php $done++ @endphp
                                          @endif

                                          @if ($item->status === 'rejected' && $item->dosen_id == auth()->user()->dosen->id)
                                              @php $rejected++ @endphp
                                          @endif
                                      @endforeach
                                      <td class="text-end fw-bold text-capitalize">
                                        @if ($done == $counter)
                                          Selesai
                                        @elseif ($rejected == $counter)
                                          Ditolak
                                        @else
                                          Proses
                                        @endif
                                      </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="col-md-9">
    <div id="data-detail" data-id="{{ $request->id }}"></div>
</div>
@endsection