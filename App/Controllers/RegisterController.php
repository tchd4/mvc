<?php


namespace App\App\Controllers;


use App\App\Models\User;
use App\Core\Collection;
use App\Core\Session;

class RegisterController extends Controller
{
    public $user;
    public function __construct()
    {
        parent::__construct();
        $this->user = new User();
    }

    public function show()
    {

    }

    public function create() {
        return $this->temp->view('register',
            [
                'csrf'=>$this->csrfCreate(),
                'title'=>"Register"
            ]
        );
    }

    public function store()
    {
        // Check if CSRF Token is Valid

        $this->csrfCheck();
        $data = $this->validation();
        if(!Session::has('error'))
        {
            $coll = new Collection($this->user->insert($data));
            return $this->temp->view('register',
                [
                    'csrf'=>$this->csrfCreate(),
                    'data'=>$coll->toArray(),
                    'title'=>"Register"
                ]
            );
            redirect('users');
        }
        redirect('register');
    }

    public function validation()
    {
        Session::clear();
        $name = trim($_POST['name']);
        if(empty($name))
            $_SESSION['error']['name'] = 'Name is Empty.';


        $email = trim($_POST['email']);
        if(empty($email)) {
            $_SESSION['error']['email'] = 'Email is Empty.';
        }else{
            if(!preg_match("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$^", $email))
            {
                $_SESSION['error']['email'] = 'Email is not valid.';
            }
        }



        $password = trim($_POST['password']);
        if(empty($password)) {
            $_SESSION['error']['password'] = 'Password is Empty.';
        }

        if(empty(trim($_POST['password-confirm']) )){
            $_SESSION['error']['password-confirm'] = 'confirm password';
        }

        if($_POST['password'] != $_POST['password-confirm']){
            $_SESSION['error']['password'] = 'password not match';
        }
        $password = md5(sha1(md5($_POST['password'])));


        $_SESSION['old'] = [
            'name' => $name,
            'email' => $email,
            'password' => $password
        ];

        return [
            'name' => $name,
            'email' => $email,
            'password' => $password
        ];
    }

    public function csrfCreate()
    {
        return $_SESSION['token'] = sha1(md5(rand(0,24)));
    }

    public function csrfCheck()
    {

        if ($_SESSION['token'] !== $_POST['csrf']) {
            throw new \Exception('Error: CSRF Page Not Found!');
        }
    }
}