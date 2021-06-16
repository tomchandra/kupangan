<?php

namespace App\Controllers\Restapi;

use CodeIgniter\RESTful\ResourceController;
use App\Models\Restapi\M_Food;

class Food extends ResourceController
{
    protected $foodModel;
    public function __construct()
    {
        header('Access-Control-Allow-Origin: *');
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");

        $this->foodModel = new M_Food();
    }

    public function index()
    {
        $data       = $this->foodModel->getProductAll();

        return $this->respond($data);
    }

    public function show($id = '')
    {
        $data       = $this->foodModel->getProductDetail($id);

        return $this->respond($data);
    }
}
