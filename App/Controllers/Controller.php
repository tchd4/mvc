<?php


namespace App\App\Controllers;


use App\Core\Template;

class Controller
{
    protected $temp = null;

    public function __construct()
    {
        $this->temp = new Template();
    }
}