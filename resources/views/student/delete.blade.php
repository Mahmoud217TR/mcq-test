<div class="modal fade" id="removeModal" tabindex="-1"  aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="removeModalLabel"></h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <p class="text-danger">
            Are you Sure you want to remove this student ?<br>
            All the data will be lost & this action is not reversable!!
          </p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="delete-modal-close">Close</button>
          <form action="{{ route('student.destroy') }}" method="POST" id="delete-student-form">
            @csrf
            <input id="delete-id" type="text" required hidden>
            <button type="submit" class="btn btn-danger">Delete</button>
          </form>
        </div>
      </div>
    </div>
</div>