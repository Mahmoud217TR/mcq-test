@extends('layouts.panel')

@include('question.store')
@include('question.delete')
@section('board')
    <div class="container">
        <div class="row mb-3">
            <div class="col">
                <h1>Questions</h1>
                <div class="d-flex justify-content-end">
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createModal">Add Question</button>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col">
                <table class="table table-striped">
                    <tr>
                        <th scope="col">Question</th>
                        <th scope="col">Degree</th>
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
            
            fetchQuestions();

            // Events
            $('#register-question-form').on('submit', function(event){
                event.preventDefault();
                var form = this;

                $.ajax({
                    type: form.method,
                    url: form.action,
                    data: {
                        content: $('#question').val(),
                        degree: $('#degree').val(),
                        choice1: $('#choice1').val(),
                        choice2: $('#choice2').val(),
                        choice3: $('#choice3').val(),
                        choice4: $('#choice4').val(),
                        answer: $('.answer:radio:checked').val(),
                    },
                    dataType: "json",
                    beforeSend: function () {
                        $('.error-text').text('')
                    },
                    success: function (response) {
                        console.log(response)
                        if(response.code == 200){
                            $(form).trigger("reset")
                            $("#create-modal-close").click()
                            fetchQuestions();
                        }else{
                            $.each(response.errors, function(field, message){
                                $('#error-'+field).text(message);
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
                            fetchQuestions();
                        }
                    }
                });
            });

            // Functions
            function fetchQuestions(){
                $.ajax({
                    type: "GET",
                    url: "{{ route('question.index') }}",
                    dataType: "json",
                    success: function (response) {
                        $('tbody').html('');
                        $('tbody').append('<tr>\
                                            <th scope="col">Question</th>\
                                            <th scope="col">Degree</th>\
                                            <th scope="col">Edit</th>\
                                            <th scope="col">Delete</th>\
                                         </tr>');
                        $.each(response.questions, function(key,question){
                            loadQuestion(question.id, question.degree, question.question);
                        });

                        $('.delete-button').on('click', function(){
                            $('#removeModalLabel').text("Delete Question Permanently");
                            $('#delete-id').val(this.value)
                        });
                    }
                });
            }

            function loadQuestion($id, $degree, $question){
                $('tbody')
                .append( '<tr>\
                    <td>' + $question + '</td>\
                    <td>' + $degree + '</td>\
                    <td><button class="btn btn-success btn-sm edit-button" data-bs-toggle="modal" data-bs-target="#updateModal" value="' + $id + '"><i class="bi bi-pencil-fill"></i></button></td>\
                    <td><button class="btn btn-danger btn-sm delete-button" data-bs-toggle="modal" data-bs-target="#removeModal" value="' + $id + '"><i class="bi bi-trash3-fill"></i></button></td>\
                </tr>');
            }
        });
    </script>    
@endpush