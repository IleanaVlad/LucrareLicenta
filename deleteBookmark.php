<?php
include("connection.php");
$id = $_POST['deleteBookmark'];

$query4 = mysqli_query($conn, "DELETE FROM bookmark WHERE id = '" . $id . "'");
include('showBookmarks.php');
?>

<script type="text/javascript">
    var x = document.getElementById("snackbar");
    x.className = "show";
    var val = document.createTextNode("Semn de carte sters.");
    x.appendChild(val);
    setTimeout(function () {
        x.className = x.className.replace("show", "");
    }, 3000);
</script>
