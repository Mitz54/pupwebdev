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
    if($_SESSION["accountType"] == 'prof' && $_SESSION['accntID'] != 2 && $_SESSION['accntID'] != 3 && $_SESSION['accntID'] != 1)
    {

    }
    else
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
      else if($_SESSION['accntID'] == 1)  
      {
        header("Location: /pupwebdev/auth/admin/account.php");
        $con=null;
        exit();
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