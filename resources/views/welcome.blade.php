@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row mb-5">
            <div class="col d-flex justify-content-center">
                <img src="{{ asset('images/logo.svg') }}" alt="logo">
            </div>
        </div>
        <hr>
        <div class="row mb-3">
            <div class="col-md-4 d-flex justify-content-center justify-content-md-end">
                <img src="{{ asset('images/welcome-pic-1.svg') }}" width="300px" alt="teaching">
            </div>
            <div class="col d-flex align-items-center order-md-last order-first">
                <div>
                    <h2 class="text-color-main">Teaching</h2>
                    <p class="text-color-main fs-4">
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Accusamus modi error magni cupiditate quia consectetur atque sint, veritatis repellendus sed officiis libero quos fugiat corrupti explicabo rem vitae? Rem, consequatur.
                    </p>
                </div>
            </div>
        </div>
        <hr>
        <div class="row mb-3">
            <div class="col d-flex align-items-center">
                <div>
                    <h2 class="text-color-main">Testing</h2>
                    <p class="text-color-main fs-4">
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Accusamus modi error magni cupiditate quia consectetur atque sint, veritatis repellendus sed officiis libero quos fugiat corrupti explicabo rem vitae? Rem, consequatur.
                    </p>
                </div>
            </div>
            <div class="col-md-4 d-flex justify-content-center justify-content-md-start">
                <img src="{{ asset('images/welcome-pic-2.svg') }}" width="300px" alt="testing">
            </div>
        </div>
    </div>
@endsection