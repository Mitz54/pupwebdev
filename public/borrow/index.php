<?php include $_SERVER['DOCUMENT_ROOT'] . '/pupwebdev/public/header.php'; ?>

<div class="container" >
    <div class="row">
      <div class="col-6 offset-3">
        <div class="custom-container" style="margin-top: 50%;" >
          <div class="custombox-form">
            <span class="custombox-title">
              WELCOME!
            </span>
              <form >
                <div class="custombox-input">
                  <section>
                    <h6>Choose a type of user.</h6>
                  </section>
                  <section >
                    <span class="custombox-options" >
                      <a href="classRep.php" class="btn btn-sm btn-pupcustomcolor" role="button">Class Representative</a>
                      <a href="orgRep.php" class="btn btn-sm btn-pupcustomcolor" role="button">Organization Representative</a>
                      <a href="pupStaff.php" class="btn btn-sm btn-pupcustomcolor" role="button">PUPSRC Staff</a>
                    </span>
                  </section>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
</div>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/pupwebdev/public/footer.php'; ?>