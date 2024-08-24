@extends('layout.navbar')

@section('title', 'Home')
@section('activeHome', 'active')

@section('content')
    <div class="container-fluid px-5">
        <div class="d-flex justify-content-between align-items-center my-5">
            <h1 class="me-3">Welcome, {{ Auth::user()->name }}!</h1>
            <div class="position-relative">
                <button class="btn btn-outline-secondary rounded-circle" id="notificationButton">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-bell-fill" viewBox="0 0 16 16">
                        <path d="M8 16a2 2 0 0 0 2-2H6a2 2 0 0 0 2 2m.995-14.901a1 1 0 1 0-1.99 0A5 5 0 0 0 3 6c0 1.098-.5 6-2 7h14c-1.5-1-2-5.902-2-7 0-2.42-1.72-4.44-4.005-4.901"/>
                    </svg>
                    @if(Auth::user()->notifications->count())
                        <span class="badge bg-danger position-absolute top-0 start-100 translate-middle rounded-circle">
                            {{ Auth::user()->notifications->count() }}
                        </span>
                    @endif
                </button>
                <div id="notificationDropdown" class="dropdown-menu dropdown-menu-end p-3 shadow-lg"
                    style="display: none; width: 300px;">
                    <h6 class="dropdown-header">Notifications</h6>
                    <ul class="list-unstyled mb-0">
                        @forelse (Auth::user()->notifications as $notification)
                            <li class="d-flex justify-content-between align-items-center border-bottom py-2">
                                <div class="me-2">
                                    <i class="bi bi-exclamation-circle-fill text-warning me-2"></i>
                                    <span>{{ $notification->data['message'] }}</span>
                                </div>
                                {{-- <a href="{{ route('notifications.destroy', $notification->id) }}"
                                    class="btn btn-outline-danger btn-sm rounded-pill"
                                    onclick="event.preventDefault(); document.getElementById('delete-form-{{ $notification->id }}').submit();">
                                    <i class="bi bi-trash"></i>
                                </a> --}}
                                <form id="delete-form-{{ $notification->id }}"
                                    action="{{ route('notifications.destroy', $notification->id) }}" method="POST"
                                    style="display: none;">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            </li>
                        @empty
                            <li class="text-center text-muted">No new notifications</li>
                        @endforelse
                    </ul>
                </div>
            </div>
        </div>

        <div class="row mt-5">
            <!-- Search Form -->
            <form method="GET" action="{{ route('user.index') }}" class="mb-4">
                <div class="row">
                    <div class="col-md-3">
                        <select name="gender" class="form-select">
                            <option value="">All Genders</option>
                            <option value="male" {{ request('gender') == 'male' ? 'selected' : '' }}>Male</option>
                            <option value="female" {{ request('gender') == 'female' ? 'selected' : '' }}>Female</option>
                            <option value="other" {{ request('gender') == 'other' ? 'selected' : '' }}>Other</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <button type="submit" class="btn btn-primary w-100">Filter by Gender</button>
                    </div>
                </div>
            </form>

            @if($dataUser->isEmpty())
                <p class="text-center w-100 text-muted">No users found.</p>
            @else
                @foreach ($dataUser as $user)
                    <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                        <div class="card border-0 h-100 shadow-lg rounded-lg overflow-hidden">
                            <img src="{{ asset('storage/' . $user->profile_path) }}" alt="{{ $user->name }}'s profile"
                                class="card-img-top img-fluid">
                            <div class="card-body d-flex flex-column text-center">
                                <h5 class="card-title text-truncate">{{ $user->name }}</h5>
                                <p class="card-text text-muted">{{ $user->fields_of_work }}</p>
                                <form method="POST" action="{{ route('friend-request.store') }}" class="mt-auto">
                                    @csrf
                                    <input type="hidden" name="receiver_id" value="{{ $user->id }}">
                                    <button type="submit" class="btn btn-outline-dark rounded-circle">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-hand-thumbs-up-fill" viewBox="0 0 16 16">
                                            <path d="M6.956 1.745C7.021.81 7.908.087 8.864.325l.261.066c.463.116.874.456 1.012.965.22.816.533 2.511.062 4.51a10 10 0 0 1 .443-.051c.713-.065 1.669-.072 2.516.21.518.173.994.681 1.2 1.273.184.532.16 1.162-.234 1.733q.086.18.138.363c.077.27.113.567.113.856s-.036.586-.113.856c-.039.135-.09.273-.16.404.169.387.107.819-.003 1.148a3.2 3.2 0 0 1-.488.901c.054.152.076.312.076.465 0 .305-.089.625-.253.912C13.1 15.522 12.437 16 11.5 16H8c-.605 0-1.07-.081-1.466-.218a4.8 4.8 0 0 1-.97-.484l-.048-.03c-.504-.307-.999-.609-2.068-.722C2.682 14.464 2 13.846 2 13V9c0-.85.685-1.432 1.357-1.615.849-.232 1.574-.787 2.132-1.41.56-.627.914-1.28 1.039-1.639.199-.575.356-1.539.428-2.59z"/>
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>

    <script>
        document.getElementById('notificationButton').addEventListener('click', function() {
            var dropdown = document.getElementById('notificationDropdown');
            dropdown.style.display = dropdown.style.display === 'none' ? 'block' : 'none';
        });

        document.addEventListener('click', function(event) {
            var dropdown = document.getElementById('notificationDropdown');
            if (!event.target.closest('#notificationButton')) {
                dropdown.style.display = 'none';
            }
        });
    </script>
@endsection
