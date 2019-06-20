<?php
session_start();
$username = "";
$email = "";
$errors = array();

if (isset($_POST['registerButton'])) {
    include('connection.php');
    $username = $_POST['username'];
    $username = trim($username);
    $username = mysqli_real_escape_string($conn, $username);

    $email = $_POST['email'];
    $email = trim($email);
    $email = mysqli_real_escape_string($conn, $email);

    $password = $_POST['password'];
    $password = trim($password);
    $password = mysqli_real_escape_string($conn, $password);

    $retypePassword = $_POST['retypePassword'];
    $retypePassword = trim($retypePassword);
    $retypePassword = mysqli_real_escape_string($conn, $retypePassword);

    if (empty($username)) {
        array_push($errors, "Trebuie sa introduceti nume de utilizator");
    }
    if (empty($email)) {
        array_push($errors, "Trebuie sa introduceti email");
    }
    if (empty($password)) {
        array_push($errors, "Trebuie sa introduceti parola");
    }
    if (empty($retypePassword)) {
        array_push($errors, "Trebuie sa reintroduceti parola");
    }

    if (count($errors) == 0) {
        $query1 = mysqli_query($conn,"SELECT * FROM users WHERE username ='$username'");
        $row = mysqli_num_rows($query1);
        if ($row == 0) {
            if ($password != $retypePassword) {
                array_push($errors, "Completati corect reintroducerea parolei");
            } else {
                $password = md5($retypePassword);
                $query2 = mysqli_query($conn,"INSERT INTO users (username, email, user_type, password) 
					  VALUES('$username', '$email', 'user', '$password')");
                $logged_in_user_id = mysqli_insert_id($conn);
                header('Location: login.php');
            }
        } else {
            array_push($errors, "Acest nume de utilizator exista deja");
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
