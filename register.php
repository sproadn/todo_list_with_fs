<?php 
session_start();
$errors = null;
if (!empty($_SESSION['errors'])) {
    $errors = $_SESSION['errors'];
    unset($_SESSION['errors']);
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
</head>
<body>
    <?php require "./includes/header.php"; ?>

    <main>
        <form action="todos_list.php" method="post">
            <input type="text" name="username" placeholder="Username">
            <?php if(!empty($errors) and !empty($errors['username_exist'])) echo $errors['username_exist']; ?>
            <br>
            <input type="password" name="password" placeholder="Password">
            <?php if(!empty($errors) and !empty($errors['password'])) echo $errors['password']; ?>
            <br>
            <input type="password" name="password_verify" placeholder="Password verify">
            <?php if(!empty($errors) and !empty($errors['password_verify'])) echo $errors['password_verify']." "; ?>
            <?php if(!empty($errors) and !empty($errors['no_same_password'])) echo $errors['no_same_password']; ?>
            <br>
            <button type="submit" name="register_btn">S'inscrire</button>
        </form>
    </main>
</body>
</html>