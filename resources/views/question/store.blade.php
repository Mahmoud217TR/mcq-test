<div class="modal fade" id="createModal" tabindex="-1"  aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="createModalLabel">Add new Question</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form method="POST" action="{{ route('question.store') }}" id='register-question-form'>
            @csrf

            <div class="modal-body">
                <div class="row">
                    <label for="question" class="col col-form-label">Question</label>
                </div>
                <div class="row mb-3">
                    <div class="col">
                        <textarea id="question" class="form-control" required autocomplete="question" 
                        autofocus style="resize: none;" rows="6"></textarea>
    
                        <span class="text-danger error-text fw-bold" id='error-question' role="alert">
                        </span>
                    </div>
                </div>
    
                <div class="row">
                    <label for="question" class="col col-form-label">Degree</label>
                </div>
                <div class="row mb-3">
                    <div class="col-md-5">
                        <input id="degree" type="number" class="form-control" required autocomplete="degree" min='0'>
    
                        <span class="text-danger error-text fw-bold" id='error-degree' role="alert">
                        </span>
                    </div>
                </div>

                <div class="row">
                    <label for="choice1" class="col col-form-label">Choice 1</label>
                </div>
                <div class="row mb-3">
                    <div class="col">
                        <input id="choice1" name='1' type="text" class="form-control choice" required autocomplete="choice">
                        <div class="form-check form-switch">
                            <input class="form-check-input answer" type="radio" role="switch" id="answer1" name="answer" value='1' disabled required>
                            <label class="form-check-label" for="answer1">Is Answer</label>
                            <span class="text-danger error-text fw-bold" id='error-answer' role="alert">
                            </span>
                        </div>
    
                        <span class="text-danger error-text fw-bold" id='error-choice1' role="alert">
                        </span>
                    </div>
                </div>

                <div class="row">
                    <label for="choice2" class="col col-form-label">Choice 2</label>
                </div>
                <div class="row mb-3">
                    <div class="col">
                        <input id="choice2" name='2' type="text" class="form-control choice"required autocomplete="choice">
                        <div class="form-check form-switch">
                            <input class="form-check-input answer" type="radio" role="switch" id="answer2" name="answer" value='2' disabled>
                            <label class="form-check-label" for="answer2">Is Answer</label>
                        </div>
    
                        <span class="text-danger error-text fw-bold" id='error-choice2' role="alert">
                        </span>
                    </div>
                </div>

                <div class="row">
                    <label for="choice3" class="col col-form-label">Choice 3</label>
                </div>
                <div class="row mb-3">
                    <div class="col">
                        <input id="choice3" name='3' type="text" class="form-control choice" autocomplete="choice">
                        <div class="form-check form-switch">
                            <input class="form-check-input answer" type="radio" role="switch" id="answer3" name="answer" value='3' disabled>
                            <label class="form-check-label" for="answer3">Is Answer</label>
                        </div>
    
                        <span class="text-danger error-text fw-bold" id='error-choice3' role="alert">
                        </span>
                    </div>
                </div>
                <div class="row">
                    <label for="choice4" class="col col-form-label">Choice 4</label>
                </div>
                <div class="row mb-3">
                    <div class="col">
                        <input id="choice4" name='4' type="text" class="form-control choice" autocomplete="choice">
                        <div class="form-check form-switch">
                            <input class="form-check-input answer" type="radio" role="switch" id="answer4" name="answer" value='4' disabled>
                            <label class="form-check-label" for="answer4">Is Answer</label>
                        </div>
    
                        <span class="text-danger error-text fw-bold" id='error-choice4' role="alert">
                        </span>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" id='create-modal-close' data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Rigester</button>
                </div>
            </div>
        </form>
      </div>
    </div>
</div>

@push('scripts')
    <script>
        $(function(){
            $('.choice').on('change', function(){
                if(this.value == ''){
                    $('#answer'+this.name).prop('disabled',true);
                }else{
                    $('#answer'+this.name).prop('disabled',false);
                }
            });
        });
    </script>
@endpush