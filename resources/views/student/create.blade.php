@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col">
            <h1>Student List</h1>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <table class="table">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                  </tr>
            </table>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">Register a new Student</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('student.store') }}" id='register-student-form'>
                        @csrf

                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">Name</label>

                            <div class="col">
                                <input id="name" type="text" class="form-control" name="name" required autocomplete="name" autofocus>

                                <span class="text-danger error-text fw-bold" id='error-name' role="alert">
                                </span>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">Email Address</label>

                            <div class="col">
                                <input id="email" type="email" class="form-control" name="email" required autocomplete="email">

                                <span class="text-danger error-text fw-bold" id='error-email' role="alert">
                                </span>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">Password</label>

                            <div class="col">
                                <input id="password" type="password" class="form-control" name="password" required autocomplete="new-password">

                                    <span class="text-danger error-text fw-bold" id='error-password' role="alert">
                                    </span>
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Register
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
    <script>
        $(function(){
            
            fetchStudents();

            $('#register-student-form').on('submit', function(event){
                event.preventDefault();
                var form = this;

                $.ajax({
                    type: form.method,
                    url: form.action,
                    data: {
                        name: $('#name').val(),
                        email: $('#email').val(),
                        password: $('#password').val(),
                    },
                    dataType: "json",
                    beforeSend: function () {
                        $('.error-text').text('')
                    },
                    success: function (response) {
                        if(response.code == 200){
                            $(form).trigger("reset")
                            fetchStudents();
                        }else{
                            $.each(response.errors, function(field, message){
                                $('#error-'+field).text(message);
                            });
                        }
                    }
                });
            });

            function fetchStudents(){
                $.ajax({
                    type: "GET",
                    url: "{{ route('student.index') }}",
                    dataType: "json",
                    success: function (response) {
                        $('tbody').html('');
                        $.each(response.students, function(key,student){
                            loadStudent(student.id, student.name, student.email);
                        });
                    }
                });
            }

            function loadStudent($id, $name, $email){
                $('tbody').append('<tr><th scope="row">' + $id + '</th><td>' + $name + '</td><td>' + $email + '</td></tr>');
            }
        });
    </script>    
@endpush
