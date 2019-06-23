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
    <title>Cos cumparaturi</title>
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

        .status {
            display: none;
        }
    </style>
    <script>
        function update(id) {
            $('select.quantityProd' + id).on('change', function () {
                var decision = $(this).val();
                $.ajax({
                    type: "POST",
                    url: "updateQuantityProduct.php",
                    data: {decision: decision, id: id},
                    success: function (msg) {
                        $('#autosavenotify').text(msg);
                    }
                })
            });
        }

        function changePrice(idOrder) {
            document.getElementById(idOrder).innerHTML = "";
            var options = document.getElementById("quantityProd" + idOrder).options;
            var index = document.getElementById("quantityProd" + idOrder).selectedIndex;
            var oldPrice = document.getElementById("oldPrice" + idOrder).value;
            var productPrice = document.getElementById("oldPrice" + idOrder).name;

            var p = document.getElementById(idOrder);
            var quantity = options[index].text;
            var newPrice = productPrice * quantity;

            var pr = document.createTextNode(newPrice);
            p.appendChild(pr);
            var l = document.createTextNode(" lei");
            p.appendChild(l);


            var oldSum = document.getElementsByClassName("total-payment float-right")[0].id;

            var div = document.getElementById(oldSum);
            document.getElementById(oldSum).innerHTML = "";
            oldSum = oldSum - oldPrice;
            var newSum = oldSum + newPrice;
            div.setAttribute("id", newSum);
            var a = document.getElementById("oldPrice" + idOrder);
            a.setAttribute("value", newPrice);
            var all = document.createTextNode("Total: ");
            div.appendChild(all);
            var ns = document.createTextNode(newSum);
            div.appendChild(ns);
            var l1 = document.createTextNode(" lei");
            div.appendChild(l1);

            var input = document.getElementById("allSum");
            input.setAttribute("value", newSum);

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
$user = $_SESSION['user']['username'];

$query1 = mysqli_query($conn, "SELECT id FROM users WHERE username='" . $user . "'");
if (mysqli_num_rows($query1) > 0) {
    $row1 = mysqli_fetch_array($query1);
    $userId = $row1[0];
}
$sum = 0;
$allSum = 0;
$query3 = mysqli_query($conn, "SELECT * FROM product_order WHERE id_user='" . $userId . "' AND ordered=0");
if (mysqli_num_rows($query3) > 0) {
    while ($row3 = mysqli_fetch_array($query3)) {
        $productId = $row3[1];
        $quantity = $row3[4];
        $query4 = mysqli_query($conn, "SELECT * FROM product WHERE id='" . $productId . "'");
        $row4 = mysqli_fetch_array($query4);
        $allQuantity = $row4[5];
        $all = $allQuantity + $quantity;
        $price = $row4[3];
        $description = $row4[6];
        $sumPerProduct = $price * $quantity;
        ?>

        <div class="d-flex justify-content-center">
            <div class="col-md-9">
                <div class="list-group-item flex-column align-items-start">
                    <form action='deleteProductFromShopping.php' name="<?php echo $row3[0]; ?>" method="POST">
                        <input type="hidden" name="name" id="idProduct" value="<?php echo $row3[0]; ?>">
                        <div class="container">
                            <div class="row">
                                <div class="col-4">
                                    <p> <?php echo '<img src="' . $row4[2] . '" width="100" height="150" ">' ?></p>
                                </div>
                                <div class="col-8">
                                    <div>
                                        <h5><strong>Descriere produs:</strong> <?php echo $description ?></h5>
                                    </div>
                                    <br>
                                    <br>
                                    <div class="row">
                                        <div class="col-1">
                                            <div id="autosavenotify"></div>
                                            <div class="status"
                                                 id="quantity<?php echo $row3[0]; ?>"> <?php echo $row3[0]; ?> </div>
                                            <select class="quantityProd<?php echo $row3[0]; ?>" name="quantityProd"
                                                    id="quantityProd<?php echo $row3[0]; ?>"
                                                    onclick="changePrice(<?php echo $row3[0]; ?>);update(<?php echo $row3[0]; ?>)">
                                                <option> <?php echo $quantity; ?> </option>
                                                <?php
                                                $i = 1;
                                                while (($i <= $all)) {
                                                    if ($i != $quantity) {
                                                        echo "<option>  $i </option>";

                                                    }
                                                    $i = $i + 1;
                                                }
                                                ?>
                                            </select>

                                        </div>
                                        <div class="col-1">bucati,</div>

                                        <div class="col-2">
                                            <input type="hidden" id="oldPrice<?php echo $row3[0]; ?>"
                                                   value="<?php echo $row4[3] * $quantity; ?>"
                                                   name="<?php echo $row4[3]; ?>">
                                            <p id="<?php echo $row3[0]; ?>"><?php echo($row4[3] * $quantity) ?>
                                                    lei</p>
                                        </div>

                                        <div class="col">
                                            <button class="btn btn-labeled btn-danger">
                                                <span class="btn-label"><i class="fas fa-trash"></i></span> Sterge
                                                din cos
                                            </button>
                                        </div>
                    </form>
                    <form action="addToFavorite.php" method="post">
                        <input type="hidden" name="name" value="<?php echo $row3[0]; ?>">
                        <div class="col">
                            <button class="btn btn-labeled btn-primary">
                                <span class="btn-label"><i class='far fa-heart'></i></span> Muta in
                                favorite
                            </button>
                        </div>
                    </form>


                </div>
            </div>
        </div>
        </div>

        </div>
        </div>
        </div>

        <br>


        <?php $allSum = $allSum + $sumPerProduct;
    }
} else {
?>
<div class="center">
    <div class="nothingInCart">Cosul tau este gol.
    </div>
    <br>
    <?php

    }
    ?>
    <?php if ($allSum == 0) {
    ?>
    <form action="clientHome.php">
        <button class="btn btn-success">Intoarce-te in magazin</button>
    </form>
<br>
<br>
<br>
<br>
<br>
</div>
<?php } else {
?>
<div class=" justify-content-center">
    <div class="col-md-9">

        <h3 class="total-payment float-right disabled" id="<?php echo $allSum ?>">Total: <?php echo($allSum) ?>lei
        </h3>

        <br>
        <br>
        <br>
        <form action="orderProducts.php" method="POST">
            <input type="hidden" name="username" value="<?php echo $user; ?>">
            <input type="hidden" name="allSum" id="allSum" value="<?php echo $allSum; ?>">
            <button class="btn btn-labeled btn-success float-right" type="submit" name="submit" id="sendButton">
                <span class="btn-label"><i class="fas fa-gift"></i></span> Pasul urmator
            </button>
            <?php }
            ?>
        </form>
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
<div id="snackbar"></div>
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

