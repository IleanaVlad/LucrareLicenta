<?php
error_reporting(0);
include ('connection.php');
$param=$_GET['param'];
$query = mysqli_query($conn, "SELECT id, name, link, price, color  FROM product");
if(mysqli_num_rows($query) > 0) {
    while($row = mysqli_fetch_array($query)) {
        $rows[] = $row;
    }
    echo json_encode($rows);
}
else {
    echo "0 results";
}
