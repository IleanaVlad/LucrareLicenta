<?php
error_reporting(0);
include("connection.php");
$price = strVal($_GET['price']);
$color = strVal($_GET['color']);

$query1 = "SELECT * FROM product";

if ($price != "" || $color != "")
    $query1 .= " WHERE ";
if ($price != "")
    $query1 .= " price = '" . $price . "'";

if ($color != "")
    if ($price != "")
        $query1 .= " AND color = '" . $color . "'";
    else
        $query1 .= " color = '" . $color . "'";

$query2 = mysqli_query($conn, $query1);
if (mysqli_num_rows($query2) > 0) {
    while ($row = mysqli_fetch_array($query2)) {
        $rows [] = $row;
    }
    echo json_encode($rows);
} else {
    echo json_encode(['no']);
}
