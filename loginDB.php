<?php
session_start();
$username = "";
$email = "";
$errors = array();

if (isset($_POST['loginButton'])) {
    include('connection.php');
    $username = $_POST['username'];
    $username = trim($username);
    $username = mysqli_real_escape_string($conn, $username);

    $password = $_POST['password'];
    $password = trim($password);
    $password = mysqli_real_escape_string($conn, $password);
    $pass = md5($password);
    if (empty($username)) {
        array_push($errors, "Trebuie sa introduceti nume de utilizator");
    }

    if (empty($password)) {
        array_push($errors, "Trebuie sa introduceti parola");
    }

    if (count($errors) == 0) {
        $query = mysqli_query($conn,"SELECT * FROM users WHERE username ='$username' AND password = '$pass'");
        $row = mysqli_num_rows($query);
        if ($row == 1) {
            $user = mysqli_fetch_assoc($query);
            if ($user['user_type'] == 'admin') {
                $_SESSION['user'] = $user;
                header('Location: adminHome.php');
            } else {

                $_SESSION['user'] = $user;
                header('Location: clientHome.php');
            }
        } else {
            array_push($errors, "Nume de utilizator sau parola gresita");

        }
    }
}

function errors()
{
    global $errors;
    if (count($errors) > 0) {
        echo '<div class="error">';
        foreach ($errors as $error) {
            echo $error . '<br>';
        }
        echo '</div>';
    }
}

function isLoggedIn()
{
    if (isset($_SESSION['user'])) {
        return true;
    } else {
        return false;
    }
}

if (isset($_GET['logout'])) {
    session_destroy();
    unset($_SESSION['user']);
    header("Location: index.php");
    include("index.php");
}

