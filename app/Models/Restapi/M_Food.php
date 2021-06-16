<?php

namespace App\Models\Restapi;

use CodeIgniter\Model;

class M_Food extends Model
{
    protected $db;
    protected $table            = 'tbl_food';
    protected $useTimestamps    = true;
    protected $createdField     = 'createdDate';
    protected $updatedField     = 'lastUpdateDate';

    public function __construct()
    {
        $this->db = \Config\Database::connect();
    }

    public function getProductAll()
    {
        $builder = $this->db->table('tbl_food a');
        $builder->select('a.foodId,
                          a.foodName,
                          a.air,
                          a.energi,
                          a.protein,
                          a.lemak,
                          a.kh,
                          a.serat,
                          a.abu,
                          a.kalsium,
                          a.fosfor,
                          a.besi,
                          a.natrium,
                          a.kalium,
                          a.tembaga,
                          a.seng,
                          a.retinol,
                          a.bkar,
                          a.karTotal,
                          a.thiamin,
                          a.riborflavin,
                          a.niasin,
                          a.vitc,
                          a.bdd,
                          b.sourceName');
        $builder->join('tbl_source b', 'a.sourceId = b.sourceId', 'LEFT JOIN');
        $builder->where('a.status', 'normal');

        //return $this->response($builder->get()->getResultArray());
        return $builder->get()->getResultArray();
    }

    public function getProductListAll()
    {
        $builder = $this->db->table('tbl_food');
        $builder->select('foodId,foodName');
        $builder->where('status', 'normal');

        //return $this->response($builder->get()->getResultArray());
        return $builder->get()->getResultArray();
    }

    public function getProductDetail($food_id = null)
    {
        $builder = $this->db->table('tbl_food a');
        $builder->select('a.foodId,
                          a.foodName,
                          a.air,
                          a.energi,
                          a.protein,
                          a.lemak,
                          a.kh,
                          a.serat,
                          a.abu,
                          a.kalsium,
                          a.fosfor,
                          a.besi,
                          a.natrium,
                          a.kalium,
                          a.tembaga,
                          a.seng,
                          a.retinol,
                          a.bkar,
                          a.karTotal,
                          a.thiamin,
                          a.riborflavin,
                          a.niasin,
                          a.vitc,
                          a.bdd,
                          b.sourceName');
        $builder->join('tbl_source b', 'a.sourceId = b.sourceId', 'LEFT JOIN');
        $builder->where('a.foodId', $food_id);
        $builder->where('a.status', 'normal');

        //return $this->response($builder->get()->getResultArray());
        return $builder->get()->getResultArray();
    }

    public function response($data)
    {
        if ($data) {
            $data = [200, "Success", $data];
        } else {
            $data = [204, "Data Not Found", null];
        }

        $response = [
            "status"    => $data[0],
            "message"   => $data[1],
            "data"      => $data[2]
        ];

        return $response;
    }
}
