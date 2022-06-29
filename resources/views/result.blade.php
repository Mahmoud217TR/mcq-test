@extends('layouts.app')

@section('content')
    <div class="container fade-in-down">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card text-center p-4">
                    <h1>You Have {{ $result }} The Test!!</h1>
                    @if($percentage >= 50)
                        <svg version="1.1" xmlns="http://www.w3.org/2000/svg" width="150px" viewBox="0 0 130.2 130.2">
                            <circle class="path circle" fill="none" stroke="#1A9603" stroke-width="6" stroke-miterlimit="10" cx="65.1" cy="65.1" r="62.1"/>
                            <polyline class="path check" fill="none" stroke="#1A9603" stroke-width="6" stroke-linecap="round" stroke-miterlimit="10" points="100.2,40.2 51.5,88.8 29.8,67.5 "/>
                        </svg>
                        <p class="display-5 text-color-sup-success fw-bold">Congratulations!!!</p>
                    @else
                        <svg version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 130.2 130.2">
                            <circle class="path circle" fill="none" stroke="#96031A" stroke-width="6" stroke-miterlimit="10" cx="65.1" cy="65.1" r="62.1"/>
                            <line class="path line" fill="none" stroke="#96031A" stroke-width="6" stroke-linecap="round" stroke-miterlimit="10" x1="34.4" y1="37.9" x2="95.8" y2="92.3"/>
                            <line class="path line" fill="none" stroke="#96031A" stroke-width="6" stroke-linecap="round" stroke-miterlimit="10" x1="95.8" y1="38" x2="34.4" y2="92.2"/>
                        </svg>
                        <p class="display-5 text-color-sup-danger fw-bold">What a Bummer!</p>
                    @endif
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

