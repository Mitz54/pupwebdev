<?php

$output = null;
if($_POST['Type'] == 1){

	$output.="<div>
				<label>Month</label>
				<select id='sel-monthly' class='form-control'>
				  <option value = 1>January</option>
                  <option value = 2>February</option>
                  <option value = 3>March</option>
                  <option value = 4>April</option>
                  <option value = 5>May</option>
                  <option value = 6>June</option>
                  <option value = 7>July</option>
                  <option value = 8>August</option>
                  <option value = 9>September</option>
                  <option value = 10>October</option>
                  <option value = 11>November</option>
                  <option value = 12>December</option>
				</select>

			</div>";


		$output.="<div>
				<label>Year</label>
				<select id='sel-monthly-year' class='form-control'>";

		
				 	for($i = date('Y') ; $i >= 2013; $i--){
      					$output.= "<option value= ".$i." > ".$i." </option>";
   					}
				 

	$output.="</select></div>";

}

if($_POST['Type'] == 2){

	$output.="<div>
				<label>Year</label>
				<select id='sel-yearly' class='form-control'>";

		
				 	for($i = date('Y') ; $i >= 2013; $i--){
      					$output.= "<option value= ".$i." > ".$i." </option>";
   					}
				 

	$output.="</select></div>";

}

if($_POST['Type'] == 3){

	$output='<label for="month">Start Date</label>
             <input type="date" class = "form-control" id = "start-date">
             <label for="month">End Date</label>
              <input type="date" class = "form-control" id = "end-date">';

}

echo $output;
?>