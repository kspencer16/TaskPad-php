<?php

require_once '../src/storage.php';

$tasks =
    loadTasks();

$q =
$_GET['q']
?? '';

$priority =
$_GET['priority']
?? '';

$filteredTasks =
array_filter(

$tasks,

function($task)
use($q,$priority)
{

$matchesText =

stripos(
$task['title'],
$q
)!==false

||

stripos(
$task['description'],
$q
)!==false;

$matchesPriority =

(
$priority === ''
||
$task['priority']
=== $priority
);

return
$matchesText
&&
$matchesPriority;

}

);

?>

<!DOCTYPE html>

<html>

<head>

<title>TaskPad</title>

<link
rel="stylesheet"
href="assets/style.css">

</head>

<body>

<div class="container">

<h1>TaskPad PHP</h1>

<a href="create.php">

Create Task

</a>

<form method="GET">

<input
type="text"
name="q"
placeholder="Search"
value="<?= $q ?>">

<select
name="priority">

<option value="">
All Priorities
</option>

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

<button>

Filter

</button>

</form>

<?php if(
count($tasks)==0
): ?>

<p>

No Tasks Yet

</p>

<?php endif; ?>

<?php if(
count($filteredTasks)==0
&&
count($tasks)>0
): ?>

<p>

No matches found

</p>

<?php endif; ?>

<?php foreach(
$filteredTasks
as
$task
): ?>

<div class="task">

<h3>

<?= htmlspecialchars(
$task['title']
) ?>

</h3>

<p>

<?= htmlspecialchars(
$task['description']
) ?>

</p>

<p>

Priority:

<?= $task['priority'] ?>

</p>

<p>

Status:

<?=

$task['completed']
?
'Completed'
:
'Open'

?>

</p>

<form
action="actions.php"
method="POST">

<input
type="hidden"
name="id"
value="<?=
$task['id']
?>">

<button
name="action"
value="complete">

Complete

</button>

<button
name="action"
value="delete">

Delete

</button>

</form>

</div>

<?php endforeach; ?>

</div>

</body>

</html>