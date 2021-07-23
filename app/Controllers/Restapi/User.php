<?php

namespace App\Controllers\Restapi;

use \App\Libraries\Oauth;
use \OAuth2\Request;
use CodeIgniter\API\ResponseTrait;
use App\Models\Restapi\M_User;
use App\Controllers\BaseController;

class User extends BaseController
{
	use ResponseTrait;
	public function login()
	{
		$oauth 		= new Oauth();
		$request 	= new Request();
		$respond 	= $oauth->server->handleTokenRequest($request->createFromGlobals());
		$code 		= $respond->getStatusCode();
		$body 		= json_decode($respond->getResponseBody());

		if (!isset($body->error) && $this->request->getPost('username')) {
			$model 	= new M_User();
			$user 	= $model->where('email', $this->request->getPost('username'))->first();

			$data = [
				'first_name' 	=> $user['first_name'],
				'last_name'		=> $user['last_name'],
				'job'			=> $user['job'],
				'access_token' 	=> $body->access_token,
			];

			return $this->respond($data, $code);
		}

		return $this->respond($body, $code);
	}

	public function register()
	{
		helper('form');
		$data = [];

		if ($this->request->getMethod() != 'post') {
			return $this->fail('Only post request is allowed');
		}

		$rules = [
			'first_name' 		=> [
				'label'  => 'Nama depan',
				'rules'  => 'required|min_length[3]|max_length[20]',
				'errors' => [
					'required'   => '{field} harus di isi.',
					'min_length' => '{field} minimal 3 karakter.',
					'max_length' => '{field} maksimal 20 karakter.'

				]
			],
			'last_name' 		=> [
				'label'  => 'Nama belakang',
				'rules'  => 'required|min_length[3]|max_length[20]',
				'errors' => [
					'required'   => '{field} harus di isi.',
					'min_length' => '{field} minimal 3 karakter.',
					'max_length' => '{field} maksimal 20 karakter.'

				]
			],
			'email' 		=> [
				'label'  => 'Email',
				'rules'  => 'required|valid_email|is_unique[tbl_users.email]',
				'errors' => [
					'required' 	  => '{field} harus di isi.',
					'valid_email' => 'Format email salah.',
					'is_unique'   => '{field} Sudah digunakan.'

				]
			],
			'job' 		=> [
				'label'  => 'Pekerjaan',
				'rules'  => 'required',
				'errors' => [
					'required'   => '{field} harus di isi.',
				]
			],
			'password' 		=> [
				'label'  => 'Password',
				'rules'  => 'required|min_length[6]|max_length[10]',
				'errors' => [
					'required'   => '{field} harus di isi.',
					'min_length' => '{field} minimal 6 karakter.',
					'max_length' => '{field} maksimal 10 karakter.'

				]
			],
			'password_confirm' 		=> [
				'label'  => 'Password konfirmasi',
				'rules'  => 'matches[password]',
				'errors' => [
					'matches'   => '{field} tidak sama.',
				]
			]
		];

		if (!$this->validate($rules)) {
			return $this->fail($this->validator->getErrors());
		} else {
			$model = new M_User();

			$data = [
				'status'		=> TRUE,
				'first_name' 	=> $this->request->getVar('first_name'),
				'last_name' 	=> $this->request->getVar('last_name'),
				'email'	 		=> $this->request->getVar('email'),
				'job' 			=> $this->request->getVar('job'),
				'password' 		=> $this->request->getVar('password'),
			];

			$user_id = $model->insert($data);
			$data['id'] = $user_id;
			unset($data['password']);

			return $this->respondCreated($data);
		}
	}
}
