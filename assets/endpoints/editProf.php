<form method="post">
  <input type="hidden" id="editProf_id" name="edit">
  <div class="modal-body">
    <div class="form-group">
        <label for="name">Name</label>
        <input class="form-control" type="text" id="editProf_fname" name="editProf_fname" placeholder="First Name" required>
        <br>
        <input class="form-control" type="text" id="editProf_mname" name="editProf_mname" placeholder="Middle Name" required>
        <br>
        <input class="form-control" type="text" id="editProf_lname" name="editProf_lname" placeholder="Last Name" required>
        <label for="office">Office</label>

        <select class="form-control" type="text" id="editoffice" name="editoffice">
          <option value="">No Office</option>
            <?php while($value = $officeList->fetch_assoc()) { ?>
              <option value="<?=$value['officeID']?>"><?=$value['officeName']?></option>
            <?php } ?>
        </select>

        <label for="username">Username</label>
        <input class="form-control" type="text" id="editProf_username" name="editusername"placeholder="Enter Username" required>
        <label for="password">Change Password(?)</label>
        <input class="form-control" type="password" id="editProf_password" name="editpassword" placeholder="Enter Password">
        <label for="confirmpassword">Confirm Change Password</label>
        <input class="form-control" type="password" id="editProf_confirm" name="editconfirmpassword" placeholder="Confirm Password">
    </div>
  </div>
  <div class="modal-footer">
    <button type="submit" class="btn btn-pupcustomcolor">Edit</button>
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
  </div>
</form>