<?php 
  if(!isset($_SESSION['username']) || empty($_SESSION['username']))
  {
    
     echo "<script>alert('Please log in first.');</script>";
     header("Location: ../../index.php");
     exit();
  }
  else {  //log in check if same office user
    redirect();
  }
  function redirect()
  {
    if($_SESSION["accountType"] == "admin")
    {

    }
    else
    {
      if($_SESSION["office"] == "Administrative Services and Property"){
        header ("Location: /pupwebdev/auth/schoolAdmin/index.php");
        $con=null;
  
      }
      else if($_SESSION["office"] == "Academic Services Office")
      {
      header("Location: /pupwebdev/auth/acadservice/acadService_Scheduler.php");
      $con=null;
      }
      else if($_SESSION["accountType"] == 'prof')
      {
          header("Location: /pupwebdev/auth/office/queuePerOffice.php");
          $con=null;
      }
      else
      {
        $message = 'catcher';
      // echo "<script> alert('".$message."'); </script>"; 
      header("Location: ../../index.php");
        unset($_SESSION['username']);
        session_destroy();
      }
    }
  }
?>