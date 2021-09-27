<?php
function register($todos)
{
    if (empty($_POST['username'])) {
        $errors['username'] = "Username is required <br>";
    }

    if (empty($_POST['password'])) {
        $errors['password'] = "Password is required <br>";
    }

    if (empty($_POST['password_verify'])) {
        $errors['password_verify'] = "Password verify is required <br>";
    }

    if (empty($errors)) {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $passwordVerified = $_POST['password_verify'];

        if (isset($todos[$username])){
            $_SESSION['errors']['username_exist'] = "This username is already taken";
        }

        if ($password !== $passwordVerified) {
            $_SESSION['errors']['no_same_password'] = "Password are not the same";
            
        }

        if (!empty($_SESSION['errors'])) header("Location: register.php");

        $todos[$username]['password'] = $password;
        $todos[$username]['todos'] = [];

        return $todos;
    } else {
        $_SESSION['errors'] = $errors;

        header("Location: register.php");
    }

}
