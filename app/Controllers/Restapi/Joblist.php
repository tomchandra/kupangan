<?php

namespace App\Controllers\Restapi;

use CodeIgniter\RESTful\ResourceController;
use App\Models\Restapi\M_Joblist;

class Joblist extends ResourceController
{
    protected $foodModel;
    public function __construct()
    {
        $this->foodModel = new M_Joblist();
    }

    public function index()
    {
        $data       = $this->foodModel->getJoblist();
        return $this->respond($data);
    }
}
