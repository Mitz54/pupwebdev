<?php

$host = "localhost";
	$user= "root";
	$password= "649959948";
	$dbname = "pup";

	//SET DSN data source name
	$dsn = 'mysql::host='.$host.';dbname='.$dbname;

	//Create a PDO instance
	$pdo = new PDO($dsn,$user,$password);
	$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_ASSOC);//set default fetch object 
	$pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES,false);//to use limits


  $sql = "UPDATE borroweditems set verified_items = 2;";
  $stmt = $pdo->prepare($sql);
  $stmt->execute();
  if($stmt->execute())
  {
 	echo 'success'; 	
  }

?>