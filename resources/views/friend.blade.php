@extends('layout.navbar')

@section('title', 'Friend')
@section('activeFriend', 'active')

@section('content')
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <div class="container">
        <div class="row">
            @foreach ($dataFriend as $user)
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
                            <a href="{{ route('message.show', $user->id) }}"
                                class="btn btn-primary mt-auto w-100">Message</a>
                        </form>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
@endsection
