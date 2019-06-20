<?php
include("connection.php");
$deliveriesId = $_POST['deliveriesId'];

$query = mysqli_query($conn, "UPDATE deliveries SET delivered=1 WHERE id='$deliveriesId'");
include('checkOrders.php');
?>
    <script type="text/javascript">
        var x = document.getElementById("snackbar");
        x.className = "show";
        var val = document.createTextNode("Trimis spre livrare.");
        x.appendChild(val);
        setTimeout(function () {
            x.className = x.className.replace("show", "");
        }, 3000);
    </script>
<?php