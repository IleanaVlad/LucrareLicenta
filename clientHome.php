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
    <title>Pagina principala</title>
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
            margin-top: 5%;
        }

        .nothingInCart {
            font-size: 200%;
        }
    </style>
    <script>
        function showAllProducts() {
            $.ajax({
                type: 'GET',
                url: 'getAllProducts.php',
                success: function (result) {
                    var result = JSON.parse(result);
                    solve(result);
                }
            });
        }

        function show(parameter) {
            $.ajax({
                type: 'GET',
                url: 'products.php',
                data: {parameter: parameter},
                success: function (result) {
                    $("#" + parameter).html(result);
                }
            });
        }

        function filter() {
            var price = $("#price").val();
            var color = $("#color").val();

            $.ajax({
                type: 'GET',
                url: 'filterProducts.php',
                data: {price: price, color: color},
                success: function (result) {
                    var result = JSON.parse(result);
                    solve(result);
                }
            });
        }

        function solve(result) {
            if(result=='no'){
                document.getElementById("show-items").innerHTML = '';
                document.getElementById("nothing").innerHTML = '';
                var div1 = document.getElementById("nothing");
                var val = document.createTextNode("Nu exista produse cu aceste filtrari.");
                div1.appendChild(val);
            }
            else{
                document.getElementById("nothing").innerHTML = '';
                document.getElementById("show-items").innerHTML = "";
                populateWithProducts(result);}
        }
        function populateWithProducts(result) {
            for (line in result) {
                div = document.getElementById("show-items");
                appendProducts(div, result[line]);
            }
        }
        function appendProducts(table, data) {
            var div1 = document.createElement("div");
            div1.classList.add("col-sm");
            div1.classList.add("products");
            var div2 = document.createElement("div");
            div2.classList.add("thumbnail");
            div1.appendChild(div2);
            var form = document.createElement("form");
            form.setAttribute("id", "add");
            form.setAttribute("action", "productDetails.php");
            form.setAttribute("method", "post");
            div2.appendChild(form);
            var div31 = document.createElement("div");
            div31.classList.add("text-center");
            form.appendChild(div31);

            var img = document.createElement("img");
            img.setAttribute("src", data['link']);
            img.setAttribute("alt", "Product");
            img.classList.add("img-prod");
            img.classList.add("rounded");
            div31.appendChild(img);

            var div32 = document.createElement("div");
            div32.classList.add("text-center");
            div32.classList.add("caption");
            form.appendChild(div32);

            var p = document.createElement("p");
            p.setAttribute("style", "font-size:1.5vw");
            div32.appendChild(p);

            var price = document.createTextNode(data['price']);
            var l = document.createTextNode(" lei");
            p.appendChild(price);
            p.appendChild(l);

            var input = document.createElement("input");
            input.setAttribute("type", "hidden");
            input.setAttribute("name", "productId");
            input.setAttribute("value", data['id']);

            form.appendChild(input);

            var div33 = document.createElement("div");
            div33.classList.add("text-center");
            form.appendChild(div33);
            var button = document.createElement("button");
            button.setAttribute("type", "submit");
            button.setAttribute("name", "submit");
            button.classList.add("btn");
            button.classList.add("btn-success");

            var val = document.createTextNode("Vezi detalii");
            button.appendChild(val);

            div33.appendChild(button);


            var element = document.getElementById("show-items");
            element.appendChild(div1);
        }
    </script>
</head>
<body onload="showAllProducts(),show('id'),show('name'),show('link'),show('price'),show('color')">
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
<div class=" d-flex justify-content-center">
    <div class="col-md-9">
        <div class="flex-column align-items-start">
            <h1>Semne de carte cusute manual</h1>
            <br>
            <h4>Filtreaza produsele dupa:</h4>
            <div>
                <span>Pret:</span>
                <select name="price" id="price" onchange="filter()">
                </select>&nbsp;&nbsp;
                <span>Culoare:</span>
                <select name="color" id="color" onchange="filter()">
                </select>
            </div>
            <div>
                <div class="row" id="show-items">

                </div>
                <div class="center">
                    <div class="nothingInCart" id="nothing">
                    </div>
                    <br>
                    <br>
                    <br>
                </div>
            </div>
        </div>
    </div>
</div>
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
