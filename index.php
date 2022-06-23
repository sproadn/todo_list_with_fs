<?php 
session_start();

$errors = null;
if (empty($_SESSION['errors'])) {
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
    <title>Home</title>
</head>
<body>
    <?php require "./includes/header.php"; ?>
    <main>
        <form action="todos_list.php" method="post">
            <?php 
                if(!empty($errors)) {
                    if (is_array($errors)) {
                        echo implode("", $errors);
                    } else {
                        echo $errors . "<br>";
                    }
                }
            ?>
            <input type="text" name="username" placeholder="Username"><br>
            <input type="text" name="password" placeholder="Password"><br>
            <button type="submit" name="login_btn">Se connecter!</button>
        </form>
    </main>
</body>
</html>