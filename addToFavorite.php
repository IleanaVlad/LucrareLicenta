<?php
include("connection.php");

$url = $_SERVER['HTTP_REFERER'];
if ($url != "http://localhost:63342/OnlineShop/productDetails.php") {
    $name = $_POST['name'];
    $query1 = mysqli_query($conn, "SELECT * FROM product_order WHERE id = '" . $name . "'");
    if (mysqli_num_rows($query1) > 0) {
        $row1 = mysqli_fetch_array($query1);
        $productId = $row1[1];
        $userId = $row1[2];
        $quantity = $row1[4];
        $query2 = mysqli_query($conn, "SELECT quantity FROM product WHERE id = '" . $productId . "'");
        if (mysqli_num_rows($query2) > 0) {
            $row2 = mysqli_fetch_array($query2);
            $oldQuantity = $row2[0];
            $newQuantity = $oldQuantity + $quantity;
            //echo "$newQuantity";
            $query3 = "UPDATE product SET quantity = '" . $newQuantity . "' WHERE id = '" . $productId . "'";
            if (mysqli_query($conn, $query3)) {
                $query4 = mysqli_query($conn, "DELETE FROM product_order WHERE id = '" . $name . "'");
                $query5 = mysqli_query($conn, "SELECT * FROM wish_list WHERE id_user='$userId' AND id_product='$productId'");
                if (mysqli_num_rows($query5) > 0) {
                    $row5 = mysqli_fetch_array($query5);
                } else {
                    $query6 = mysqli_query($conn, "INSERT INTO wish_list(id_user,id_product) VALUES ($userId,$productId)");
                }
            }
        }
    }
    include('shoppingCart.php');
    ?>
    <script type="text/javascript">
        var x = document.getElementById("snackbar");
        x.className = "show";
        var val = document.createTextNode("Produsul a fost mutat in lista de dorinte.");
        x.appendChild(val);
        setTimeout(function () {
            x.className = x.className.replace("show", "");
        }, 3000);
    </script>
    <?php
} else {

    $productId = $_POST['product'];
    $username = $_POST['username'];
    $query1 = mysqli_query($conn, "SELECT id FROM users WHERE username='$username'");
    if (mysqli_num_rows($query1) > 0) {
        $row1 = mysqli_fetch_array($query1);
        $userId = $row1[0];

        $query2 = mysqli_query($conn, "SELECT * FROM wish_list WHERE id_user='$userId' AND id_product='$productId'");
        if (mysqli_num_rows($query2) > 0) {
            $row2 = mysqli_fetch_array($query2);
        } else {
            $query3 = mysqli_query($conn, "INSERT INTO wish_list(id_user,id_product) VALUES ($userId,$productId)");
        }
        include('clientHome.php');
        ?>
        <script type="text/javascript">
            var x = document.getElementById("snackbar");
            x.className = "show";
            var val = document.createTextNode("Produsul a fost adaugat in lista de dorinte.");
            x.appendChild(val);
            setTimeout(function () {
                x.className = x.className.replace("show", "");
            }, 3000);
        </script>
        <?php
    }
}