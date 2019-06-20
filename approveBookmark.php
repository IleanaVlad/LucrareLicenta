<?php
include("connection.php");
if (isset($_POST['save-button'])) {
    $id = $_POST['bookmarkId'];
    $price = $_POST['price'];
    $query = mysqli_query($conn, "UPDATE bookmark SET price='$price',evaluation_date=CURDATE(),checked=1 WHERE id='$id'");
    include('checkBookmarks.php');
    ?>
    <script type="text/javascript">
        var x = document.getElementById("snackbar");
        x.className = "show";
        var val = document.createTextNode("Detalii adaugate.");
        x.appendChild(val);
        setTimeout(function () {
            x.className = x.className.replace("show", "");
        }, 3000);
    </script>
    <?php
}