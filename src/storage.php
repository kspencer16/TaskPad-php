<?php

function loadTasks()
{
    $file = __DIR__ . '/../data/tasks.json';

    if (!file_exists($file))
    {
        return [];
    }

    $json = file_get_contents($file);

    return json_decode($json,true) ?? [];
}

function saveTasks($tasks)
{
    $file = __DIR__ . '/../data/tasks.json';

    file_put_contents(
        $file,
        json_encode(
            $tasks,
            JSON_PRETTY_PRINT
        )
    );
}