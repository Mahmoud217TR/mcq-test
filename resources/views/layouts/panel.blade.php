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
            <h2 class="offcanvas-title" id="offcanvasScrollingLabel"><i class="bi bi-speedometer2 me-2"></i>Dashboard</h2>
        </a>
        <button type="button" class="btn-close btn-close-white d-md-none" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
        <nav>
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link unstyled" href="{{ route('student.create') }}"><i class="bi bi-people-fill me-2"></i>Students</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link unstyled" href="#"><i class="bi bi-clipboard2-check me-2"></i>Questions</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link unstyled" href="#"><i class="bi bi-graph-up me-2"></i>Results</a>
                </li>
            </ul>
        </nav>
        </div>
    </div>

    <div class="board px-3">
        @yield('board')
    </div>
@endsection