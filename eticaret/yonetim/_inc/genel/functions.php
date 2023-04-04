<?php

function br(){
    echo "<br/>";
}

function pre(){
    echo "<pre>";
}

function post(){
    print_r($_POST);
}

function get(){
    print_r($_GET);
}

function set(){
    print_r($_SET);
}

function files(){
    print_r($_FILES);
}

function session(){
    print_r($_SESSION);
}

function server(){
    print_r($_SERVER);
}

function cookie(){
    print_r($_COOKIE);
}
?>
