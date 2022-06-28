@extends('layouts.app')

@section('left-nav')
<ul class="navbar-nav me-auto">
    <button class="btn btn-dark" type="button" data-bs-toggle="offcanvas" data-bs-target="#dashboard">
        Dashboard
    </button>
</ul>
@endsection

@section('content')
    <div class="offcanvas offcanvas-start bg-dark text-white" data-bs-scroll="true" data-bs-backdrop="false" tabindex="-1" id="dashboard" aria-labelledby="offcanvasScrollingLabel">
        <div class="offcanvas-header">
        <a class="unstyled" href="{{ route('dashboard') }}">
            <h2 class="offcanvas-title" id="offcanvasScrollingLabel">Dashboard</h2>
        </a>
        <button type="button" class="btn-close btn-close-white d-md-none" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
        <nav>
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link unstyled" href="{{ route('student.create') }}">Students</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link unstyled" href="#">Questions</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link unstyled" href="#">Results</a>
                </li>
            </ul>
        </nav>
        </div>
    </div>

    <div class="board">
        @yield('board')
    </div>
@endsection