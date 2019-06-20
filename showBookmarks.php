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
    <title>Semne personalizate</title>
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
            margin-top: 11%;
        }

        .nothingInCart {
            font-size: 200%;
        }

        select {
            display: none;
        }

        img {
            width: 200px;
            height: 500px;
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
$username = $_SESSION['user']['username'];
$query1 = mysqli_query($conn, "SELECT id FROM users WHERE username='$username'");
if (mysqli_num_rows($query1) > 0) {
    $row1 = mysqli_fetch_array($query1);
    $userId = $row1[0];
    $query2 = mysqli_query($conn, "SELECT * FROM bookmark WHERE id_user = '$userId' AND ordered=0");
    if (mysqli_num_rows($query2) > 0) {
        while ($row2 = mysqli_fetch_array($query2)) {
            $id = $row2[0];
            $link = $row2[2];
            $date = $row2[3];
            $evaluationDate = $row2[4];
            $price = $row2[5];
            $checked = $row2[6];
            ?>

            <div class="d-flex justify-content-center">
                <div class="col-md-8">
                    <div class="list-group-item flex-column align-items-start">
                        <?php
                        if ($checked == 1) {
                            ?>
                            <div class="container">
                                <div class="row">
                                    <div class="col-4">
                                        <img src="<?php echo $link ?>">
                                    </div>
                                    <div class="col-8">
                                        <div>
                                            <br>
                                            <br>
                                            <br>
                                            <h5>
                                                <strong>Produsul a fost acceptat pentru a fi comandat.</strong>
                                            </h5>
                                            <div>Data personalizarii produsului: <?php echo $date ?></div>
                                            <div>Data acceptarii pentru comandare: <?php echo $evaluationDate ?></div>
                                            <br>
                                            <div>
                                                <h4><strong>Pret:</strong></h4>
                                                <h3><?php echo $price ?> lei</h3>
                                            </div>
                                        </div>
                                        <br>
                                        <div class="row">
                                            <div class="col">
                                                <form action="orderBookmark.php" method="post">
                                                    <input type="hidden" name="bookmarkId" value="<?php echo $id ?>">
                                                    <input type="hidden" name="link"
                                                           value="<?php echo $link ?>">
                                                    <button class="btn btn-labeled btn-success">
                                                        <span class="btn-label"><i
                                                                    class="fa fa-shopping-cart"></i></span>
                                                        Comanda produs
                                                    </button>
                                                </form>
                                            </div>
                                            <div class="col">
                                                <form action="deleteBookmark.php" method="post">
                                                    <input type="hidden" name="deleteBookmark"
                                                           value="<?php echo $id ?>">
                                                    <button class="btn btn-labeled btn-danger">
                                                        <span class="btn-label"><i class="fas fa-trash"></i></span>
                                                        Sterge
                                                        produsul
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <?php
                        } else {
                            ?>
                            <div class="container">
                                <div class="row">
                                    <div class="col-4">
                                        <img src="<?php echo $link ?>">
                                    </div>
                                    <div class="col-8">
                                        <div>
                                            <br>
                                            <br>
                                            <br>
                                            <br>
                                            <br>
                                            <h5>
                                                <strong>Produs in asteptare.</strong>
                                            </h5>
                                            <div>Data personalizarii produsului: <?php echo $date ?></div>
                                        </div>
                                        <br>

                                        <div class="row">
                                            <div class="col">
                                                <form action="orderBookmark.php" method="post">
                                                    <input type="hidden" name="bookmarkId" value="<?php echo $id ?>">
                                                    <button class="btn btn-labeled btn-success" disabled>
                                                        <span class="btn-label"><i
                                                                    class="fa fa-shopping-cart"></i></span>
                                                        Comanda produs
                                                    </button>
                                                </form>
                                            </div>
                                            <div class="col">
                                                <form action="deleteBookmark.php" method="post">
                                                    <input type="hidden" name="deleteBookmark"
                                                           value="<?php echo $id ?>">
                                                    <button class="btn btn-labeled btn-danger">
                                                        <span class="btn-label"><i class="fas fa-trash"></i></span>
                                                        Sterge
                                                        produsul
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php
                        }
                        ?>
                    </div>
                </div>
            </div>
            <br>
            <?php
        }
    } else {
        ?>
        <div class="center">
            <div class="nothingInCart">Nu ai personalizat nimic.
            </div>
            <br>
            <form action="customize.php">
                <button class="btn btn-success">Personalizeaza semn</button>
            </form>
        </div>
        <?php
    }
}
?>
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