<?php
if (isset($_POST['submit'])) {
    $userImages = "bookmark/";
    $nameImage = $_FILES['sourcePhoto']['name'];
    $file = $userImages . basename($nameImage);
    $imageFileType = strtolower(pathinfo($file, PATHINFO_EXTENSION));
    $photo = $_FILES['sourcePhoto']['tmp_name'];

    if ($photo == null) {
        include("customize.php");
        ?>
        <script type="text/javascript">
            var x = document.getElementById("snackbar");
            x.className = "show";
            var val = document.createTextNode("Selectati o imagine!");
            x.appendChild(val);
            setTimeout(function () {
                x.className = x.className.replace("show", "");
            }, 3000);
        </script>
        <?php
        return;
    } else {
        $check = getimagesize($photo);
        if ($check !== false) {
            if ($_FILES['sourcePhoto']['size'] > 500000) {
                include('customize.php');
                ?>
                <script type="text/javascript">
                    var x = document.getElementById("snackbar");
                    x.className = "show";
                    var val = document.createTextNode("Imaginea este prea mare.");
                    x.appendChild(val);
                    setTimeout(function () {
                        x.className = x.className.replace("show", "");
                    }, 3000);
                </script>
                <?php
            } else {

                $dir = getcwd();
                if (is_uploaded_file($photo)) {
                    move_uploaded_file($photo, $dir . "/bookmark/" . $nameImage);
                }
                $linkImage = "bookmark/" . $nameImage;
                if ($_FILES["sourcePhoto"]["name"]) {
                    include "connection.php";
                    $username = $_POST['username'];

                    $query1 = mysqli_query($conn, "SELECT id FROM users WHERE username ='$username'");

                    if (mysqli_num_rows($query1) > 0) {
                        $row1 = mysqli_fetch_array($query1);
                        $userId = $row1[0];
                        $query2 = mysqli_query($conn, "INSERT INTO bookmark(id_user,link,date) VALUES ('$userId','$linkImage',CURDATE())");
                        include("customize.php");
                        ?>
                        <script type="text/javascript">
                            var x = document.getElementById("snackbar");
                            x.className = "show";
                            var val = document.createTextNode("Imaginea a fost incarcata si trimisa.");
                            x.appendChild(val);
                            setTimeout(function () {
                                x.className = x.className.replace("show", "");
                            }, 3000);
                        </script>
                        <?php
                    } else {
                        include "customize.php";
                        ?>
                        <script type="text/javascript">
                            var x = document.getElementById("snackbar");
                            x.className = "show";
                            var val = document.createTextNode("Eroare la incarcare. Incercati din nou.");
                            x.appendChild(val);
                            setTimeout(function () {
                                x.className = x.className.replace("show", "");
                            }, 3000);
                        </script>
                        <?php
                    }
                } else {
                    ?>
                    <script type="text/javascript">
                        alert("Imaginea nu a fost gasita. Incercati din nou.");
                    </script>
                    <?php
                    include "customize.php";
                    ?>
                    <script type="text/javascript">
                        var x = document.getElementById("snackbar");
                        x.className = "show";
                        var val = document.createTextNode("Imaginea nu a fost gasita. Incercati din nou.");
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
