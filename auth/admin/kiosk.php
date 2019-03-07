<?php session_start(); ?>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/pupwebdev/auth/header.php' ?>


<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/CSS/bootstrap.min.css" rel="stylesheet" >
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round|Open+Sans">
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<link rel="stylesheet" href="/pupwebdev/assets/stylesheet/admin.css" >

<style>
  .card {
    margin-bottom: 15px;
  }

  .card-header {
    background-color: #a12c28;
    color: white;
  }
</style>
<script src="\pupwebdev\assets\javascript\jquery-3.3.1.min.js" type='text/javascript'>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/pupwebdev/auth/footer.php' ?>
<?php
	$officeinfos = require 'php\GetOfficeInfo.php';
	$x=0;
	$y=0;
?>

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
                 <h3>Now Serving</h3>
                </div>
              </div>
            </div>
          </div>
        </div>
		<div id="display_info">
		<?php
			// require 'php\RTQLoadAdmin.php';
		?>
		 </div> 
<!--
<script type="text/javascript">

  $(function() {
        $("#datePicker").datetimepicker({
            defaultDate:'now'

        });
    });
</script>
-->
<script type="text/javascript">
		$(document).ready(function()
		{
			setInterval(function(){
			
				$('#display_info').load('php/RTQLoadAdmin.php').fadeIn("slow");
			}, 200);
		});
		
			// function LOAD()
			// {
				// $.ajax({
					// url:'php/RTQLoad.php',
					// method:'post',
					// success:function(data)
					// {
						// $('#display_info').html(data);
						
					// }
				// });
				// $('#display_info').html('');
			// $('#display_info').load('php\RTQLoad.php').fadeIn("slow");
				// $( "#display_info" ).load( "php/RTQLoad.php" );
				
			// }
			// LOAD();
			// setInterval(LOAD,1000);
</script>