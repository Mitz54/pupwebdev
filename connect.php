<?php
  $host = 'localhost';
	$user = 'root';
	$pass = '649959948';
	$db = 'pup';
	$message = "";

	try
	{
	  $conn = new PDO("mysql:host=$host;dbname=$db", "root", "$pass");
	  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	}

	catch(PDOException $error)
	{
	  $message = $error->getMessage();

	}

function pdo()
{
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

	return $pdo;
}

function conn()
{
  $servername = "localhost";
  $username = "root";
  $password = "649959948";
  $dbname = "pup";

  // Create connection
  $conn = new mysqli($servername, $username, $password, $dbname);
  // Check connection
  if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
  } 

  return $conn;
}


?>