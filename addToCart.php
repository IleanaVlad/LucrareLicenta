<?php
include "connection.php";
$productId = $_POST['productId'];
$user = $_POST['username'];

$query1 = mysqli_query($conn, "SELECT quantity FROM product WHERE id='$productId'");

if (mysqli_num_rows($query1) > 0) {
    $row1 = mysqli_fetch_array($query1);
    $quantity = $row1[0];
    if ($quantity == 0 || $quantity <= 0) {
        include('clientHome.php');
        ?>
        <script type="text/javascript">
            var x = document.getElementById("snackbar");
            x.className = "show";
            var val = document.createTextNode("Stocul este epuizat.");
            x.appendChild(val);
            setTimeout(function () {
                x.className = x.className.replace("show", "");
            }, 3000);
        </script>
        <?php
    } else {
        $updateQuantity = $quantity - 1;
        $update = "UPDATE product SET quantity='$updateQuantity' WHERE id='$productId'";
        if (mysqli_query($conn, $update)) {
            $query2 = mysqli_query($conn, "SELECT id FROM users WHERE username='$user'");
            if (mysqli_num_rows($query2) > 0) {
                $row2 = mysqli_fetch_array($query2);
                $userId = $row2[0];

                $query3 = mysqli_query($conn, "SELECT * FROM product_order WHERE id_product='$productId' AND id_user='$userId' AND ordered=0");
                if (mysqli_num_rows($query3) > 0) {
                    $row3 = mysqli_fetch_array($query3);
                    $oldQuantity = $row3[4];

                    if ($oldQuantity != 0) {

                        $newQ = $oldQuantity + 1;
                        $updateProductShopping = "UPDATE product_order SET quantity='$newQ' WHERE id_product='$productId' AND id_user='$userId' AND ordered=0";
                        if (mysqli_query($conn, $updateProductShopping)) {
                            include('clientHome.php');
                            ?>
                            <script type="text/javascript">
                                var x = document.getElementById("snackbar");
                                x.className = "show";
                                var val = document.createTextNode("Produsul a fost adaugat.");
                                x.appendChild(val);
                                setTimeout(function () {
                                    x.className = x.className.replace("show", "");
                                }, 3000);
                            </script>
                            <?php
                        }
                    }
                } else {
                    $query4 = mysqli_query($conn, "INSERT INTO product_order(id_product,id_user,date,quantity,ordered) VALUES ($productId,$userId,CURDATE(),1,0)");
                    include('clientHome.php');
                    ?>
                    <script type="text/javascript">
                        var x = document.getElementById("snackbar");
                        x.className = "show";
                        var val = document.createTextNode("Produsul a fost adaugat in cos.");
                        x.appendChild(val);
                        setTimeout(function () {
                            x.className = x.className.replace("show", "");
                        }, 3000);
                    </script>
                    <?php

                }
            }
        }
    }
}
?>