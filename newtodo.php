<?php
session_start();

if (isset($_SESSION['is_logged']) && isset($_SESSION['username'])) {
$todos = json_decode(file_get_contents('./todos.json'), true);

if (isset($_POST['todo_name'])){
    $todoName = $_POST['todo_name'];
    $todos[$_SESSION['username']]['todos'][$todoName] = [
        'completed' => false,
        'created_at' => date('d-m-Y H:i:s'),
        'updated_at' => ''
    ];
}

file_put_contents('./todos.json', json_encode($todos, JSON_PRETTY_PRINT));

header('Location: todos_list.php');
} else {
    header('Location: index.php');
}