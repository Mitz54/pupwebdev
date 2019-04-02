<?php
include $_SERVER['DOCUMENT_ROOT'] . '/pupwebdev/dbc/dbc.php'; 

function checkifaccount($professorid)
{
	$pdo = pdo();
	$sql ="select * from account where professorID_FK = ?;";
	$stmt = $pdo->prepare($sql);
	$stmt->execute([$professorid]);

	return $stmt->rowCOUNT();
}

function getaccount()
{
	$pdo = pdo();
	$sql ="select * from professor inner join account on account.professorID_FK = professor.professorID where status = 1;";
	$stmt = $pdo->prepare($sql);
	$stmt->execute();

	if($stmt->rowCOUNT() > 0)
	{
	  $i = 0;
	  echo '<table id="table_1" class="table table-bordered table-hover" width="100%"s>
              <thead class="thead-light">
                <tr>
                  <th scope="col" >✔</th>
                  <th scope="col">ID</th>
                  <th scope="col">Staff Name</th>
                  <th scope="col">Position</th>
                  <th scope="col">Actions</th>
                </tr>
              </thead>
              <tbody>';
		while($row = $stmt->fetch())
		{
			if(checkifaccount($row['professorID']))
			{
				$i = $i + 1;
				$pos = "";
				if($row['accountType'] == "admin")
				{
					$pos = "Administrator";
				}
				else
				{
					$pos = "Head Administrator";
					
				}
				echo "<tr>";
					echo "<td><input type='checkbox' name='prof_checkbox' id='prof_checkbox' value='". $row['professorID'] ."'></td>";
					echo "<th scope='row'>".$i."</th>";
					echo "<td>".$row['firstName'].' '.$row['lastName']."</td>";
					echo "<td>".$pos."</td>";
					echo '<td><center><button type="button" id="'.$row['professorID'].'" class="btn btn-sm btn-secondary delete_staff_button"><i class="fas fa-times"></i></button></td></center>';
				echo "</tr>";
			}
		}
	   echo ' </tbody>
            </table>';
	}
	else
	{
		echo "<center>No Staff</center>";
	}
	
}

getaccount();


?>