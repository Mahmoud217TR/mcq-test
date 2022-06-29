@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card text-center p-4">
                    <h1>You Have {{ $result }} The Test!!</h1>
                    <p>
                        You Scored: {{ $degree }} / {{ $final_degree }} (%{{ $percentage }})
                    </p>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button class="btn btn-warning">Logout</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

