@extends('layouts.panel')

@section('title', 'Students')

@section('board')
@include('student.edit')
@include('student.delete')
@include('student.store')

<div class="container-fluid">
    <div class="row mb-3">
        <div class="col">
            <h1 class="text-white"><i class="bi bi-people-fill me-2"></i>Students List</h1>
        </div>
    </div>
    <hr class="hr">
    <div class="row mb-3">
        <div class="col">
            <div class="d-flex justify-content-end">
                <button class="btn btn-warning fade-in-right" data-bs-toggle="modal" data-bs-target="#createModal"><i class="bi bi-person-plus-fill me-2"></i>Add Student</button>
            </div>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col">
            <table class="table bg-light table-striped fade-in-down">
                <tbody>
                </tbody>
            </table>
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
                            $("#create-modal-close").click()
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
                    <td><button class="btn btn-success btn-sm edit-button" data-bs-toggle="modal" data-bs-target="#updateModal" value="' + $id + '"><i class="bi bi-pencil-fill"></i></button></td>\
                    <td><button class="btn btn-danger btn-sm delete-button" data-bs-toggle="modal" data-bs-target="#removeModal" value="' + $id + '"><i class="bi bi-trash3-fill"></i></button></td>\
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
