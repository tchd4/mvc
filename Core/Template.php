<?php

namespace App\Core;

use App\Contracts\TemplateEngingeContract;

class Template implements TemplateEngingeContract {

    public $data = [] ;
    private $fileContent = '';
    public function assign(array $data)
    {
        $this->data = array_merge($this->data, $data);
        return $this;
    }

    public function render()
    {
       echo  $this->varConverter();
    }

    public function view(string $path, array $data)
    {
        $this->assign($data);
        $newPath =  dirname(__DIR__).DIRECTORY_SEPARATOR.'Views'.DIRECTORY_SEPARATOR.$path.'.tmp.php';
        if(file_exists($newPath)){
            foreach ($this->data as $key => $value)
            {
                $$key = $value;
            }
            ob_start();
            require_once($newPath);
            echo ob_get_clean();
        }else{
            throw new \Exception('Template File Not Exists');
        }
    }
}