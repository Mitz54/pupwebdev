<?php
  ini_set('display_errors', 1);
  ini_set('display_startup_errors', 1);
  error_reporting(E_ALL);
  
  session_start();
  if(isset($_SESSION['username']))
  {
    redirect();
  }
  $_SESSION["notiToggle"] = 0;
  $_SESSION["prevlastqueue"] = 0;
try
{
  if(isset($_POST["submit"]))
  {
    include($_SERVER['DOCUMENT_ROOT'].'/pupwebdev/auth/dbConnect.php');

    $pass = $_POST['profilePassword'];
    $username = $_POST['profileUsername'];
    

    if(empty($username) || empty($pass))
    {
      $message = '<label>All fields are required</label>';
    }
    else
    {

      //$query = $conn->prepare("SELECT * FROM account WHERE userName = '$username' AND password = '$pass'");
      $query = $con->prepare("CALL getAccountInfo ('$username', '$pass')");
      $query->execute();
      $query->bind_result($accountType, $accountID, $room,  $officeID, $office);
      $query->fetch();
      
      //$query->execute(array('userName' => $username, 'password' => $pass));
      //$query->setFetchMode(PDO::FETCH_ASSOC);
      // $data = $query->fetch();
      // $accountType = $data['accountType'];
      // $room = $data['roomID'];
      // $office = $data['officeName'];
      // $accountID = $data['accountID'];
      // $officeID= $data['officeID'];

      // check if username and password exists
      

        $query->close();
        // get firstname lastname
        $query2 = $con->prepare("CALL getProfName('$username')");
        $query2->execute();
        $query2->bind_result($fName, $lName);
        $query2->fetch();
        $query2->close();
        // set SESSION
        $_SESSION["accountType"] = $accountType;
        $_SESSION["username"] = $username;
        $_SESSION['accntID'] = $accountID;

        $_SESSION["at"] = $accountType;
        $_SESSION["office"] = $office;
        $_SESSION["room"] = $room;
        $_SESSION['firstName'] = $fName;
        $_SESSION['lastName'] = $lName;
       

        // check account type
        if($_SESSION["office"] == "Administrative Services and Property"){
          header ("Location: /pupwebdev/auth/schoolAdmin/index.php");
          $con=null;

        }
        else if($_SESSION["office"] == "Academic Services Office")
        {
            header("Location: /pupwebdev/auth/acadservice/acadService_Scheduler.php");
            $con=null;
        }
        else if($accountType == 'prof')
        {
            header("Location: /pupwebdev/auth/office/queuePerOffice.php");
            $con=null;
        }
        else //if not faculty but maybe an admin
        {
          $query2 = $con->prepare("CALL getAccountID('$username', '$pass')");
          $query2->execute();
          $query2->bind_result($accountID, $accountType);
          $query2->fetch();
          $query2->close();
          // set SESSION
          $_SESSION["username"] = $username;
          $_SESSION['accntID'] = $accountID;
          $_SESSION["accountType"] = $accountType;
          
          if($_SESSION["accountType"] == "admin")  
          {
            $query2 = $con->prepare("CALL getProfName('$username')");
            $query2->execute();
            $query2->bind_result($fName, $lName);
            $query2->fetch();
            $query2->close();
            // set SESSION
            $_SESSION['firstName'] = $fName;
            $_SESSION['lastName'] = $lName;
            header("Location: /pupwebdev/auth/admin/account.php");
            $con=null;
            exit();
          }
          else{
            $message = 'Wrong username or password, please try again';
          echo "<script> alert('".$message."'); </script>"; 
            unset($_SESSION['username']);
            session_destroy();
          }  
        }
      
      
        
        
        

    //     if($accountType == 'prof' && $accountID ==30){
    //       // header ("Location: /pupwebdev/auth/admin/index.php");
    //       header ("Location: /pupwebdev/auth/admin/index.php");
    //     }
    //     else if($accountType == 'prof' && $accountID != 2)
    //  {
    //  header ("Location: /pupwebdev-kiosk/auth/admin/per_queue_offices.php");
        
    //     }
    //     else if($accountType == 'admin' && $accountID !=2)
    // {
    //        header ("Location: /pupwebdev-kiosk/auth/admin/room.php");
         
    //     }
    
    }
    
  }
  

}
catch(Exception $error)
{
  $message = $error->errorMessage();
  echo "<script> alert('".$message."'); </script>"; 
}

function redirect()
{
  if($_SESSION['accntID'] == 2){
    header ("Location: /pupwebdev/auth/schoolAdmin/index.php");
    $con=null;

  }
  else if($_SESSION['accntID'] == 3)
  {
      header("Location: /pupwebdev/auth/acadservice/acadService_Scheduler.php");
      $con=null;
  }
  else if($_SESSION["accountType"] == 'prof')
  {
      header("Location: /pupwebdev/auth/office/queuePerOffice.php");
      $con=null;
  }
  else if($_SESSION['accntID'] == 1)  
  {
    header("Location: /pupwebdev/auth/admin/account.php");
    $con=null;
    exit();
  }
  else
  {
    $message = 'Wrong username or password, please try again';
  echo "<script> alert('".$message."'); </script>"; 
    unset($_SESSION['username']);
    session_destroy();
  }
}
?>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/pupwebdev/header.php' ?>

            <style>
            .login-container {
              color: #fff;
              min-height: 300px;
              padding-bottom: 4em;
              padding-top: 5.5em;
              width: 100%;
            }
            .login-title-container {
              border-bottom: 5px solid white;
              padding-top: 5.5em;
              text-align: left;
            }
            .footer {
              background-color: #7f0400;
              border-top: 1px solid #edeaea;
              bottom: 0;
              color: #ccc;
              font-size: 14px;
              height: [footer-height];
              left: 0;
              padding: 20px 0px;
              position: absolute;
              right: 0;
              z-index: 2;
            }
            </style>

            <div class="col-md">
              <div class="container">
                <div class="row">
                  <div class="col-7">
                    <div class="login-title-container">
                        <span class="login-title">
                          QUEUE MANAGEMENT <br>
                          SYSTEM
                        </span>
                    </div>
                  </div>
                  <div class="col-5">
                    <div class="login-container">
                      <div class="loginbox-form">
                        <span class="loginbox-title">
                          WELCOME!
                        </span>
                          <form class="sign-in" method="POST">
                            <div class="loginbox-input">
                              <section>
                                <input class="textbox-selected" type="text" id="username" name="profileUsername" placeholder="Username" autocomplete="off"required autofocus/>
                              </section>
                              <section>
                                <input class="textbox-selected" type="password" id="password" name="profilePassword" placeholder="***********" autocomplete="off" required/>
                              </section>
                              <section>
                                <span class="loginbox-options">
                                  <button class="btn btn-sm btn-pupcustomcolor" name="submit" type="submit" onclick="return checkCredentials()">Login</button>
                                </span>
                              </section>
                            </div>
                          </form>
                        </div>
                      </div>
                      <div class="login-title-container-arrow">
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <script>
            function checkCredentials() {
              var un, pw;

              // Get the value of the input field with id="numb"
              un = document.getElementById("username").value;
              pw = document.getElementById("password").value;
              if(un.indexOf("^") > -1)
              {
                alert('Wrong username or password, please try again');
                document.getElementById("username").value="";
                document.getElementById("password").value="";
                return false;
              }
              if(un.indexOf("'") > -1)
              {
                alert('Wrong username or password, please try again');
                document.getElementById("username").value="";
                document.getElementById("password").value="";
                return false;
              }
              if(un.indexOf("\\") > -1)
              {
                alert('Wrong username or password, please try again');
                document.getElementById("username").value="";
                document.getElementById("password").value="";
                return false;
              }
              else
              {
                return true;
              }
            }
            </script>

            <?php include $_SERVER['DOCUMENT_ROOT'] . '/pupwebdev/footer.php' ?>
