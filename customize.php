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
    <title>Personalizare semn</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.7.0/css/all.css'
          integrity='sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ' crossorigin='anonymous'>
    <link rel="stylesheet" href="style.css">
    <script src="https://unpkg.com/konva@3.2.3/konva.min.js"></script>
    <style>
        #container {
            border: 1px solid black;
            height: 100%;
            margin: auto;
            width: 28.5%;
        }

        .button-settings {
            position: relative;
            overflow: hidden;
        }

        .button-settings input[type=color] {
            top: 0;
            right: 0;
            min-width: 100%;
            min-height: 100%;
            opacity: 0;
            cursor: pointer;
            position: absolute;
        }

        .color-picker {
            padding-left: 39%;
            padding-right: 4%;
        }

        img {
            width: 40px;
            height: 40px;
        }

        .image-upload > input {
            display: none;
        }

        img:hover {
            cursor: pointer;
        }

        #saveImage {
            padding-right: 180%;
            width: 200px;
        }

        .photo:hover {
            box-shadow: 0 0 30px rgb(64, 64, 64);
        }

        .choose-send {
            padding-left: 41.7%;
        }
    </style>
    <script>
        function drawFigure() {
            var width = window.innerWidth;
            var height = window.innerHeight;
            var stage = new Konva.Stage({
                container: 'container',
                width: width - 980,
                height: height + 395
            });
            var layer = new Konva.Layer();
            for (var i = 20; i < 360; i = i + 20) {
                for (var j = 20; j < 1000; j = j + 20) {
                    square = new Konva.Rect({
                        x: i,
                        y: j,
                        width: 20,
                        height: 20,
                        fill: 'white',
                        stroke: 'black',
                        strokeWidth: 2,
                    });
                    square.on('click', function () {
                        var color = this.fill() == 'white' ? document.getElementById('color').value : 'white';
                        this.fill(color);
                        layer.draw();
                    });
                    layer.add(square);
                }
            }
            stage.add(layer);
            document.getElementById('save').addEventListener(
                'click',
                function () {
                    var dataURL = stage.toDataURL();
                    var today = new Date();
                    var date = today.getFullYear() + '-' + (today.getMonth() + 1) + '-' + today.getDate();
                    var today = new Date();
                    var time = today.getHours() + "-" + today.getMinutes() + "-" + today.getSeconds();
                    download(dataURL, date + '.' + time + '.png');
                },
                false
            );
        }

        function download(url, name) {
            var link = document.createElement('a');
            link.download = name;
            link.href = url;

            var input = document.getElementById("idBookmark");

            input.setAttribute("value", name);

            document.body.appendChild(link);
            link.click();

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
?>
<div>
    <div class="color-picker d-inline">
    <span class="btn btn-primary button-settings" id="col"><i class="fas fa-palette"></i>  Alege culoare<input
                type="color"
                id="color"
                name="color"
                value="black"
                class="d-inline"></span>
    </div>
    <div class="d-inline save-button">
        <div id="buttons" class="d-inline">
            <input type="hidden" name="idBookmark" id="idBookmark" value="">
            <button class="btn btn-labeled btn-success" id="save" type="submit">
                <span class="btn-label"><i class="far fa-save"></i></span> Salveaza
            </button>
        </div>

    </div>
</div>
<br>
<div class="choose-send">
    <form action="insertBookmark.php" method="post" enctype="multipart/form-data">
        <input type="hidden" name="username" id="username" value="<?php echo $user ?>">
        <p class="image-upload d-inline"><label for='sourcePhoto' class="photo"> <img src='logoImage.png'> </label>
            <input type="file" name="sourcePhoto" id="sourcePhoto">
        </p> &nbsp;
        <div id="saveImage" class="d-inline">
            <button class="btn btn-labeled btn-success" type="submit" name="submit">
                <span class="btn-label"><i class="fas fa-images"></i></span> Incarca si trimite
            </button>
        </div>
    </form>
</div>
<br>
<div id="container" class="bookmark"></div>
<br>
<br>
<script>
    window.onload = drawFigure();
</script>
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