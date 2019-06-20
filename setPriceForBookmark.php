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
        .successCheck {
            width: 30%;
            border: 1px solid lightgrey;
            border-radius: 15px;
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
                <a class="dropdown-item" href="adminHome.php">Pagina principala</a>
                <a class="dropdown-item" href="addProductsPage.php">Adauga produse</a>
                <a class="dropdown-item" href="updateDeleteProductsPage.php">Actualizeaza/sterge produse</a>
                <a class="dropdown-item" href="checkOrders.php.php">Verifica comenzi</a>
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
if (isset($_POST['approve'])) {
    $id = $_POST['bookmarkId'];
    ?>
    <form action="approveBookmark.php" method="post">
        <input type="hidden" name="bookmarkId" id="bookmarkId" value="<?php echo $id; ?>">
        <div class="successCheck">
            <div class=" text-center">
                <h5 class="modal-title">Adauga detalii pentru produs</h5>
                <br>
            </div>
            <div class="modal-body">
                <div class="input-group-prepend">
                                                <span class="input-group-text"><i
                                                            class="fas fa-money-bill-wave"></i></span>
                    <input type="text" class="form-control" id="price" name="price"
                           placeholder="Pret produs"
                           value="">
                </div>
                <br>
                <div class="text-center">
                    <button name="save-button" class="btn btn-success"
                            id="save-button">Trimite
                    </button>
                </div>
            </div>
        </div>
    </form>
    <?php
}
?>
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