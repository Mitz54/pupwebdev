<?php

include $_SERVER['DOCUMENT_ROOT'] . '/pupwebdev/dbc/dbc.php';

function edititem($itemid,$donatorid,$condition,$unitprice,$serialnumber,$acquisitiondate,$whereabouts,$remarks,$condemndate,$borrowable,$iteminfoid)
{
  $pdo = pdo();
  $sql = "update iteminfo set itemID_FK = ?,donatorID_FK = ?,iteminfo.condition=?,unitPrice = ?,
          serialNumber=?,acquisitionDate = ?,whereabouts = ?,remarks=?,dateOfCondemn = ?,borrowable = ? where iteminfoID = ?;";
  $stmt = $pdo->prepare($sql);
  $stmt->execute([$itemid,$donatorid,$condition,$unitprice,$serialnumber,$acquisitiondate,$whereabouts,$remarks,$condemndate,$borrowable,$iteminfoid]);

  if (!$stmt->execute()) {
    print_r($stmt->errorInfo());
  }
}
//echo $_POST['acquisitionEdit'];
$acquisitiondate = "";
$condemndate = "";
if($_POST['acquisitionEdit'] == null)
{
  $acquisitiondate = null;
}
else
{
  $acquisitiondate = $_POST['acquisitionEdit'] ;
}

if($_POST['condemndateEdit'] == null)
{
  $condemndate = null;
}
else
{
  $condemndate = $_POST['condemndateEdit'] ;
}
edititem($_POST['selectItemIdEdit'],$_POST['selectDonatorIdEdit'],$_POST['conditionEdit'],$_POST['unitpriceEdit'],$_POST['serialnumberEdit'],$acquisitiondate,
  $_POST['whereaboutsEdit'],$_POST['remarksEdit'],$condemndate,$_POST['borrowableEdit'],$_POST['iteminfoidspecific']);



?>