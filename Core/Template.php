<?php

namespace Core;

use Contracts\TemplateEngingeContract;

class Template implements TemplateEngingeContract {

    public $data = [];
    private $fileContent = '';
    public function assign(array|object $data)
    {
        $this->data[] = $data;
        return $this;
    }

    public function render()
    {
       echo  $this->varConverter();
    }

    public function view(string $path)
    {
        $newPath =  dirname(__DIR__).DIRECTORY_SEPARATOR.'Views'.DIRECTORY_SEPARATOR.$path.'.tmp.php';
        if(file_exists($newPath)){
            $this->fileContent =  file_get_contents($newPath);
        }else{
            throw new \Exception('Template File Not Exists');
        }


        return $this;
    }

    public function varConverter(){
        // match if method  @if @for @each
        // match list name email {{$ name }}
        dump($this->data);
        return  preg_replace_callback('/{{\$([a-zA-z\-_>]+)}}/i', function($match) {
//           return  $this->data->{$match[1]};
        }, $this->fileContent);
    }
}