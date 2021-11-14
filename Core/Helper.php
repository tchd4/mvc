<?php

function dd($data) {
    echo "<pre>".print_r($data, true)."</pre>";
    die();
}

function dump($data) {
    echo "<pre>".print_r($data, true)."</pre>";
}

function errors($return = false) {

    if(\App\Core\Session::has('error')){
        return false;
    }

    if($return)
        return \App\Core\Session::get('error');
    else
        echo implode("<br />", \App\Core\Session::get('error'))."<hr>";
}

function old(string $name) {
    if(!empty($_SESSION['old'][$name]))
        echo $_SESSION['old'][$name];
}

function redirect(string $url) {
    header('Location: '.$url);
}