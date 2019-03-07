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
	$sql ="select * from professor inner join account on account.professorID_FK = professor.professorID where status = 0 and concat(firstName,' ',lastName) like concat('%',?,'%') ";
	$stmt = $pdo->prepare($sql);
	$stmt->execute([$_POST['search']]);

	if($stmt->rowCOUNT() > 0)
	{
	  $i = 0;
	  echo '<table class="table table-bordered table-hover">
              <thead class="thead-light">
                <tr>
                  <th scope="col">ID</th>
                  <th scope="col">Staff Name</th>
                  <th scope="col">Position</th>
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
					echo "<th scope='row'>".$i."</th>";
					echo "<td>".$row['firstName'].' '.$row['lastName']."</td>";
					echo "<td>".$pos."</td>";
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