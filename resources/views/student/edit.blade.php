<div class="modal fade" id="updateModal" tabindex="-1"  aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="updateModalLabel"></h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form method="POST" action="{{ route('student.update') }}" id='edit-student-form'>
            @csrf
            <div class="modal-body">
                <input id="edit-id" type="text" required hidden>
                <div class="row mb-3">
                    <label for="edit-name" class="col-md-4 col-form-label text-md-end">Name</label>

                    <div class="col">
                        <input id="edit-name" type="text" class="form-control" name="name" required autocomplete="name" autofocus>

                        <span class="text-danger error-text fw-bold" id='error-edit-name' role="alert">
                        </span>
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="edit-email" class="col-md-4 col-form-label text-md-end">Email Address</label>

                    <div class="col">
                        <input id="edit-email" type="email" class="form-control" name="email" required autocomplete="email">

                        <span class="text-danger error-text fw-bold" id='error-edit-email' role="alert">
                        </span>
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="edit-password" class="col-md-4 col-form-label text-md-end">Password</label>

                    <div class="col">
                        <input id="edit-password" type="password" class="form-control" name="password" autocomplete="new-password">

                            <span class="text-danger error-text fw-bold" id='error-edit-password' role="alert">
                            </span>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" id='update-modal-close' data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-success">Update</button>
            </div>
        </form>
      </div>
    </div>
</div>