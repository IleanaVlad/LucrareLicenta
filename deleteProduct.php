<?php
include("connection.php");
if (isset($_POST['deleteProduct'])) {
    $id = $_POST['productId'];

    $query = mysqli_query($conn, "DELETE FROM product WHERE id = '" . $id . "'");
    include('updateDeleteProductsPage.php');
    ?>
    <script type="text/javascript">
        var x = document.getElementById("snackbar");
        x.className = "show";
        var val = document.createTextNode("Produs sters.");
        x.appendChild(val);
        setTimeout(function () {
            x.className = x.className.replace("show", "");
        }, 3000);
    </script>
    <?php
}