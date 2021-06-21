<?php

namespace App\Controllers;


class Login extends BaseController
{

    protected $request;
    protected $session;
    protected $options;
    protected $api_client;
    protected $api_username;
    protected $api_password;
    protected $api_grant_type;

    public function __construct()
    {
        $this->request        = \Config\Services::request();
        $this->session        = session();
        $this->api_username   = 'apikupangan';
        $this->api_password   = '13f27c21a7bd4fd7ecf6187df1d29e34d5d3cbf8';
        $this->api_grant_type = 'password';
        $this->options        = [
            'baseURI' => getenv('api.baseURI'),
            'timeout' => 0
        ];

        $this->api_client = \Config\Services::curlrequest($this->options);
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
        $response = $this->api_client->request('POST', 'login', [
            'auth'        => [$this->api_username, $this->api_password, 'basic'],
            'http_errors' => false,
            'form_params' => [
                'username'   => $this->request->getPost('username'),
                'password'   => $this->request->getPost('password'),
                'grant_type' => 'password'
            ]
        ]);
        $body   = json_decode($response->getBody());
        switch ($response->getStatusCode()) {
            case 200:
                $data = [
                    'first_name'    => $body->first_name,
                    'last_name'     => $body->last_name,
                    'job'           => $body->job,
                    'role'          => 'user',
                    'token'         => $body->access_token,
                    'logged_in'     => TRUE
                ];

                $this->session->set($data, 3600);
                return redirect()->to('dashboard');
                break;
            case 401:
                $this->session->setFlashdata('msg', $body->error_description);
                return redirect()->to('login');
                break;
            default:
                return redirect()->to('login');
        }
    }

    public function sign_up()
    {
        $response = $this->api_client->request('POST', 'register', [
            'http_errors' => false,
            'form_params' => [
                'first_name'       => $this->request->getPost('first_name'),
                'last_name'        => $this->request->getPost('last_name'),
                'job'              => $this->request->getPost('job'),
                'email'            => $this->request->getPost('email'),
                'password'         => $this->request->getPost('password'),
                'password_confirm' => $this->request->getPost('password_confirm')
            ]
        ]);
        $body   = json_decode($response->getBody());

        switch ($response->getStatusCode()) {
            case 200:
                return json_encode(array("status" => TRUE));
                break;
            case 400:
                $data = "";
                foreach ($body->messages as $value) {
                    $data .= $value . "<br/>";
                }
                return json_encode(array("status" => FALSE, "message" => $data));
                break;
            default:
                return redirect()->to('login');
        }
    }

    public function logout()
    {
        $session = session();
        $session->destroy();
        return redirect()->to('/');
    }
}
