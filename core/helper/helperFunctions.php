<?php

function view($path, $data = [])
{
    extract($data);
    return require "app/views/{$path}.php";
}

function redirect($path)
{
    header("Location {$path}");
}