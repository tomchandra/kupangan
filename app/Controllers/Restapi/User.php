<?php

namespace App\Controllers\Restapi;

use \App\Libraries\Oauth;
use \OAuth2\Request;
use CodeIgniter\API\ResponseTrait;
use App\Models\M_User;
use App\Controllers\BaseController;

class User extends BaseController
{
	use ResponseTrait;
	public function __construct()
	{
		header('Access-Control-Allow-Origin: *');
		header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
	}

	public function login()
	{
		$oauth 		= new Oauth();
		$request 	= new Request();
		$respond 	= $oauth->server->handleTokenRequest($request->createFromGlobals());
		$code 		= $respond->getStatusCode();
		$body 		= json_decode($respond->getResponseBody());

		// if (isset($body->error)) {
		// 	$callback = [$body->error_description, null];
		// } else {
		// 	$callback = ["Success", $body];
		// }

		// $response 	= [
		// 	"status" 	=> $code,
		// 	"message" 	=> $callback[0],
		// 	"data" 		=> $callback[1]
		// ];

		return $this->respond($body, $code);
	}

	public function register()
	{
		helper('form');
		$data = [];

		if ($this->request->getMethod() != 'post')
			return $this->fail('Only post request is allowed');


		$rules = [
			'first_name' 		=> 'required|min_length[3]|max_length[20]',
			'last_name' 		=> 'required|min_length[3]|max_length[20]',
			'email'	 			=> 'required|valid_email|is_unique[tbl_users.email]',
			'job'	 			=> 'required',
			'password' 			=> 'required|min_length[6]',
			'password_confirm' 	=> 'matches[password]',
		];

		if (!$this->validate($rules)) {
			return $this->fail($this->validator->getErrors());
		} else {
			$model = new M_User();

			$data = [
				'first_name' => $this->request->getVar('first_name'),
				'last_name' => $this->request->getVar('last_name'),
				'email' => $this->request->getVar('email'),
				'job' => $this->request->getVar('job'),
				'password' => $this->request->getVar('password'),
			];

			$user_id = $model->insert($data);
			$data['id'] = $user_id;
			unset($data['password']);

			return $this->respondCreated($data);
		}
	}



	public function create()
	{
	}

	public function edit()
	{
	}
}
