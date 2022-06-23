<?php
function register($todos)
{
    $errors = [];
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
        //$_SESSION['errors'] = [];
        
        if (!empty($todos[$username])){
            $_SESSION['errors']['username_exist'] = "This username is already taken";
        }

        if ($password !== $passwordVerified) {
            $_SESSION['errors']['no_same_password'] = "Password are not the same";
            
        }
        
        if (!empty($_SESSION['errors'])) header("Location: register.php");

        $todos[$username]['password'] = $password;
        $todos[$username]['todos'] = [];

        $_SESSION['is_logged'] = true;
        $_SESSION['username'] = $username;

        return $todos;
    } else {
        $_SESSION['errors'] = $errors;

        header("Location: register.php");
    }

}


function login($todos){
    if (empty($_POST['username'])) {
        $errors['username'] = "Username is required <br>";
    }

    if (empty($_POST['password'])) {
        $errors['password'] = "Password is required <br>";
    }


    if (empty($errors)){
        $username = $_POST['username'];
        $password = $_POST['password'];
        if (empty($todos[$username])){
            $_SESSION['errors'] = "Username or Password is incorrect ";
        }
        var_dump($todos[$username]['password']);
        if ($todos[$username]['password'] !== $password) {
            $_SESSION['errors'] = "Username or Password is incorrect 2";
        }
        if (!empty($_SESSION['errors'])) header("Location: index.php");

        $_SESSION['is_logged'] = true;
        $_SESSION['username'] = $username;

    } else {
        $_SESSION['errors'] = $errors;

        header("Location: index.php");
    }
}
