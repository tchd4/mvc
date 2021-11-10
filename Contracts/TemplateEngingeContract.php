<?php
namespace Contracts;

interface TemplateEngingeContract {

    public function view(string $path);
    public function assign(array|object $data);
    public function render();
}