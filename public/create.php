<?php

require_once '../src/storage.php';
require_once '../src/validation.php';

$errors = [];

if(
    $_SERVER['REQUEST_METHOD']
    === 'POST'
)
{
    $errors =
        validateTask($_POST);

    if(empty($errors))
    {

        $tasks =
            loadTasks();

        $tasks[] = [

            'id' =>
            uniqid(),

            'title' =>
            trim($_POST['title']),

            'description' =>
            trim(
                $_POST['description']
            ),

            'priority' =>
            $_POST['priority'],

            'due' =>
            $_POST['due'],

            'completed' =>
            false

        ];

        saveTasks($tasks);

        header(
            "Location: index.php"
        );

        exit;
    }
}

?>

<!DOCTYPE html>

<html>

<head>

<title>Create Task</title>

<link
rel="stylesheet"
href="assets/style.css">

</head>

<body>

<div class="container">

<h1>Create Task</h1>

<form method="POST">

<label>Title</label>

<input
type="text"
name="title"
value="<?=
htmlspecialchars(
$_POST['title'] ?? ''
)
?>">

<?php if(
isset(
$errors['title']
)
): ?>

<p class="error">

<?= $errors['title'] ?>

</p>

<?php endif; ?>

<label>Description</label>

<textarea
name="description"><?=
htmlspecialchars(
$_POST['description'] ?? ''
)
?></textarea>

<label>Priority</label>

<select name="priority">

<option>
Low
</option>

<option>
Medium
</option>

<option>
High
</option>

</select>

<label>Due Date</label>

<input
type="date"
name="due"
value="<?=
$_POST['due'] ?? ''
?>">

<button>
Add Task
</button>

</form>

<a href="index.php">

Back To Tasks

</a>

</div>

</body>

</html>