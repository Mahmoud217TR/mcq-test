@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center mb-3">
        <div class="col">
            <div class="card">
                <div class="card-header fw-bold d-flex justify-content-between">
                    <p class="text-start mb-0">Question <span id='number'></span></p>
                    <p class="text-end mb-0 text-success" >Degree: <span id='degree'></span></p>
                </div>

                <div class="card-body">
                    <p id='content' class="card-content">
                    </p>
                    <div id="choices" class="container">
                        
                    </div>
                </div>
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
                  <li class="page-item" id="submit">
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

            $('.choice-radio').on('click', function(event){
                console.log('change');
                storeAnswer();
                fetchAnswers();
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

            function storeAnswer(){
                $.ajax({
                    type: "POST",
                    url: "{{ route('answer.store') }}",
                    data: "data",
                    dataType: "json",
                    success: function (response) {
                        console.log(response);
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
                            <div class="row">\
                                <div class="col d-flex align-items-center">\
                                    <input class="me-2 form-check-input choice-radio" type="radio" name="choice" id="' + index + '">\
                                    <label class="form-check-label" for="' + index + '">' + choice + '</label>\
                                </div>\
                            </div>\
                        ');
                     }
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
            }

        });
    </script>
@endpush