<?php
include("connection.php");
$user = $_POST['username'];
$firstName = $_POST['firstName'];
$lastName = $_POST['lastName'];
$email = $_POST['email'];
$city = $_POST['city'];
$address = $_POST['address'];
$phone = $_POST['phone'];
$sum = $_POST['sum'];

$query1 = mysqli_query($conn, "SELECT * FROM users WHERE username= '" . $user . "'");
if (mysqli_num_rows($query1) > 0) {
    $row1 = mysqli_fetch_array($query1);
    $userId = $row1[0];
    $query2 = mysqli_query($conn, "INSERT INTO deliveries(id_user,first_name,last_name,email,city,address,phone,sum,date) VALUES ('$userId','$firstName','$lastName','$email','$city','$address','$phone','$sum',CURDATE())");
    $query3 = mysqli_query($conn, "SELECT * FROM deliveries ORDER BY id DESC LIMIT 1");
    if (mysqli_num_rows($query3) > 0) {
        $row2 = mysqli_fetch_array($query3);
        $id = $row2[0];

        $query4 = mysqli_query($conn, "SELECT * FROM product_order WHERE id_user= '" . $userId . "' AND ordered=0");
        if (mysqli_num_rows($query4) > 0) {
            while ($row4 = mysqli_fetch_array($query4)) {
                $productOrderId = $row4[0];

                $query5 = mysqli_query($conn, "INSERT INTO order_deliveries(id_order,id_deliveries) VALUES ('$productOrderId','$id')");
                $query6 = "UPDATE product_order SET ordered='1' WHERE id_user='$userId'";
                if (mysqli_query($conn, $query6)) {
                }
            }
        }
    }
}
include('shoppingCart.php');
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