<?php

namespace App\Controllers;

use App\Models\UserModel;

class Login extends BaseController
{

    protected $request;
    protected $UserModel;

    public function __construct()
    {
        $this->UserModel = new UserModel();
        $this->request = \Config\Services::request();
    }

    public function index()
    {
        helper(['form']);

        $data = [
            'title' => 'KUDAPAN - Login'
        ];
        return view('pages/login', $data);
    }

    public function auth()
    {
        $session = session();
        $model = new UserModel();
        $username = $this->request->getVar('username');
        $password = $this->request->getVar('password');
        $data = $model->where('email', $username)->first();

        if ($data) {
            //$pass = password_hash($data['password'], PASSWORD_DEFAULT);
            $verify = password_verify($password, $data['password']);
            if ($verify) {
                $ses_data = [
                    'username'      => $data['email'],
                    'first_name'    => $data['first_name'],
                    'last_name'     => $data['last_name'],
                    'role'          => $data['role'],
                    'logged_in'     => TRUE
                ];
                $session->set($ses_data);
                return redirect()->to('/dashboard');
            } else {
                $session->setFlashdata('msg', 'Wrong Password');
                return redirect()->to('/login');
            }
        } else {
            $session->setFlashdata('msg', 'Email not Found');
            return redirect()->to('/login');
        }
    }

    public function sign_up()
    {
        if ($this->request->isAJAX()) {
            $model = new UserModel();
            $data = $model->where('email', service('request')->getPost('username2'))->first();
            //dd($data);
            if ($data) {
                echo json_encode(array("status" => FALSE));
            } else {
                $job = service('request')->getPost('profesi');
                if (service('request')->getPost('other_job') != "") {
                    $job = service('request')->getPost('other_job');
                }

                $data = array(
                    'first_name' => service('request')->getPost('first_name'),
                    'last_name' => service('request')->getPost('last_name'),
                    'job' => $job,
                    'email' => service('request')->getPost('user_id2'),
                    'password' => password_hash(service('request')->getPost('password2'), PASSWORD_DEFAULT),
                );
                $this->UserModel->simpan_data($data);
                echo json_encode(array("status" => TRUE));
            }
        }
    }

    public function logout()
    {
        $session = session();
        $session->destroy();
        return redirect()->to('/');
    }
}
