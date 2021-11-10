<?php
namespace App\Controllers;
use App\Models\User;

class UserController extends Controller {
    private $user = null;
    public function __construct()
    {
        parent::__construct();
        $this->user = new User();

    }

    public function index()
    {
        dd($this->user->select()->all());

    }

    public function show()
    {
        $data = $this->user->select()->get();
        $this->temp->view('layout')
                    ->assign($data)
                    ->assign(['title'=>"Title Mamdouh"])
                    ->render();
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