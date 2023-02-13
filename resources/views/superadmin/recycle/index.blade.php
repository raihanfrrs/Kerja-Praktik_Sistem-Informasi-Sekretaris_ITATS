@extends('layouts.main')

@section('section')
    <div class="card mx-2">
        <div class="card-body">
            <h5 class="card-title">Mahasiswa <span>| List</span></h5>

            @foreach ($mahasiswas as $mahasiswa)
                <div class="single-notification">
                    <div class="notification">
                        <div class="image bg-success">
                            <span>{{ mb_substr($mahasiswa->name, 0, 1) }}</span>
                        </div>
                        <a href="/mahasiswa/{{ $mahasiswa->slug }}" class="content">
                            <h5 class="fw-bold text-black">{{ Str::ucfirst($mahasiswa->name) }}</h5>
                            <p class="text-lowercase text-muted mb-1 fst-italic">{{ $mahasiswa->email }}</p>
                            <p class="text-muted">{{ $mahasiswa->phone }}</p>
                            <span class="fw-semibold text-muted">Moved in {{ $mahasiswa->updated_at->diffForHumans() }}</span>
                        </a>
                    </div>
                    <div class="action">
                        <form action="/recycle/{{ $mahasiswa->slug }}" method="post" id="delete-form-{{ $mahasiswa->slug }}">
                            @csrf
                            @method('delete')
                            <button type="submit" id="delete-btn" value="{{ $mahasiswa->slug }}">
                                <i class="bi bi-trash3"></i>
                            </button>
                        </form>

                        <a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown">
                            <i class="bi bi-bell"></i>
                            <span class="badge bg-primary badge-number">4</span>
                          </a>

                          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow notifications">
                            <li class="dropdown-header">
                              You have 4 new notifications
                              <a href="#"><span class="badge rounded-pill bg-primary p-2 ms-2">View all</span></a>
                            </li>
                            <li>
                              <hr class="dropdown-divider">
                            </li>
                
                            <li class="notification-item">
                              <i class="bi bi-exclamation-circle text-warning"></i>
                              <div>
                                <h4>Lorem Ipsum</h4>
                                <p>Quae dolorem earum veritatis oditseno</p>
                                <p>30 min. ago</p>
                              </div>
                            </li>
                
                            <li>
                              <hr class="dropdown-divider">
                            </li>
                
                            <li class="notification-item">
                              <i class="bi bi-x-circle text-danger"></i>
                              <div>
                                <h4>Atque rerum nesciunt</h4>
                                <p>Quae dolorem earum veritatis oditseno</p>
                                <p>1 hr. ago</p>
                              </div>
                            </li>
                
                            <li>
                              <hr class="dropdown-divider">
                            </li>
                
                            <li class="notification-item">
                              <i class="bi bi-check-circle text-success"></i>
                              <div>
                                <h4>Sit rerum fuga</h4>
                                <p>Quae dolorem earum veritatis oditseno</p>
                                <p>2 hrs. ago</p>
                              </div>
                            </li>
                
                            <li>
                              <hr class="dropdown-divider">
                            </li>
                
                            <li class="notification-item">
                              <i class="bi bi-info-circle text-primary"></i>
                              <div>
                                <h4>Dicta reprehenderit</h4>
                                <p>Quae dolorem earum veritatis oditseno</p>
                                <p>4 hrs. ago</p>
                              </div>
                            </li>
                
                            <li>
                              <hr class="dropdown-divider">
                            </li>
                            <li class="dropdown-footer">
                              <a href="#">Show all notifications</a>
                            </li>
                
                          </ul>
                    </div>
                </div>
            @endforeach

        </div>
    </div>
@endsection