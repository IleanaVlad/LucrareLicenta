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
    <title>Lista dorinte</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.7.0/css/all.css'
          integrity='sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ' crossorigin='anonymous'>
    <link rel="stylesheet" href="style.css">
    <style>
        .nothing {
            color: red;
        }

        .center {
            text-align: center;
            margin-top: 13%;
        }

        .nothingInCart {
            font-size: 200%;
        }

        .not-available {
            padding-left: 4px;
            padding-right: 4px;
            color: white;
            background-color: red;
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
<?php include('connection.php');
$user = $_SESSION['user']['username'];
$query1 = mysqli_query($conn, "SELECT id FROM users WHERE username='" . $user . "'");
if (mysqli_num_rows($query1) > 0) {
    $row1 = mysqli_fetch_array($query1);
    $userId = $row1[0];
}
$sum = 0;
$allSum = 0;
$query3 = mysqli_query($conn, "SELECT * FROM wish_list WHERE id_user='" . $userId . "'");
if (mysqli_num_rows($query3) > 0) {
    while ($row3 = mysqli_fetch_array($query3)) {
        $productId = $row3[2];
        $query4 = mysqli_query($conn, "SELECT * FROM product WHERE id='" . $productId . "'");
        if (mysqli_num_rows($query4) > 0) {
            $row4 = mysqli_fetch_array($query4);
            $quantity = $row4[5];
            $description = $row4[6];
            if ($quantity == 0) {
                ?>
                <div>
                    <div class="d-flex justify-content-center">
                        <div class="col-md-9">
                            <div class="list-group-item flex-column align-items-start">
                                <form action='deleteProductFromWishList.php' name="<?php echo $row3[0]; ?>"
                                      method="POST">
                                    <input type="hidden" name="name" value="<?php echo $row3[0]; ?>">
                                    <div class="container">
                                        <div class="row">
                                            <div class="col-4">
                                                <p><?php echo '<img src="' . $row4[2] . '" width="100" height="150" ">' ?></p>
                                            </div>
                                            <div class="col-8">

                                                <div class="nothing">
                                                    <div><span class="rounded not-available"> Stoc epuizat </span></div>
                                                </div>
                                                <div>
                                                    <h5><strong>Descriere produs:</strong> <?php echo $description ?>
                                                    </h5>
                                                </div>
                                                <br>
                                                <div class="row">
                                                    <div class="col">
                                                        <h4>Pret:</h4>
                                                        <p><?php echo($row4[3]) ?>lei</p>
                                                    </div>
                                                    <div class="col">
                                                        <button class="btn btn-labeled btn-danger">
                                                            <span class="btn-label"><i class="fas fa-trash"></i></span>
                                                            Sterge din favorite
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <br>
                <?php
            } else {
                ?>
                <div>
                    <div class="d-flex justify-content-center">
                        <div class="col-md-9">
                            <div class="list-group-item flex-column align-items-start">
                                <form action='deleteProductFromWishList.php' name="<?php echo $row3[0]; ?>"
                                      method="POST">
                                    <input type="hidden" name="name" value="<?php echo $row3[0]; ?>">
                                    <div class="container">
                                        <div class="row">
                                            <div class="col-4">
                                                <p><?php echo '<img src="' . $row4[2] . '" width="100" height="150" ">' ?></p>
                                            </div>
                                            <div class="col-8">
                                                <div>
                                                    <h5><strong>Descriere produs:</strong> <?php echo $description ?>
                                                    </h5>
                                                </div>
                                                <br>
                                                <br>
                                                <div class="row">
                                                    <div class="col">

                                                        <h4>Pret:</h4>
                                                        <p><?php echo($row4[3]) ?>lei</p>
                                                    </div>
                                                    <div class="col">
                                                        <button class="btn btn-labeled btn-danger">
                                                            <span class="btn-label"><i class="fas fa-trash"></i></span>
                                                            Sterge din favorite
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <br>
                <?php
            }
        }
    }
} else {
    ?>
    <div class="center">
        <div class="nothingInCart">Nu sunt produse adaugate.
        </div>
        <br>
        <form action="clientHome.php">
            <button class="btn btn-success">Intoarce-te in magazin</button>
        </form>
<br>
<br>
<br>
<br>
<br>
    </div>
    <?php
}
?>
</div>
<div id="snackbar"></div>
<br>
<br>
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