<?php include('registerDB.php') ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Inregistrare</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.7.0/css/all.css'
          integrity='sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ' crossorigin='anonymous'>
    <link rel="stylesheet" href="style.css">
    <style>
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
        <i class="far fa-user-circle link-size"></i><a href="login.php"><span class="link-text">Conectare</span></a>
    </div>
</div>
<br>
<div class="navbar">
    <a href="about.html">Despre noi</a>
    <a href="index.php">Cumparaturi</a>
</div>
<br>
<div class="container">
    <div class="row justify-content-center h-100">
        <div class="col-4 my-auto">
            <div class="card card-body mb-2">
                <h2 class="text-center">Inregistrare</h2> <br>
                <form method="post" action="register.php">
                    <div class="text-center text-danger"><?php echo errors(); ?></div>
                    <div class="form-group">
                        <div class="input-group row justify-content-center">
                            <div class="input-group-prepend">
                                <span class="input-group-text"> <i class="fas fa-user"></i> </span>
                                <input type="text" class="form-control" name="username" placeholder="Nume de utilizator"
                                       value="<?php echo $username; ?>">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="input-group row justify-content-center">
                            <div class="input-group-prepend">
                                <span class="input-group-text"> <i class="fas fa-at"></i> </span>
                                <input type="email" name="email" class="form-control" placeholder="Email"
                                       value="<?php echo $email; ?>">
                            </div>

                        </div>
                    </div>

                    <div class="form-group">
                        <div class="input-group row justify-content-center">
                            <div class="input-group-prepend">
                                <span class="input-group-text"> <i class="fas fa-key"></i> </span>
                                <input type="password" class="form-control" name="password" placeholder="Parola">
                            </div>

                        </div>
                    </div>

                    <div class="form-group">
                        <div class="input-group row justify-content-center">
                            <div class="input-group-prepend">
                                <span class="input-group-text"> <i class="fas fa-key"></i> </span>
                                <input type="password" name="retypePassword" class="form-control"
                                       placeholder="Reintroduceti parola">

                            </div>

                        </div>
                    </div>


                    <div class="row justify-content-center">
                        <button type="submit" name="registerButton" class="btn btn-success">
                            Inregistrare
                        </button>

                    </div>
                    <div class="text-center">
                        Daca este deja inregistrat, <strong><a href="login.php">logheaza-te</a></strong>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
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
