@extends('layout.navbar')

@section('title', 'Request')
@section('activeRequest', 'active')

@section('content')
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <div class="container">
        <div class="row">
            @foreach ($friendRequest as $user)
                <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                    <div class="card border-0 h-100 shadow-lg rounded-lg overflow-hidden">
                        <img src="{{ asset('storage/' . $user->profile_path) }}" alt="{{ $user->name }}'s profile"
                            class="card-img-top img-fluid">
                        <div class="card-body d-flex flex-column text-center">
                            <h5 class="card-title text-truncate">{{ $user->name }}</h5>
                            <p class="card-text text-muted">{{ $user->fields_of_work }}</p>
                            <div class="row">
                                <div class="col-6">

                                    <form method="POST" action="{{ route('friend.store') }}" class="mb-2">
                                        @csrf
                                        <input type="hidden" name="request_id" value="{{ $user->request_id }}">
                                        <input type="hidden" name="friend_id" value="{{ $user->id }}">
                                        <button type="submit" class="btn btn-primary w-100">Accept</button>
                                    </form>
                                </div>
                                <div class="col-6">

                                    <form method="POST" action="{{ route('friend-request.destroy', $user->request_id) }}">
                                        @method('delete')
                                        @csrf
                                        <button type="submit" class="btn btn-danger w-100">Decline</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
