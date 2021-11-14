<?php
namespace App\Contracts;

interface TemplateEngingeContract {

    public function view(string $path, array $data);
    public function assign(array $data);
    public function render();
}