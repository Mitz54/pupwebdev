<?php

function countItem($dconn)
{
    $sql = "SELECT COUNT(*) FROM `item`";
    $result = mysqli_query($dconn, $sql);
    $rows = mysqli_fetch_row($result);
    return $rows[0];
}

function countBorrower($dconn)
{
    $sql = "SELECT COUNT(*) FROM `borrower`";
    $result = mysqli_query($dconn, $sql);
    $rows = mysqli_fetch_row($result);
    return $rows[0];
}

function countRequest($dconn)
{
    $sql = "SELECT COUNT(*) FROM `borrowingdetails`";
    $result = mysqli_query($dconn, $sql);
    $rows = mysqli_fetch_row($result);
    return $rows[0];
}
?>