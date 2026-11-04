<?php

function validateTask($data)
{
    $errors = [];

    $title = trim(
        $data['title'] ?? ''
    );

    if($title === '')
    {
        $errors['title'] =
            "Title is required";
    }

    $due =
        trim(
            $data['due'] ?? ''
        );

    if($due !== '')
    {
        if(
            !preg_match(
                '/^\d{4}-\d{2}-\d{2}$/',
                $due
            )
        )
        {
            $errors['due'] =
                "Invalid date";
        }
    }

    return $errors;
}