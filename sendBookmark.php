<?php
include("connection.php");
$userId = $_POST['userId'];
$firstName = $_POST['firstName'];
$lastName = $_POST['lastName'];
$email = $_POST['email'];
$city = $_POST['city'];
$address = $_POST['address'];
$phone = $_POST['phone'];
$sum = $_POST['sum'];

$link = $_POST['link'];
$query1 = mysqli_query($conn, "SELECT * FROM bookmark WHERE link='$link'");
if (mysqli_num_rows($query1) > 0) {
    $row1 = mysqli_fetch_array($query1);
    $bookmarkId = $row1[0];
    $query1 = "UPDATE bookmark SET ordered='1' WHERE link='$link'";
    if (mysqli_query($conn, $query1)) {
        $query2 = mysqli_query($conn, "INSERT INTO deliveries(id_user,first_name,last_name,email,city,address,phone,sum,date) VALUES ('$userId','$firstName','$lastName','$email','$city','$address','$phone','$sum',CURDATE())");

        $query2 = mysqli_query($conn, "SELECT * FROM deliveries ORDER BY id DESC LIMIT 1");
        if (mysqli_num_rows($query2) > 0) {
            $row2 = mysqli_fetch_array($query2);
            $id = $row2[0];
            $query3 = mysqli_query($conn, "INSERT INTO bookmark_order(id_bookmark,id_deliveries) VALUES ('$bookmarkId','$id')");

        }
    }
}

include('showBookmarks.php');
?>
<script type="text/javascript">
    var x = document.getElementById("snackbar");
    x.className = "show";
    var val = document.createTextNode("Comanda a fost trimisa.");
    x.appendChild(val);
    setTimeout(function () {
        x.className = x.className.replace("show", "");
    }, 3000);
</script>
