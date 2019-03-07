<?php

include $_SERVER['DOCUMENT_ROOT'] . '/pupwebdev/dbc/dbc.php';

function additem($itemid,$donator,$condition,$unitprice,$serialnumber,$whereabouts,$borrowable)
{
  $pdo = pdo();
  $sql = "INSERT INTO iteminfo(itemID_FK,donatorID_FK,iteminfo.condition,unitPrice,serialNumber,whereabouts,borrowable,acquisitionDate) 
          VALUES (?,?,?,?,?,?,?,CURDATE());";
  $stmt =$pdo->prepare($sql);
  $stmt->execute([$itemid,$donator,$condition,$unitprice,$serialnumber,$whereabouts,$borrowable]);
}

$donatorid = "";
$unitprice = "";
$serialnumber = "";
$whereabouts = "";

if($_POST['selectDonatorId'] == "nodonator")
{
  $donatorid = null;
}
else
{
  $donatorid = $_POST['selectDonatorId'];
}

if(isset($_POST['unitprice']))
{
  $unitprice = null;
}
else
{
  $unitprice = $_POST['unitprice'];
}

if(isset($_POST['serialnumber']))
{
  $serialnumber = null;
}
else
{
  $serialnumber = $_POST['serialnumber'];
}

if(isset($_POST['whereabouts']))
{
  $whereabouts = null;
}
else
{
  $whereabouts = $_POST['whereabouts'];
}

$itemid = $_POST['selectItemId'];
$condition = $_POST['condition'];
$borrowable = $_POST['borrowable'];

additem($itemid,$donatorid,$condition,$unitprice,$serialnumber,$whereabouts,$borrowable);

?>