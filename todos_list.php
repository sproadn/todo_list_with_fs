<?php
session_start();
require_once "./includes/function.php";

$todos = json_decode(file_get_contents('./todos.json'), true);
$errors = [];


if (isset($_POST['register_btn'])) {
    $todos = register($todos);
    file_put_contents('./todosb.json', json_encode($todos, JSON_PRETTY_PRINT));

}
if (isset($_POST['login_btn'])) {
    login($todos);
}

//var_dump(isset($_SESSION['is_logged']) && isset($_SESSION['username']));
if (isset($_SESSION['is_logged']) && isset($_SESSION['username'])) {

$userTodos = $todos[$_SESSION['username']]['todos'];


?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Document</title>
</head>
<body>
    <?php 
    if (isset($_SESSION['is_logged']) && isset($_SESSION['username'])) {
        echo "<a href=\"logout.php\">Logout</a>";
    }
        
    ?>
<div>
  <form action="newtodo.php" method="post">
    <input type="text" name="todo_name" placeholder="Enter your todo">
    <button>New Todo</button>
  </form>
  <br>
    <?php foreach ($userTodos as $todoName => $todo): ?>
      <div style="margin-bottom: 20px;">
        <form style="display: inline" action="change_status.php" method="post">
          <input type="hidden" name="todo_name" value="<?php echo $todoName ?>">
          <input type="checkbox" name="status" value="1" <?php echo ($todo['completed'] ? 'checked' : '') ?>>
        </form>
          <?php echo $todoName ?>
        <form style="display: inline" action="delete.php" method="post">
          <input type="hidden" name="todo_name" value="<?php echo $todoName ?>">
          <button>Delete</button>
        </form>
      </div>
    <?php endforeach; ?>
</div>

<script>
  const checkboxes = document.querySelectorAll('input[type=checkbox]');
  checkboxes.forEach(ch => {
    ch.onclick = function () {
      this.parentNode.submit()
    };
  })
</script>
</body>
</html>
<?php 
} else {
    header("Location: index.php");
}
?>
