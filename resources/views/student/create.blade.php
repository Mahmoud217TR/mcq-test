@extends('layouts.panel')

@section('board')
@include('student.edit')
@include('student.delete')
@include('student.store')

<div class="container-fluid">
    <div class="row mb-2">
        <div class="col">
            <h1>Student List</h1>
            <div class="d-flex justify-content-end">
                <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#createModal">Add New Student</button>
            </div>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col">
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
