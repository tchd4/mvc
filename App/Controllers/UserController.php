<?php
namespace App\App\Controllers;
use App\App\Models\User;
use App\Core\Collection;

class UserController extends Controller {
    private $user = null;
    public function __construct()
    {
        parent::__construct();
        $this->user = new User();

    }

    public function index()
    {
        $user = new Collection($this->user->select()->all());
        return $this->temp->view('layout',
            [
                "users" => $user->collections(),
                "title"=> "Mamdouh Khaled",
            ]
        );
    }


    public function show()
    {
        $user = new Collection($this->user->select()->get());
        $this->temp->view('userShow',
            [
                'user'=> $user->make()->toArray(),
                'title'=>"Show  User"
            ]
        );
    }

    public function store()
    {
        dd($this->user->insert([
            'name' => 'Mamdouh',
            'email' => 'Mamdouh@khaled.com',
            'password' => 123456789,
        ]));
    }

    public function update()
    {
        dd($this->user->select()->get());
    }

    public function delete()
    {
        dd($this->user->select()->get());
    }
}