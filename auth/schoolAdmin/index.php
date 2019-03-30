<?php session_start();
require "logincheck.php";?>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/pupwebdev/auth/header.php';
      include($_SERVER['DOCUMENT_ROOT'].'/pupwebdev/auth/dbConnect.php'); ?>

<style>
      

</style>

<div class="container-fluid">
  <div class="row">
    <div class="side-navigation">
      <?php include 'navigation.php' ?>
    </div>
    <div class="col main-content">
      <div class="module-container">
        <div class="row">
          <div class="col">
            <div class="annoucement-box">
              <div class="card">
                <div class="card-header">
                  Annoucement
                </div>
                <div class="card-body">
                  <blockquote class="blockquote mb-0">
                    <p>srfy66hijkkiuhiugyt5r</p>
                    <footer class="blockquote-footer">Administrator at Office #1</footer>
                  </blockquote>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col">
            <div class="card">
              <div class="card-body">
                <h2 class="card-title">1</h2>
                <p class="card-text">Number of Items</p>
              </div>
              <div class="card-footer">
                <a href="inventory.php" class="btn btn-pupcustomcolor">More Info</a>
              </div>
            </div>
          </div>
          <div class="col">
            <div class="card">
              <div class="card-body">
                <h2 class="card-title">1</h2>
                <p class="card-text">Number of Borrowers</p>
              </div>
              <div class="card-footer">
                <a href="borrowing.php" class="btn btn-pupcustomcolor">More Info</a>
              </div>
            </div>
          </div>
          <div class="col">
            <div class="card">
              <div class="card-body">
                <h2 class="card-title"><?php
                $sql = "CALL selectPendingReservationSchedule()";
                $result=$con->query($sql);
                $rowcount=mysqli_num_rows($result);
                echo $rowcount;

                ?></h2>
                
                <p class="card-text">Number of Requests</p>
              </div>
              <div class="card-footer">
                <a href="pendingReservation.php" class="btn btn-pupcustomcolor">More Info</a>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col">
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/pupwebdev/auth/footer.php' ?>
