<?php
include('loginDB.php');
if (!isLoggedIn()) {
    header('location: login.php');
}
include "connection.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Comenzile mele</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.7.0/css/all.css'
          integrity='sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ' crossorigin='anonymous'>
    <link rel="stylesheet" href="style.css">

    <style>
        img {
            height: 230px;
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
                <a class="dropdown-item" href="settingsAccount.php">Setari cont</a>
                <a class="dropdown-item" href="showOrderDeliveries.php">Comenzile mele</a>
                <a class="dropdown-item" href="clientHome.php?logout">Deconectare</a>
            </div>
        </span>
        <i class='far fa-heart'></i><a href="wishList.php"><span class="link-text">Lista favorite</span></a>
        <i class="fa fa-shopping-cart"></i><a href="shoppingCart.php"><span class="link-text">Cos cumparaturi</span></a>
    </div>
</div>
<br>
<div class="navbar">
    <a href="aboutUs.php">Despre noi</a>
    <a href="clientHome.php">Cumparaturi</a>
    <a href="customize.php">Personalizeaza semn</a>
    <a href="showBookmarks.php">Semne personalizate</a>
</div>
<br>
<?php
include("connection.php");
$deliveriesId = $_POST['idDeliveries'];
$date = $_POST['dateBookmark'];
$sum = $_POST['sumBookmark'];
$id = $_POST['idBookmark'];
$username = $_SESSION['user']['username'];
?>
<div class=" d-flex justify-content-center">
    <div class="col-md-6">
        <div class="list-group-item flex-column align-items-start">
            <div class="container">
                <div class="row">
                    <div class="container">
                        <div class="row">
                            <div class="col-6">
                                <div>
                                    <h5><strong>Comanda nr. b<?php echo $id ?></strong></h5>
                                </div>
                                <div>
                                    <h6> Plasata pe: <?php echo $date ?></h6>
                                </div>
                                <div>
                                    <h6> Total: <?php echo $sum ?> lei</h6>
                                </div>
                            </div>
                            <?php
                            $query1 = mysqli_query($conn, "SELECT * FROM deliveries WHERE id='$deliveriesId'");
                            if (mysqli_num_rows($query1) > 0) {
                            $row1 = mysqli_fetch_array($query1);
                            $firstName = $row1[2];
                            $lastName = $row1[3];
                            $city = $row1[5];
                            $address = $row1[6];
                            $phone = $row1[7];
                            ?>
                            <div class="col-6">
                                <div>
                                    <h5><strong>Livrat catre: <?php echo $firstName;
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
                        </div>

                        <?php

                        $query2 = mysqli_query($conn, "SELECT * FROM users WHERE username='$username'");
                        if (mysqli_num_rows($query2) > 0) {
                        $row2 = mysqli_fetch_array($query2);
                        $userId = $row2[0];

                        $query3 = mysqli_query($conn, "SELECT id_bookmark FROM bookmark_order WHERE id_deliveries='$deliveriesId'");
                        if (mysqli_num_rows($query3) > 0) {
                            while ($row3 = mysqli_fetch_array($query3)) {
                                $bookmarkId = $row3[0];
                                $query4 = mysqli_query($conn, "SELECT * FROM bookmark WHERE id='$bookmarkId'");
                                if (mysqli_num_rows($query4) > 0) {
                                    $row4 = mysqli_fetch_array($query4);
                                    $link = $row4[2];
                                    $price = $row4[5];
                                    ?>
                                    <div class="row">
                                        <div class="col-4">
                                            <img src="<?php echo $link ?>">
                                        </div>
                                        <div class="col-8">
                                            <br>
                                            <br>
                                            <br>
                                            <br>
                                            <div>Pret produs: <?php echo $price ?> lei</div>
                                        </div>
                                    </div>
                                    <br>
                                    <?php
                                }
                            }
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<br>
<?php
} else {
    ?>
    <div class="center">
        <div class="nothingInCart">Nu sunt comenzi de livrat.
        </div>
    </div>
    <?php
}
} else {
}
?>
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
