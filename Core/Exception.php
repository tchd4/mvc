<?php
set_exception_handler(function ($exception) {
    echo "<br>Exception: ". $exception->getMessage();
    echo "<br>File: ". $exception->getFile();
    echo "<br>Line: ". $exception->getLine();
    echo "<br>Code: ". $exception->getCode();
});