<div class="modal fade" id="createModal" tabindex="-1"  aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="createModalLabel"></h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form method="POST" action="{{ route('student.store') }}" id='register-student-form'>
            @csrf

            <div class="modal-body">
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
    

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" id='create-modal-close' data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Rigester</button>
                </div>
            </div>
        </form>
      </div>
    </div>
</div>