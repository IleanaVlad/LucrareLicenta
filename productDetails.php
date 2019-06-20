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
    <title>Detalii produs</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.7.0/css/all.css'
          integrity='sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ' crossorigin='anonymous'>
    <link rel="stylesheet" href="style.css">
    <style>
        .price-text {
            font-size: 180%;
        }

        .available {
            padding-left: 4px;
            padding-right: 4px;
            color: white;
            background-color: green;
        }

        .not-available {
            padding-left: 4px;
            padding-right: 4px;
            color: white;
            background-color: red;
        }

        .col-sm-8 {
            border-right: 2px dotted lightgrey;
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
                <a class="dropdown-item" href="customize.php">Personalizeaza semn</a>
                <a class="dropdown-item" href="showBookmarks.php">Semne personalizate</a>
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
</div>
<div class="row">
    <div class="main col-sm-12">
        <?php
        include "connection.php";
        if (isset($_POST["submit"])) {
            $productId = $_POST['productId'];
            $user = $_SESSION['user']['username'];
            $sql = "SELECT id, link, price, color, quantity, description FROM product WHERE id = $productId";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $id = $row['id'];
                $link = $row['link'];
                $price = $row['price'];
                $color = $row['color'];
                $quantity = $row['quantity'];
                $description = $row['description'];
                ?>
                <br>

                <h2> &nbsp;&nbsp;&nbsp;&nbsp;<?php echo $description ?></h2>
                <br>
                <div class="container">
                    <div class="row">
                        <div class="col-sm-8 text-center">
                            <a href='<?php echo $link ?>' target='_blank'>
                                <img src=' <?php echo $link ?>' alt='Semn-de-carte' class='img-prod'
                                     style='height:500px;width:315px'>

                            </a>
                        </div>
                        <div class="col-sm-4">
                            <div>

                            </div>
                            <?php if ($quantity != 0) { ?>
                                <div><span class="rounded available"> In stoc </span></div>
                            <?php } else {
                                ?>
                                <div><span class="rounded not-available"> Stoc epuizat </span></div>
                                <?php
                            } ?>
                            <p class="price-text"> Pret: <?php echo $price ?> lei</p>
                            <br>
                            <br>
                            <form action='addToCart.php' method='post'>
                                <div class=''>
                                    <?php if ($quantity != 0) { ?>
                                        <button class='btn btn-labeled btn-success' type='submit'>
                                            <span class='btn-label'><i class='fa fa-shopping-cart'></i></span> Adauga in
                                            cos
                                        </button>
                                        <?php
                                    } else {
                                        ?>
                                        <button class='btn btn-labeled btn-success' type='submit' disabled>
                                            <span class='btn-label'><i class='fa fa-shopping-cart'></i></span> Adauga in
                                            cos
                                        </button>
                                        <?php
                                    } ?>
                                </div>

                                <input type='hidden' name='productId' value='<?php echo $id ?>'>
                                <input type='hidden' name='username' value='<?php echo $user; ?>'>
                            </form>
                            <br>
                            <form action='addToFavorite.php' method='post'>
                                <input type='hidden' name='product' value='<?php echo $productId; ?>'>
                                <input type='hidden' name='username' value='<?php echo $user; ?>'>
                                <button class='btn btn-labeled btn-primary'>
                                    <span class='btn-label'><i class='far fa-heart'></i></span> Adauga la favorite
                                </button>

                            </form>
                        </div>
                    </div>
                </div>
            <?php }
        } ?>
    </div>
</div>
<div id="snackbar"></div>
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