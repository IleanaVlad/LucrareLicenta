<?php
include('loginDB.php');

if (!isLoggedIn()) {
    header('location: login.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Admin</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.7.0/css/all.css'
          integrity='sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ' crossorigin='anonymous'>
    <link rel="stylesheet" href="style.css">
    <style>
        .content {
            padding-right: 15px;
            padding-left: 15px;
            margin-right: auto;
            margin-left: auto;
        }

        .center {
            text-align: center;
            margin-top: 10%;
        }

        .nothingInCart {
            font-size: 200%;
        }

        .img-prod {
            height: 180px;
            width: 130px;
        }

        .img-bookmark {
            height: 225px;
            width: 130px;
        }
    </style>
    <script>
    </script>
</head>
<body>
<div>
    <div class="d-inline">
        <img src="myLogo.png" class="myLogo">
    </div>
    <div class="options d-inline">
        <span class="dropdown"><i class="far fa-user-circle"></i>
            <a href="#" class=" dropdown dropdown-toggle link-text" data-toggle="dropdown">Contul meu</a>
            <div class="dropdown-menu justify-content-center">
                <h5 class="dropdown-header">Buna,  <?php if (isset($_SESSION['user'])) :
                        echo $_SESSION['user']['username'];endif ?>!</h5>
                <a class="dropdown-item" href="adminHome.php">Pagina principala</a>
                <a class="dropdown-item" href="addProductsPage.php">Adauga produse</a>
                <a class="dropdown-item" href="updateDeleteProductsPage.php">Actualizeaza/sterge produse</a>
                <a class="dropdown-item" href="checkOrders.php">Verifica comenzi</a>
                <a class="dropdown-item" href="checkBookmarks.php">Produse personalizate</a>
            </div>
        </span>
        <i class="fas fa-sign-out-alt"></i><a href="clientHome.php?logout"><span
                    class="link-text">Deconectare</span></a>
    </div>
</div>
<br>
<br>
<?php
include("connection.php");
$nr1 = 0;
$nr2 = 0;
?>
<div class="content">
    <div class="row">
        <?php
        $query1 = mysqli_query($conn, "SELECT DISTINCT id_deliveries FROM order_deliveries ORDER BY id_deliveries DESC");
        if (mysqli_num_rows($query1) > 0) {
        ?>
        <div class="col-6">

            <?php
            while ($row1 = mysqli_fetch_array($query1)) {
                $deliveriesId = $row1[0];
                $query2 = mysqli_query($conn, "SELECT sum, date FROM deliveries WHERE id='$deliveriesId' AND delivered=0");
                if (mysqli_num_rows($query2) > 0) {
                    $nr1 = mysqli_num_rows($query2);
                    $row2 = mysqli_fetch_array($query2);
                    $sum = $row2[0];
                    $date = $row2[1];
                    ?>
                    <form action="sendOrderToDelivery.php" method="post">
                        <input type="hidden" name="deliveriesId" id="deliveriesId" value="<?php echo $deliveriesId; ?>">
                        <div class="col">
                            <div class="list-group-item container">
                                <div class="row">
                                    <div class="col-6">
                                        <div>
                                            <h5><strong>Comanda nr. <?php echo $deliveriesId ?></strong></h5>
                                        </div>
                                        <div>
                                            <h6> Plasata pe: <?php echo $date ?></h6>
                                        </div>
                                        <div>
                                            <h6> Total: <?php echo $sum ?> lei</h6>
                                        </div>
                                        <br>
                                        <br>
                                    </div>
                                    <?php
                                    $query3 = mysqli_query($conn, "SELECT * FROM deliveries WHERE id='$deliveriesId'");
                                    if (mysqli_num_rows($query3) > 0) {
                                        $row3 = mysqli_fetch_array($query3);
                                        $firstName = $row3[2];
                                        $lastName = $row3[3];
                                        $city = $row3[5];
                                        $address = $row3[6];
                                        $phone = $row3[7];
                                        ?>
                                        <div class="col-6">
                                            <div>
                                                <h5><strong>Solicitata de : <?php echo $firstName;
                                                        echo " ";
                                                        echo $lastName ?></strong></h5>
                                            </div>
                                            <div>
                                                <h6> Numar de telefon: <?php echo $phone ?></h6>
                                            </div>
                                            <div>
                                                <h6> La adresa: <?php echo $address;
                                                    echo ", ";
                                                    echo $city ?></h6>
                                            </div>
                                        </div>

                                        <br>
                                        <?php
                                    }
                                    $query4 = mysqli_query($conn, "SELECT id_order FROM order_deliveries WHERE id_deliveries='$deliveriesId'");
                                    if (mysqli_num_rows($query4) > 0) {
                                        while ($row4 = mysqli_fetch_array($query4)) {
                                            $orderId = $row4[0];
                                            $query5 = mysqli_query($conn, "SELECT * FROM product_order WHERE id='$orderId'");
                                            if (mysqli_num_rows($query5) > 0) {
                                                $row5 = mysqli_fetch_array($query5);
                                                $productId = $row5[1];
                                                $quantity = $row5[4];
                                                $query6 = mysqli_query($conn, "SELECT * FROM product WHERE id='$productId'");
                                                if (mysqli_num_rows($query6) > 0) {
                                                    $row6 = mysqli_fetch_array($query6);
                                                    $link = $row6[2];
                                                    $price = $row6[3];
                                                    ?>
                                                    <div class="col-4">
                                                        <div>
                                                            <img src="<?php echo $link ?>" class="img-prod">
                                                        </div>
                                                        <br>
                                                    </div>
                                                    <div class="col-6">
                                                        <br>
                                                        <br>
                                                        <div>Pret produs: <?php echo $price ?> lei</div>
                                                        <div>Numar de bucati
                                                            comandate: <?php echo $quantity ?></div>
                                                        <div></div>
                                                    </div>
                                                    <br>
                                                    <?php
                                                }
                                            }
                                        }
                                    }
                                    ?>
                                    <div class="mx-auto">
                                        <button class="btn btn-labeled btn-success">
                                            <span class="btn-label"><i class="fas fa-paper-plane"></i></span> Trimite
                                            catre livrare
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    <br><?php
                }
            }
            }

            ?>
        </div>
        <?php
        $query7 = mysqli_query($conn, "SELECT * FROM bookmark_order ORDER BY id DESC");
        if (mysqli_num_rows($query7) > 0) {
        ?>
        <div class="col-6">
            <?php
            while ($row7 = mysqli_fetch_array($query7)) {
                $id = $row7[0];
                //echo $id;
                $idDeliveries = $row7[2];
                $query8 = mysqli_query($conn, "SELECT * FROM deliveries WHERE id='$idDeliveries' AND delivered=0");
                if (mysqli_num_rows($query8) > 0) {
                    $nr2 = mysqli_num_rows($query8);
                    $row8 = mysqli_fetch_array($query8);
                    $sum1 = $row8[8];
                    $date1 = $row8[9];
                    $firstName1 = $row8[2];
                    $lastName1 = $row8[3];
                    $city1 = $row8[5];
                    $address1 = $row8[6];
                    $phone1 = $row8[7];
                    ?>
                    <form action="sendOrderToDelivery.php" method="post">
                        <input type="hidden" name="deliveriesId" id="deliveriesId" value="<?php echo $idDeliveries; ?>">

                        <div class="col">
                            <div class="list-group-item container">
                                <div class="row">
                                    <div class="col-6">
                                        <div>
                                            <h5><strong>Comanda nr. b<?php echo $id ?></strong></h5>
                                        </div>
                                        <div>
                                            <h6> Plasata pe: <?php echo $date1 ?></h6>
                                        </div>
                                        <div>
                                            <h6> Total: <?php echo $sum1 ?> lei</h6>
                                        </div>
                                        <br>
                                        <br>
                                    </div>
                                    <div class="col-6">
                                        <div>
                                            <h5><strong>Solicitata de: <?php echo $firstName1;
                                                    echo " ";
                                                    echo $lastName1 ?></strong></h5>
                                        </div>
                                        <div>
                                            <h6> Numar de telefon: <?php echo $phone1 ?></h6>
                                        </div>
                                        <div>
                                            <h6> La adresa: <?php echo $address1;
                                                echo ", ";
                                                echo $city1 ?></h6>
                                        </div>
                                    </div>
                                    <?php
                                    $query9 = mysqli_query($conn, "SELECT id_bookmark FROM bookmark_order WHERE id_deliveries='$idDeliveries'");
                                    if (mysqli_num_rows($query9) > 0) {
                                        while ($row9 = mysqli_fetch_array($query9)) {
                                            $bookmarkId = $row9[0];
                                            $query10 = mysqli_query($conn, "SELECT * FROM bookmark WHERE id='$bookmarkId'");
                                            if (mysqli_num_rows($query10) > 0) {
                                                $row10 = mysqli_fetch_array($query10);
                                                $link1 = $row10[2];
                                                $price1 = $row10[5];
                                                ?>
                                                <div class="col-4">
                                                    <div>
                                                        <img src="<?php echo $link1 ?>" class="img-bookmark">
                                                    </div>
                                                    <br>
                                                </div>
                                                <div class="col-6">
                                                    <br>
                                                    <br>
                                                    <div>Pret produs: <?php echo $price1 ?> lei</div>
                                                    <br>
                                                    <br>
                                                    <div>
                                                        <button class="btn btn-labeled btn-success">
                                                            <span class="btn-label"><i
                                                                        class="fas fa-paper-plane"></i></span> Trimite
                                                            catre livrare
                                                        </button>
                                                    </div>
                                                </div>
                                                <?php
                                            }
                                        }
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </form>
                    <br>
                    <?php
                }
            }
            }

            ?>
        </div>
    </div>
</div>
<?php
if ($nr1 == 0 && $nr2 == 0) {
    ?>
    <div class="center">
        <div class="nothingInCart">Nu au fost solicitate comenzi.
        </div>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
    </div>
    <?php
}
?>
<div id="snackbar"></div>
<br>
<br>
<br>
<br>
<hr class="mt-0 d-inline-block" style="width: 100%;">
<div class="content-footer">
    <div class="row-footer">
        <div class="col-md-4">
            <h6 class="text-uppercase font-weight-bold">Contact</h6>
            <hr class="mt-0 d-inline-block" style="width: 20%;">
            <p>
                <i class="fas fa-home"></i> &nbsp; Cluj-Napoca, Romania</p>
            <p>
                <i class="fas fa-envelope"></i> &nbsp; artsyhandmade@gmail.com</p>
            <p>
                <i class="fas fa-phone"></i> &nbsp; 0756315719</p>
            <p>
        </div>
        <div class="col-md-8">
            <h6 class="text-uppercase font-weight-bold">Urmariti-ne pe</h6>
            <hr class="mt-0 d-inline-block" style="width: 20%;">
            <p>
                <a href="https://www.facebook.com/" target="_blank" class="follow-us">
                    <i class="fab fa-facebook-f white-text mr-md-5 fa-2x"> </i>
                </a>
                <a href="https://www.instagram.com/" target="_blank" class="follow-us">
                    <i class="fab fa-instagram white-text mr-md-5 fa-2x"> </i>
                </a>
                <a href="https://ro.pinterest.com/" target="_blank" class="follow-us">
                    <i class="fab fa-pinterest white-text fa-2x"> </i>
                </a>

            </p>
        </div>
    </div>
</div>
<div class="text-center">
    <hr class="mt-0 d-inline-block" style="width: 80%;">
    <div>&copy; 2019 ARTSY HANDMADE</div>
</div>
<br>
</body>
</html>