<div class="modal fade" id="updateModal" tabindex="-1"  aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="updateModalLabel">Edit Question</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form method="POST" action="{{ route('question.update') }}" id='update-question-form'>
            @csrf
            <input id='edit-id' type="text" hidden required>
            <div class="modal-body">
                <div class="row">
                    <label for="question" class="col col-form-label">Question</label>
                </div>
                <div class="row mb-3">
                    <div class="col">
                        <textarea id="edit-question" class="form-control" required autocomplete="question" 
                        autofocus style="resize: none;" rows="6"></textarea>
    
                        <span class="text-danger error-text fw-bold" id='error-edit-question' role="alert">
                        </span>
                    </div>
                </div>
    
                <div class="row">
                    <label for="edit-degree" class="col col-form-label">Degree</label>
                </div>
                <div class="row mb-3">
                    <div class="col-md-5">
                        <input id="edit-degree" type="number" class="form-control" required autocomplete="edit-degree" min='0'>
    
                        <span class="text-danger error-text fw-bold" id='error-edit-degree' role="alert">
                        </span>
                    </div>
                </div>

                <div class="row">
                    <label for="edit-choice1" class="col col-form-label">Choice 1</label>
                </div>
                <div class="row mb-3">
                    <div class="col">
                        <input id="edit-choice1" name='1' type="text" class="form-control edit-choice" required autocomplete="choice">
                        <div class="form-check form-switch">
                            <input class="form-check-input edit-answer" type="radio" role="switch" id="edit-answer1" name="answer" value='1' disabled required>
                            <label class="form-check-label" for="answer1">Is Answer</label>
                            <span class="text-danger error-text fw-bold" id='error-edit-answer' role="alert">
                            </span>
                        </div>
    
                        <span class="text-danger error-text fw-bold" id='error-edit-choice1' role="alert">
                        </span>
                    </div>
                </div>

                <div class="row">
                    <label for="edit-choice2" class="col col-form-label">Choice 2</label>
                </div>
                <div class="row mb-3">
                    <div class="col">
                        <input id="edit-choice2" name='2' type="text" class="form-control edit-choice"required autocomplete="choice">
                        <div class="form-check form-switch">
                            <input class="form-check-input edit-answer" type="radio" role="switch" id="edit-answer2" name="answer" value='2' disabled>
                            <label class="form-check-label" for="edit-answer2">Is Answer</label>
                        </div>
    
                        <span class="text-danger error-text fw-bold" id='error-edit-choice2' role="alert">
                        </span>
                    </div>
                </div>

                <div class="row">
                    <label for="edit-choice3" class="col col-form-label">Choice 3</label>
                </div>
                <div class="row mb-3">
                    <div class="col">
                        <input id="edit-choice3" name='3' type="text" class="form-control edit-choice" autocomplete="choice">
                        <div class="form-check form-switch">
                            <input class="form-check-input edit-answer" type="radio" role="switch" id="edit-answer3" name="answer" value='3' disabled>
                            <label class="form-check-label" for="edit-answer3">Is Answer</label>
                        </div>
    
                        <span class="text-danger error-text fw-bold" id='error-edit-choice3' role="alert">
                        </span>
                    </div>
                </div>
                <div class="row">
                    <label for="edit-choice4" class="col col-form-label">Choice 4</label>
                </div>
                <div class="row mb-3">
                    <div class="col">
                        <input id="edit-choice4" name='4' type="text" class="form-control edit-choice" autocomplete="choice">
                        <div class="form-check form-switch">
                            <input class="form-check-input edit-answer" type="radio" role="switch" id="edit-answer4" name="answer" value='4' disabled>
                            <label class="form-check-label" for="edit-answer4">Is Answer</label>
                        </div>
    
                        <span class="text-danger error-text fw-bold" id='error-edit-choice4' role="alert">
                        </span>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" id='update-modal-close' data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success">Update</button>
                </div>
            </div>
        </form>
      </div>
    </div>
</div>