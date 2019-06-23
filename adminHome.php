<?php
include('loginDB.php');
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
            text-align: center;
            margin-top: 10%;
        }
    </style>
    <script>
        function addProducts() {
            location.replace("http://localhost:63342/OnlineShop/addProductsPage.php")
        }

        function updateDeleteProducts() {
            location.replace("http://localhost:63342/OnlineShop/updateDeleteProductsPage.php")
        }

        function checkBookmarks() {
            location.replace("http://localhost:63342/OnlineShop/checkBookmarks.php")
        }

        function checkOrders() {
            location.replace("http://localhost:63342/OnlineShop/checkOrders.php")
        }
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
            </div>
        </span>
        <i class="fas fa-sign-out-alt"></i><a href="clientHome.php?logout"><span
                    class="link-text">Deconectare</span></a>
    </div>
</div>
<br>
<br>
<div class="content">
    <button type="button" class="btn btn-outline-success" onclick="addProducts()">Adauga produse</button>
    <button type="button" class="btn btn-outline-success" onclick="updateDeleteProducts()">Gestioneaza produsele
        adaugate
    </button>
    <button type="button" class="btn btn-outline-success" onclick="checkOrders()">Verifica comenzi</button>
    <button type="button" class="btn btn-outline-success" onclick="checkBookmarks()">Produse personalizate</button>
</div>
<br>
<br>
<br>
<br>
<br>
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