<?php
include("connection.php");
$id = $_POST['name'];
$query4 = mysqli_query($conn, "DELETE FROM wish_list WHERE id = '" . $id . "'");
include("wishList.php");
?>
    <script type="text/javascript">
        var x = document.getElementById("snackbar");
        x.className = "show";
        var val = document.createTextNode("Produsul a fost sters din lista de dorinte.");
        x.appendChild(val);
        setTimeout(function () {
            x.className = x.className.replace("show", "");
        }, 3000);
    </script>
<?php

