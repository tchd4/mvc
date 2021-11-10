<?php
function dd($data) {
    echo "<pre>".print_r($data, true)."</pre>";
    die();
}

function dump($data) {
    echo "<pre>".print_r($data, true)."</pre>";
}
