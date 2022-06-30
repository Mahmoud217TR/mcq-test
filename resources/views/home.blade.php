@extends('layouts.app')

@section('title', 'Test')

@section('content')
<div class="container fade-in-right">
    <div class="row justify-content-center mb-4">
        <div class="col">
            <div class="card bg-bg-main test-card text-color-main">
                <div class="card-header fw-bold d-flex justify-content-between">
                    <p class="text-start mb-0">Question <span id='number'></span></p>
                    <p class="text-end mb-0 text-success" >Degree: <span id='degree'></span></p>
                </div>

                <div class="card-body">
                    <p id='content' class="card-content">
                    </p>
                    <div class="container">
                        <div id="choices" class="row row-cols-md-2">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row mb-4 justify-content-center">
        <div class="col-md-6">
            <div class="progress">
                <div class="progress-bar bg-warning" id="progress" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col d-flex justify-content-center">
            <nav aria-label="...">
                <ul class="pagination">
                  <li class="page-item disabled" id="previous">
                    <button class="page-link">Previous</button>
                  </li>
                  <li class="page-item disabled" id="submit">
                    <button class="page-link">Submit</button>
                  </li>
                  <li class="page-item" id="next">
                    <button class="page-link">Next</button>
                  </li>
                </ul>
            </nav>
        </div>
    </div>
</div>
@endsection

@push('scripts')
    <script>
        $(function(){
            var currentQuestion = 0;
            var questions = null;
            var asnswers = null;

            fetchQuestions();
            fetchAnswers();
            displayCurrentQuestion();
            updateProgress();
            
            // Events 
            $('#next').on('click',function(event){
                event.preventDefault();
                if(currentQuestion < questions.length-1){
                    currentQuestion += 1;
                    displayCurrentQuestion();
                }
            });

            $('#previous').on('click',function(event){
                event.preventDefault();
                if(currentQuestion > 0){
                    currentQuestion -= 1;
                    displayCurrentQuestion();
                }
            });

            $('#submit').on('click', function(event){
                event.preventDefault();
                if(questions.length == answers.length){
                    submit();
                }
            });

            // Functions
            function fetchQuestions(){
                $.ajax({
                    type: "GET",
                    url: "{{ route('question.index') }}",
                    dataType: "json",
                    async: false,
                    success: function (response) {
                        questions = response.questions;
                    }
                });
            }

            function fetchAnswers(){
                $.ajax({
                    type: "GET",
                    url: "{{ route('answer.index') }}",
                    dataType: "json",
                    async: false,
                    success: function (response) {
                        answers = response.answers;
                    }
                });
            }

            function storeAnswer(choice){
                displayLoading();
                updateProgress();
                $.ajax({
                    type: "POST",
                    url: "{{ route('answer.store') }}",
                    data: {
                        question_id: questions[currentQuestion]['id'],
                        choice: choice,
                    },
                    dataType: "json",
                    async: false,
                    success: function (response) {
                        hideLoading();
                        checkButtons();
                    }
                });
            }

            function submit(){
                $.ajax({
                    type: "POST",
                    url: "{{ route('test.submit') }}",
                    dataType: "json",
                    success: function (response) {
                        document.location = response.redirect;
                    }
                });
            }

            function displayCurrentQuestion(){
                loadQuestion(questions[currentQuestion],currentQuestion+1);
                checkAnswer(questions[currentQuestion]);
                checkButtons();
            }

            function loadQuestion(question, number){
                $('#number').text(number);
                $('#content').text(question['question']);
                $('#degree').text(question['degree']);
                $("#choices").html('');
                $.each(question['choices'], function (index, choice) { 
                     if(choice != null){
                        $("#choices").append('\
                            <div class="col test-choice">\
                                <label class="test-container container" for="' + index + '">\
                                    <div class="row">\
                                        <div class="col">\
                                            <div class="form-check">\
                                                <input class="me-2 form-check-input" type="radio" name="choice" id="' + index + '">\
                                            </div>\
                                        </div>\
                                    </div>\
                                    <div class="row">\
                                        <p class="text-center">' + choice + '</p>\
                                    </div>\
                                </label>\
                            </div>\
                        ');
                     }
                });
                $('input[type=radio][name=choice]').on('change',function(){
                    storeAnswer(this.id);
                    fetchAnswers();
                });
            }

            function checkAnswer(question){
                let choice = getAnswerByQuestionId(question['id']);
                if (choice){
                    $("#"+choice['choice']).prop('checked', true);
                }
            }

            function getAnswerByQuestionId(question_id){
                return answers.find(answer => answer['question_id'] == question_id);
            }

            function checkButtons(){
                if(currentQuestion == questions.length-1) {
                    $('#next').addClass('disabled');
                }else{
                    $('#next').removeClass('disabled');
                }
                if(currentQuestion == 0){
                    $('#previous').addClass('disabled');
                }else{
                    $('#previous').removeClass('disabled');
                }
                if(questions.length == answers.length){
                    $('#submit').removeClass('disabled');
                }else{
                    $('#submit').addClass('disabled');
                }
            }

            function updateProgress(){
                $('#progress').css('width',(answers.length/questions.length)*100+'%');
            }

            function displayLoading(){
                $("#loading-screen-backdrop").removeClass('d-none');
                $("#loading-screen").removeClass('d-none');
            }

            function hideLoading(){
                $("#loading-screen-backdrop").addClass('d-none');
                $("#loading-screen").addClass('d-none');
            }

        });
    </script>
@endpush