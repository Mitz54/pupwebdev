<?php
		$officeinfos = require 'GetOfficeInfo.php';
		$x=0;
		$y=0;
		$z = 0;
		$b = 0;
		$first = true;
		$officeinfos = require 'GetOfficeInfo.php';
		require 'GetQueuePerOfficeLimit.php';
		for($x = 0; $x <2; $x++)
		{
			
			echo '<div class="row">';
			  for($y = 0; $y < 4; $y++)
			  {
				  $b=0;
				  $first = true;
				  echo '<div class="col">';
					echo '<div class="card">';
					  echo '<div class="card-header">';
						  echo '<h4 class="card-title text-center">'. $officeinfos[$z]['officeName'] . '</h4></div>';
						   $queuesinoffice = getQueuePerOffice( $officeinfos[$z]['officeID'] );
			 
						echo '<div class="card-body text-center">';
						  echo '<h4>Queue Number</h4>';
							
							
						foreach($queuesinoffice as $queueinoffice)
						{
							$q = str_pad($queueinoffice, 4, '0', STR_PAD_LEFT);
							if($first == true)
							{
								echo '<span class="queue-number" style="font-size: 40px;">'. $q .'</span><br>';
								echo '</div>';
								echo '<div class="card-footer">';
								echo '<h5 class="card-title text-center">Up Next:<br>';
								$first = false;
							}
							else
							{
									$b++;
								if($b == 3)
								{
									$b = 0;
									echo '<span class="next-number"> ' . $q . ' </span>';
									echo '<br>';
								}
								else
								{
									echo '<span class="next-number"> ' . $q . ' |</span>';
								
								}
							}
							
							
							
						}
						// echo '<span class="next-number">0002 |</span>';
						// echo '<span class="next-number">0002</span>';
						// echo '<span class="next-number">0002 |</span>';
						// echo '<span class="next-number">0002</span>';
						// echo '<span class="next-number">0002 |</span>';
						// echo '<span class="next-number">0002</span></h5>';
					  echo '</div>';
					echo '</div>';
				  echo '</div>';
				  $z++;
			  }
			echo '</div>';
		}
		?>