<?php
include('connection.php');
$userId = $_POST['userId'];
$firstName = $_POST['firstName'];
$lastName = $_POST['lastName'];
$email = $_POST['email'];
$city = $_POST['city'];
$address = $_POST['address'];
$phone = $_POST['phone'];

$query = "UPDATE users SET first_name = '$firstName', last_name = '$lastName', email = '$email', city = '$city', address = '$address', phone = '$phone' WHERE id='$userId'";
if (mysqli_query($conn, $query)) {
    include('settingsAccount.php');
    ?>
    <script type="text/javascript">
        var x = document.getElementById("snackbar");
        x.className = "show";
        var val = document.createTextNode("Detalii actualizate.");
        x.appendChild(val);
        setTimeout(function () {
            x.className = x.className.replace("show", "");
        }, 3000);
    </script>
    <?php
}