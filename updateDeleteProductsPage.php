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
        img {
            height: 130px;
            width: 80px;
        }

        .container {
            width: 98%;
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
<?php
include('connection.php');
$query1 = mysqli_query($conn, "SELECT * FROM product");
if (mysqli_num_rows($query1) > 0) {
?>
<div class="container">
    <table class="table table-bordered text-center">
        <thead>
        <tr>
            <th>Produs</th>
            <th>Pret</th>
            <th>Culoare</th>
            <th>Cantitate</th>
            <th width="350px">Descriere</th>
            <th>Actualizeaza produs</th>
            <th>Sterge prpdus</th>
        </tr>
        </thead>
        <tbody>
        <?php
        while ($row1 = mysqli_fetch_array($query1)) {
            $id = $row1[0];
            $link = $row1[2];
            $price = $row1[3];
            $color = $row1[4];
            $quantity = $row1[5];
            $description = $row1[6];
            ?>
            <tr>
                <td><img src="<?php echo $link; ?>"></td>
                <td><?php echo $price; ?> lei</td>
                <td><?php echo $color; ?></td>
                <td><?php echo $quantity; ?> bucati</td>
                <td><?php echo $description; ?></td>
                <td>
                    <form action="updateProductPage.php" method="post">
                        <input type="hidden" name="id" id="id" value="<?php echo $id; ?>">
                        <button class="btn btn-labeled btn-success" id="updateProduct"
                                name="updateProduct">
                            <span class="btn-label"><i class="fas fa-cogs"></i></span> Actualizeaza
                        </button>
                    </form>
                </td>
                <td>
                    <form action="deleteProduct.php" method="post">
                        <input type="hidden" name="productId" id="productId" value="<?php echo $id; ?>">
                        <button class="btn btn-labeled btn-danger" id="deleteProduct"
                                name="deleteProduct">
                            <span class="btn-label"><i class="fas fa-trash"></i></span> Sterge
                        </button>
                    </form>
                </td>
            </tr>
            <?php
        }
        }
        ?>
        </tbody>
    </table>
</div>
<br>
<br>
<br>
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