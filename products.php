<?php

error_reporting(0);
include("connection.php");
$parameter = $_GET['parameter'];

$query = mysqli_query($conn,"SELECT  DISTINCT $parameter FROM product ORDER BY $parameter ASC");
echo "<option value=''>toate</option>";
if(mysqli_num_rows($query) > 0) {

    while($row = mysqli_fetch_array($query)) {

        echo "<option>" . $row[$parameter] . "</option>";
    }
} else {
    echo "0 results";
}

