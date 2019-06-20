<?php
include('connection.php');
$id = $_POST['id'];
$price = $_POST['price'];
$color = $_POST['color'];
$quantity = $_POST['quantity'];
$description = $_POST['description'];

$query = "UPDATE product SET price='$price',color='$color',quantity='$quantity',description='$description' WHERE id='$id'";
if (mysqli_query($conn, $query)) {
    include('updateDeleteProductsPage.php');
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