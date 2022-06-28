@extends('layouts.app')

@section('content')
@include('student.edit')
@include('student.delete')

<div class="container">
    <div class="row">
        <div class="col">
            <h1>Student List</h1>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <table class="table table-striped">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Edit</th>
                    <th scope="col">Delete</th>
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


            // Events
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

            $('#edit-student-form').on('submit', function(event){
                event.preventDefault();
                var form = this;
                $.ajax({
                    type: "PATCH",
                    url: form.action,
                    data: {
                        id: $('#edit-id').val(),
                        name: $('#edit-name').val(),
                        email: $('#edit-email').val(),
                        password: $('#edit-password').val(),
                    },
                    dataType: "json",
                    beforeSend: function () {
                        $('.error-edit-text').text('')
                    },
                    success: function (response) {
                        if(response.code == 200){
                            $(form).trigger("reset")
                            $("#update-modal-close").click()
                            fetchStudents();
                        }else{
                            $.each(response.errors, function(field, message){
                                $('#error-edit-'+field).text(message);
                            });
                        }
                    }
                });
            });

            $('#delete-student-form').on('submit', function(event){
                event.preventDefault();
                var form = this;
                $.ajax({
                    type: "DELETE",
                    url: form.action,
                    data: {
                        id: $('#delete-id').val(),
                    },
                    dataType: "json",
                    success: function (response) {
                        if(response.code == 200){
                            $("#delete-modal-close").click()
                            fetchStudents();
                        }
                    }
                });
            });

            // Functions
            function fetchStudents(){
                $.ajax({
                    type: "GET",
                    url: "{{ route('student.index') }}",
                    dataType: "json",
                    success: function (response) {
                        $('tbody').html('');
                        $('tbody').append('<tr>\
                                            <th scope="col">#</th>\
                                            <th scope="col">Name</th>\
                                            <th scope="col">Email</th>\
                                            <th scope="col">Edit</th>\
                                            <th scope="col">Delete</th>\
                                        </tr>');
                        $.each(response.students, function(key,student){
                            loadStudent(student.id, student.name, student.email);
                        });

                        $('.edit-button').on('click', function(){
                            $('#updateModalLabel').text("Edit Student Attributes");
                            fetchStudent(this.value)
                        });

                        $('.delete-button').on('click', function(){
                            $('#removeModalLabel').text("Delete Student Permanently");
                            $('#delete-id').val(this.value)
                        });
                    }
                });
            }

            function loadStudent($id, $name, $email){
                $('tbody')
                .append( '<tr>\
                    <th scope="row">' + $id + '</th>\
                    <td>' + $name + '</td>\
                    <td>' + $email + '</td>\
                    <td><button class="btn btn-success btn-sm edit-button" data-bs-toggle="modal" data-bs-target="#updateModal" value="' + $id + '">Edit</button></td>\
                    <td><button class="btn btn-danger btn-sm delete-button" data-bs-toggle="modal" data-bs-target="#removeModal" value="' + $id + '">Delete</button></td>\
                </tr>');
            }

            function fetchStudent(id){
                $.ajax({
                    type: "GET",
                    url: "{{ route('student.show') }}",
                    data: {
                        id: id,
                    },
                    dataType: "json",
                    success: function (response) {
                        $('#edit-id').val(id)
                        $('#edit-name').val(response.name)
                        $('#edit-email').val(response.email)
                    }
                });
            }
        });
    </script>    
@endpush
