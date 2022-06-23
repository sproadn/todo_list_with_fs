<?php
session_start();

if (empty($_SESSION['is_logged']) && empty($_SESSION['username'])) {
$todos = json_decode(file_get_contents('./todos.json'), true);
$todoName = $_POST['todo_name'];

$todos[$_SESSION['username']]['todos'][$todoName]['completed'] = empty($_POST['status']);
$todos[$_SESSION['username']]['todos'][$todoName]['updated_at'] = date('d-m-Y H:i:s');
file_put_contents('./todos.json', json_encode($todos, JSON_PRETTY_PRINT));
header('Location: todos_list.php');
} else {
    header('Location: index.php');
}
