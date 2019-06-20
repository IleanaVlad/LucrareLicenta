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
        .center {
            text-align: center;
            margin-top: 10%;
        }

        .nothingInCart {
            font-size: 200%;
        }

        .content {
            width: 100%;

        }
        .row {
            margin-right: 0px;
        }
        .order-delivered {
            color: #ff5722!important;
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
$username = $_SESSION['user']['username'];
$nr1 = 0;
$nr2 = 0;
$query1 = mysqli_query($conn, "SELECT * FROM users WHERE username='$username'");
if (mysqli_num_rows($query1) > 0) {
$row1 = mysqli_fetch_array($query1);
$userId = $row1[0];
?>
<div class="content">
    <div class="row">
        <?php
        $query2 = mysqli_query($conn, "SELECT DISTINCT id_deliveries FROM order_deliveries ORDER BY id_deliveries DESC");
        if (mysqli_num_rows($query2) > 0) {
        ?>
        <div class="col-6">
            <?php
            while ($row2 = mysqli_fetch_array($query2)) {
                $deliveriesId = $row2[0];
                $query3 = mysqli_query($conn, "SELECT sum, date, delivered FROM deliveries WHERE id='$deliveriesId' AND id_user='$userId'");
                if (mysqli_num_rows($query3) > 0) {
                    $nr1 = mysqli_num_rows($query3);
                    $row3 = mysqli_fetch_array($query3);
                    $sum = $row3[0];
                    $date = $row3[1];
                    $delivered = $row3[2];
                    ?>
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
                                    <?php
                                    if($delivered == 1) {
                                        ?>
                                        <div><h6 class="order-delivered">Comanda livrata</h6></div>
                                        <?php
                                    } else {
                                        ?>
                                        <div><h6 class="order-delivered">In curs de livrare</h6></div>
                                        <?php
                                    }
                                        ?>
                                    <br>
                                    <br>
                                </div>
                                <div class="col-6">
                                    <br>
                                    <div class="float-right">
                                        <form action="showHistoryOrder.php" method="post">
                                            <input type="hidden" name="deliveriesId"
                                                   value="<?php echo $deliveriesId ?>">
                                            <input type="hidden" name="date" value="<?php echo $date ?>">
                                            <input type="hidden" name="sum" value="<?php echo $sum ?>">
                                            <button class="btn btn-labeled btn-success">
                                                            <span class="btn-label"><i
                                                                        class="fas fa-info-square"></i></span>
                                                Detalii comanda
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <br><?php
                }
            }
            }
            }
            ?>
        </div>

            <?php
            $query4 = mysqli_query($conn, "SELECT * FROM bookmark_order ORDER BY id DESC");
            if (mysqli_num_rows($query4) > 0) {
                ?>
        <div class="col-6">
            <?php
            while ($row4 = mysqli_fetch_array($query4)) {
                    $id = $row4[0];
                    $idDeliveries = $row4[2];
                    $query5 = mysqli_query($conn, "SELECT sum, date, delivered FROM deliveries WHERE id='$idDeliveries' AND id_user=$userId");
                    if (mysqli_num_rows($query5) > 0) {
                        $nr5 = mysqli_num_rows($query5);
                        $row5 = mysqli_fetch_array($query5);
                        $sum1 = $row5[0];
                        $date1 = $row5[1];
                        $del = $row5[2];
                        ?>
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
                                        <?php
                                        if($del == 1) {
                                            ?>
                                            <div><h6 class="order-delivered">Comanda livrata</h6></div>
                                            <?php
                                        } else {
                                            ?>
                                            <div><h6 class="order-delivered">In curs de livrare</h6></div>
                                            <?php
                                        }
                                        ?>
                                        <br>
                                        <br>
                                    </div>
                                    <div class="col-6">
                                        <br>
                                        <div class="float-right">
                                            <form action="showHistoryBookmark.php" method="post">
                                                <input type="hidden" name="idDeliveries"
                                                       value="<?php echo $idDeliveries ?>">
                                                <input type="hidden" name="dateBookmark" value="<?php echo $date1 ?>">
                                                <input type="hidden" name="sumBookmark" value="<?php echo $sum1 ?>">
                                                <input type="hidden" name="idBookmark" value="<?php echo $id ?>">
                                                <button class="btn btn-labeled btn-success">
                                                            <span class="btn-label"><i
                                                                        class="fas fa-info-square"></i></span>
                                                    Detalii comanda
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
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
<?php
if ($nr1 == 0 &&  $nr2== 0) {
?>
    <div class="center">
        <div class="nothingInCart">Nu au fost comandate produse.
        </div>
        <br>
        <br>
        <br>
        <br>
        <br>
    </div>
    <?php
}
?>
<br>
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