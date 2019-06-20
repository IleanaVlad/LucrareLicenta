<?php
include('loginDB.php');

if (!isLoggedIn()) {
    header('location: login.php');
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Admin Home</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.7.0/css/all.css'
          integrity='sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ' crossorigin='anonymous'>
    <link rel="stylesheet" href="style.css">
    <style>
        .btn-file {
            position: relative;
            overflow: hidden;
        }

        .btn-file input[type=file] {
            position: absolute;
            top: 0;
            right: 0;
            min-width: 100%;
            min-height: 100%;
            font-size: 100px;
            text-align: right;
            filter: alpha(opacity=0);
            opacity: 0;
            outline: none;
            cursor: inherit;
            display: block;
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
                <a class="dropdown-item" href="updateDeleteProductsPage.php">Actualizeaza/sterge produse</a>
                <a class="dropdown-item" href="addProductsPage.php">Adauga produse</a>
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
<form method='post' action='addProduct.php' enctype="multipart/form-data">
    <div class="d-flex justify-content-center">
        <div class="col-md-6">
            <div class="text-dark">
                <div class="">
                    <ul class='list-group'>
                        <li class='list-group-item'><label for='nameProduct'>Denumire produs: </label><input type='text'
                                                                                                             name='nameProduct'
                                                                                                             value=''
                                                                                                             class='form-control'/>
                        </li>
                        <li class='list-group-item'><label for='priceProduct'>Pret: </label><input type='text'
                                                                                                   name='priceProduct'
                                                                                                   value=''
                                                                                                   class='form-control'/>
                        </li>
                        <li class='list-group-item'><label for='colorProduct'>Culoare: </label><input type='text'
                                                                                                      name='colorProduct'
                                                                                                      value=''
                                                                                                      class='form-control'/>
                        </li>
                        <li class='list-group-item'><label for='quantityProduct'>Cantitate:</label><input type='text'
                                                                                                          name='quantityProduct'
                                                                                                          value=''
                                                                                                          class='form-control'/>
                        </li>
                        <li class='list-group-item'><label for='descriptionProduct'>Descriere:</label><input type='text'
                                                                                                             name='descriptionProduct'
                                                                                                             value=''
                                                                                                             class='form-control'/>
                        </li>

                        <li class='list-group-item text-center'>
                        <span class="btn btn-primary btn-file"><i
                                    class="fas fa-file-image"></i>  Incarca fotografia <input type="file"
                                                                                              name="sourcePhoto"
                                                                                              id="sourcePhoto"></span>
                        </li>
                    </ul>
                </div>
            </div>
            <br>
            <div class="text-center">
                <button class="btn btn-labeled btn-success" name="submit" type="submit" id="sendButton">
                    <span class="btn-label"><i class="far fa-plus-square"></i></span> Adauga produs
                </button>
            </div>

        </div>
    </div>
</form>
<br>
<br>
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