<?php
if (isset($_POST['submit'])) {
    include "connection.php";
    $nameProduct = $_POST['nameProduct'];
    $priceProduct = $_POST['priceProduct'];
    $colorProduct = $_POST['colorProduct'];
    $quantityProduct = $_POST['quantityProduct'];
    $descriptionProduct = $_POST['descriptionProduct'];

    $userImages = "userImages/";
    $nameImage = $_FILES['sourcePhoto']['name'];
    $file = $userImages . basename($nameImage);
    $imageFileType = strtolower(pathinfo($file, PATHINFO_EXTENSION));
    $photo = $_FILES['sourcePhoto']['tmp_name'];

    if ($photo == null) {
        include("addProductsPage.php");
        ?>
        <script type="text/javascript">
            var x = document.getElementById("snackbar");
            x.className = "show";
            var val = document.createTextNode("Selectati o imagine.");
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
                include('addProductsPage.php');
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
                $linkImage = "images/" . $nameImage;
                if ($_FILES["sourcePhoto"]["name"]) {
                    include "connection.php";
                    $query = "INSERT INTO product (name,link,price,color,quantity,description) VALUES ('$nameProduct','$linkImage','$priceProduct','$colorProduct','$quantityProduct','$descriptionProduct')";

                    if ($conn->query($query) == TRUE) {
                        include('addProductsPage.php');
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
                    } else {
                        include "addProductsPage.php";
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
                    $conn->close();
                } else {
                    include "addProductsPage.php";
                    ?>
                    <script type="text/javascript">
                        var x = document.getElementById("snackbar");
                        x.className = "show";
                        var val = document.createTextNode("Imgainea nu a fost gasita. Incercati din nou.");
                        x.appendChild(val);
                        setTimeout(function () {
                            x.className = x.className.replace("show", "");
                        }, 3000);
                    </script>
                    <?php
                }
            }
        } else {
            include("addProductsPage.php");
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