<?php include_once($_SERVER['DOCUMENT_ROOT'].'/pupwebdev/auth/dbConnect.php'); ?>
<form method="post">
  <div class="modal-body">
    <div class="form-group">
        <label for="name">Name</label>
        
        <select name="professorID" id="" class="form-control" required>
          <?php

          function pdo()
{
  $host = "localhost";
  $user= "root";
  $password= "";
  $dbname = "pup";

  //SET DSN data source name
  $dsn = 'mysql::host='.$host.';dbname='.$dbname;

  //Create a PDO instance
  $pdo = new PDO($dsn,$user,$password);
  $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_ASSOC);//set default fetch object 
  $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES,false);//to use limits

  return $pdo;
}
           $pdo = pdo();
           $sql = "call pup.selectProfNoAccount();";
           $stmt = $pdo->prepare($sql);
           $stmt->execute();
           echo '<option value =""  selected="selected" disabled="true">--Please Select Professor--</option>';
           while($row = $stmt->fetch())
           {
            echo '<option value = "'.$row['professorID'].'">'.$row['firstName'].' '.$row['middleName'].' '.$row['lastName'].'</option>';
           }
            //$result1 = mysqli_query($con, "call pup.selectProfNoAccount();");

            // while($row1 = mysqli_fetch_array($result1)){
            //   $professorID = $row1['professorID'];
              
            // }
          ?>
        </select>

        <!--<input class="form-control" type="text" id="addProf_fname" name="addProf_fname" value="" placeholder="First Name" required>
        <br>
        <input class="form-control" type="text" id="addProf_mname" name="addProf_mname" value="" placeholder="Middle Name" required>
        <br>
        <input class="form-control" type="text" id="addProf_lname" name="addProf_lname" value="" placeholder="Last Name" required>-->
        <label for="office">Office</label>

        <select class="form-control" type="text" name="office" required>
        echo '<option value =""  selected="selected" disabled="true">--Please Select Office--</option>';
            <?php while($value = $officeList2->fetch_assoc()) { ?>
                  <option value="<?=$value['officeID']?>"><?=$value['officeName']?></option>
            <?php } ?>
        </select>

        <label for="username">Username</label>
        <input class="form-control" type="text" id="addProf_username" name="username" value="" placeholder="Enter Username" required>
        <label for="password">Password</label>
        <input class="form-control" type="password" id="addProf_password" name="password" placeholder="Enter Password" required>
        <label for="confirmpassword">Confirm Password</label>
        <input class="form-control" type="password" id="addProf_confirm" name="confirmpassword" placeholder="Confirm Password" required>
    </div>
  </div>
  <div class="modal-footer">
    <button type="submit" class="btn btn-pupcustomcolor " name="add">Add</button>
    <button type="button" class="btn btn-secondary" data-dismiss="modal" >Cancel</button>
  </div>
</form>