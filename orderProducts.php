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
    <title>Comanda produse</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.7.0/css/all.css'
          integrity='sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ' crossorigin='anonymous'>
    <link rel="stylesheet" href="style.css">
    <style>
        .content {
            align-items: center;
            max-width: 50%;
            margin: auto;
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
$name = $_POST['username'];
$sum = $_POST['allSum'];
$query1 = mysqli_query($conn, "SELECT * FROM users WHERE username= '" . $name . "'");
if (mysqli_num_rows($query1) > 0) {
    $row1 = mysqli_fetch_array($query1);
    $userId = $row1[0];
    $firstName = $row1[1];
    $lastName = $row1[2];
    $email = $row1[4];
    $city = $row1[5];
    $address = $row1[6];
    $phone = $row1[7];
    ?>
    <div class="content">
        <form method='post' action='sendProducts.php'>
            <div class='justify-content-center'>
                <input type='hidden' name='username' value='<?php echo $name ?>'>
                <ul class='list-group'>
                    <li class='list-group-item text-center'>
                        <h3>Completeaza detalii comanda</h3>
                    </li>
                    <li class='list-group-item'><label for='firstName'>Prenume: </label><input type='text'
                                                                                               id='firstName'
                                                                                               name='firstName'
                                                                                               value='<?php echo $firstName ?>'
                                                                                               class='form-control'/>
                    </li>
                    <li class='list-group-item'><label for='lastName'>Nume: </label><input type='text' id='lastName'
                                                                                           name='lastName'
                                                                                           value='<?php echo $lastName ?>'
                                                                                           class='form-control'/>
                    </li>
                    <li class='list-group-item'><label for='email'>Email: </label><input type='text' id='email'
                                                                                         name='email'
                                                                                         value='<?php echo $email ?>'
                                                                                         class='form-control'/></li>
                    <li class='list-group-item'><label for='city'>Oras:</label><input type='text' id='city'
                                                                                      name='city'
                                                                                      value='<?php echo $city ?>'
                                                                                      class='form-control'/></li>
                    <li class='list-group-item'><label for='address'>Adresa:</label><input type='text' id='address'
                                                                                           name='address'
                                                                                           value='<?php echo $address ?>'
                                                                                           class='form-control'/>
                    </li>
                    <li class='list-group-item'><label for=\"phone\">Numar de telefon:</label><input type='text'
                                                                                                     id='phone'
                                                                                                     name='phone'
                                                                                                     value='<?php echo $phone ?>'
                                                                                                     class='form-control'/>
                    </li>
                </ul>
            </div>
            <br>
            <div class="content">
                <div class=' text-center'>
                    <h3>Total: <?php echo $sum ?> lei</h3>
                    <input type='hidden' id='sum' name='sum' value='<?php echo $sum ?>'/><br>
                    <button class="btn btn-labeled btn-success">
                        <span class="btn-label\"><i class="fas fa-gift"></i></span> Comanda produse
                    </button>
                </div>
            </div>

        </form>
    </div>
    </div><br><br>
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