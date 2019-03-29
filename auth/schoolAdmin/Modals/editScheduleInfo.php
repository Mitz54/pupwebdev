<div class="modal fade" id="edit-sched-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title" id="exampleModalCenterTitle">Edit Schedule</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body ml-3 mr-3">
        <div>
          <input id="lbl-sched-id" hidden></input>
          <label>Name</label>
          <input id='inp-edit-name' class='form-control'></input>
        </div>
        
          <label>Course</label>
          <select id='sel-edit-course' onChange='getSection(this.value)' class='form-control'>
            <?php
              include'Queries/readCourses.php';
            ?>
          </select>
        
        <div>
          <label>Section</label>
          <select id='sel-edit-sect' class='form-control' disabled>
            <option disabled selected hidden value="">Select Section...</option>
          </select>

        </div>

        <div>
          <label>Professor</label>
          <select id='sel-edit-prof' class='form-control'>
            <?php
              include'Queries/readProfessors.php';
            ?>
          </select>
        </div>

        <div>
          <label>Purpose</label>
          <select  id="sel-edit-purp" class="form-control">
            <?php  
                      include include($_SERVER['DOCUMENT_ROOT'].'/pupwebdev/auth/student/php/SelectAllPurpose.php');
            ?>   
          </select>
         
         <label>Remarks</label>
          <textarea id='inp-edit-rem' class='form-control'></textarea>
        </div>
        
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
         <button type="button" id="delete-schedule-btn" class="btn btn-danger">Delete</button>
        <button type="button" id="update-schedule-btn" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>