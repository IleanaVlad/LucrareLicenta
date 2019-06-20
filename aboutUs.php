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
    <title>Despre noi</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.7.0/css/all.css'
          integrity='sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ' crossorigin='anonymous'>
    <link rel="stylesheet" href="style.css">
    <style>
        .right-content {
            padding-left: 5%;
        }

        .bookmark {
            height: 300px;
            width: 100px;
            margin: 6px;
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
<br>
<div class="d-flex justify-content-center">
    <div class="col-md-11">
        <div class="row">
            <div class="col-5">
                <div class="text-center">
                    <div class="d-inline ">
                        <img class="bookmark" src="aboutUs/2019-6-18.20-10-4.png" alt="bookmark1">
                    </div>
                    <div class="d-inline">
                        <img class="bookmark" src="aboutUs/2019-6-18.23-1-58.png" alt="bookmark2">
                    </div>
                    <div class="d-inline">
                        <img class="bookmark" src="aboutUs/2019-6-18.23-17-34.png" alt="bookmark3">
                    </div>
                    <div class="d-inline">
                        <img class="bookmark" src="aboutUs/2019-6-18.23-27-12.png" alt="bookmark4">
                    </div>
                </div>
            </div>
            <div class="col-7 right-content">
                <div> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <strong>ARTSY HANDMADE</strong> este magazinul unde
                    semnele
                    de carte sunt confectionate manual, deci rezultatul are si un gram(sau mai multe) de suflet.
                    Sloganul
                    nostru este despre cei care cred ca magia este in fiecare dintre noi.
                </div>
                <br>
                <div> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Un cititor adevarat stie ca unul dintre cele mai
                    importante lucruri atunci cand citesti este, desigur,
                    semnul de carte. Si chiar daca o bucata de hartie sau orice alt obiect pare perfect in regula ca un
                    semn de carte, de ce sa nu fie unul unic, pe care nimeni altcineva nu il detine? Avand in vedere
                    imaginatia fara margini de care dau dovada cei mai multi cititori, magazinul nostru va ofera
                    posibilitatea
                    de a o pune in practica in crearea propriului semn de carte. Un cadou ca acesta ii poate face si pe
                    acei
                    prieteni care nu citesc niciodata sa cumpere cel putin o carte doar pentru a folosi semnul nostru de
                    carte.
                </div>
            </div>
        </div>
    </div>
</div>
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