<?php

namespace App\Controllers;

use App\Models\AdminModel;
use App\Models\FoodModel;

class Admin extends BaseController
{
    protected $AdminModel;
    protected $FoodModel;
    protected $pager;
    protected $session;

    public function __construct()
    {
        $this->AdminModel = new AdminModel();
        $this->FoodModel = new FoodModel();
        $this->pager = \Config\Services::pager();
        $this->session = \Config\Services::session();
        $this->session->start();
    }

    public function index()
    {
        if ($this->session->get('logged_in') == TRUE) {

            $paging = $this->AdminModel->getData();
            $source = $this->FoodModel->getSource();
            $data = [
                'title' => 'KUPANGAN - Master',
                'food' => $paging['food'],
                'pager' => $paging['pager'],
                'source' => $source
            ];

            return view('admin/master', $data);
        } else {
            return redirect()->to('/login');
        }
    }

    public function insert()
    {
    }


    public function update()
    {
        if ($this->request->isAJAX()) {

            $data = array(
                'foodName' => service('request')->getPost('foodName'),
                'sourceId' => service('request')->getPost('sourceId'),
                'air' => service('request')->getPost('air'),
                'energi' => service('request')->getPost('energi'),
                'protein' => service('request')->getPost('protein'),
                'lemak' => service('request')->getPost('lemak'),
                'kh' => service('request')->getPost('kh'),
                'serat' => service('request')->getPost('serat'),
                'abu' => service('request')->getPost('abu'),
                'kalsium' => service('request')->getPost('kalsium'),
                'fosfor' => service('request')->getPost('fosfor'),
                'besi' => service('request')->getPost('besi'),
                'natrium' => service('request')->getPost('natrium'),
                'kalium' => service('request')->getPost('kalium'),
                'tembaga' => service('request')->getPost('tembaga'),
                'seng' => service('request')->getPost('seng'),
                'retinol' => service('request')->getPost('retinol'),
                'bkar' => service('request')->getPost('bkar'),
                'karTotal' => service('request')->getPost('karTotal'),
                'thiamin' => service('request')->getPost('thiamin'),
                'riborflavin' => service('request')->getPost('riborflavin'),
                'niasin' => service('request')->getPost('niasin'),
                'vitc' => service('request')->getPost('vitc'),
                'bdd' => service('request')->getPost('bdd')
            );

            $this->AdminModel->update_data($data, array('id' => service('request')->getPost('id')));
            echo json_encode(array("status" => TRUE));
        }
    }

    public function save()
    {
        if ($this->request->isAJAX()) {

            $data = array(
                'foodId' => service('request')->getPost('foodName'),
                'foodName' => service('request')->getPost('foodName'),
                'sourceId' => service('request')->getPost('sourceId'),
                'air' => service('request')->getPost('air'),
                'energi' => service('request')->getPost('energi'),
                'protein' => service('request')->getPost('protein'),
                'lemak' => service('request')->getPost('lemak'),
                'kh' => service('request')->getPost('kh'),
                'serat' => service('request')->getPost('serat'),
                'abu' => service('request')->getPost('abu'),
                'kalsium' => service('request')->getPost('kalsium'),
                'fosfor' => service('request')->getPost('fosfor'),
                'besi' => service('request')->getPost('besi'),
                'natrium' => service('request')->getPost('natrium'),
                'kalium' => service('request')->getPost('kalium'),
                'tembaga' => service('request')->getPost('tembaga'),
                'seng' => service('request')->getPost('seng'),
                'retinol' => service('request')->getPost('retinol'),
                'bkar' => service('request')->getPost('bkar'),
                'karTotal' => service('request')->getPost('karTotal'),
                'thiamin' => service('request')->getPost('thiamin'),
                'riborflavin' => service('request')->getPost('riborflavin'),
                'niasin' => service('request')->getPost('niasin'),
                'vitc' => service('request')->getPost('vitc'),
                'bdd' => service('request')->getPost('bdd')
            );

            $this->AdminModel->simpan_data($data);
            echo json_encode(array("status" => TRUE));
        }
    }

    public function delete()
    {
        if ($this->request->isAJAX()) {
            $this->AdminModel->delete_data(array('id' => service('request')->getPost('id')));
            echo json_encode(array("status" => TRUE));
        }
    }
}
