<?php
include("connection.php");
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
        $query3 = "UPDATE product SET quantity = '" . $newQuantity . "' WHERE id = '" . $productId . "'";
        if (mysqli_query($conn, $query3)) {
            $query4 = mysqli_query($conn, "DELETE FROM product_order WHERE id = '" . $name . "'");
        }
    }
}
include('shoppingCart.php');
?>
    <script type="text/javascript">
        var x = document.getElementById("snackbar");
        x.className = "show";
        var val = document.createTextNode("Produsul a fost sters din cos.");
        x.appendChild(val);
        setTimeout(function () {
            x.className = x.className.replace("show", "");
        }, 3000);
    </script>
<?php
