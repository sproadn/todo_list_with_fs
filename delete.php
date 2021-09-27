<?php
session_start();

if (isset($_SESSION['is_logged']) && isset($_SESSION['username'])) {
$todos = json_decode(file_get_contents('./todos.json'), true);
$todoName = $_POST['todo_name'];

unset($todos[$_SESSION['username']]['todos'][$todoName]);

file_put_contents('./todos.json', json_encode($todos, JSON_PRETTY_PRINT));
header('Location: todos_list.php');

} else {
    header('Location: index.php');
}