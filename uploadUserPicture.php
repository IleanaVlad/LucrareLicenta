<?php
if (isset($_POST['submit'])) {
    $userImages = "userImages/";
    $nameImage = $_FILES['sourcePhoto']['name'];
    $file = $userImages . basename($nameImage);
    $imageFileType = strtolower(pathinfo($file, PATHINFO_EXTENSION));
    $photo = $_FILES['sourcePhoto']['tmp_name'];

    if ($photo == null) {
        include("settingsAccount.php");
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
    } else {
        $check = getimagesize($photo);
        if ($check !== false) {
            if ($_FILES['sourcePhoto']['size'] > 500000) {
                include('settingsAccount.php');
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
                    move_uploaded_file($photo, $dir . "/userImages/" . $nameImage);
                }
                $linkImage = "userImages/" . $nameImage;
                if ($_FILES["sourcePhoto"]["name"]) {
                    include "connection.php";
                    $user = $_POST['username'];
                    $query = "UPDATE users SET name_image='$nameImage', link_image='$linkImage' WHERE username='$user'";
                    if (mysqli_query($conn,$query) == TRUE) {
                        include("settingsAccount.php");
                        ?>
                        <script type="text/javascript">
                            var x = document.getElementById("snackbar");
                            x.className = "show";
                            var val = document.createTextNode("Actualizare cu succes.");
                            x.appendChild(val);
                            setTimeout(function () {
                                x.className = x.className.replace("show", "");
                            }, 3000);
                        </script>
                        <?php
                    } else {
                        include "settingsAccount.php";
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
                    include "settingsAccount.php";
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
        } else {
            include("settingsAccount.php");
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
        }
    }
}
