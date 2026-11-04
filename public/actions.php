<?php

require_once '../src/storage.php';

$tasks =
loadTasks();

$id =
$_POST['id'];

$action =
$_POST['action'];

if(
$action ===
'delete'
)
{

$tasks =
array_filter(

$tasks,

fn($task)=>

$task['id']
!= $id

);

}

if(
$action ===
'complete'
)
{

foreach(
$tasks
as
&$task
)
{

if(
$task['id']
==
$id
)
{

$task['completed']
=
true;

}

}

}

saveTasks(
array_values(
$tasks
)
);

header(
"Location: index.php"
);

exit;