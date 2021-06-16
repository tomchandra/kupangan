<?php

namespace App\Models;

use CodeIgniter\Model;

class AdminModel extends Model
{
    protected $table = 'tbl_food';
    //protected $allowedFields = ['user_name', 'user_email', 'user_password', 'user_created_at'];

    public function getData()
    {
        $this->builder()->select('tbl_food.id,
                                  tbl_food.foodId,
                                  tbl_food.foodName,
                                  tbl_food.sourceId,
                                  tbl_source.sourceName,
                                  tbl_food.air,
                                  tbl_food.energi,
                                  tbl_food.protein,
                                  tbl_food.lemak,
                                  tbl_food.kh,
                                  tbl_food.serat,
                                  tbl_food.abu,
                                  tbl_food.kalsium,
                                  tbl_food.fosfor,
                                  tbl_food.besi,
                                  tbl_food.natrium,
                                  tbl_food.kalium,
                                  tbl_food.tembaga,
                                  tbl_food.seng,
                                  tbl_food.retinol,
                                  tbl_food.bkar,
                                  tbl_food.karTotal,
                                  tbl_food.thiamin,
                                  tbl_food.riborflavin,
                                  tbl_food.niasin,
                                  tbl_food.vitc,
                                  tbl_food.bdd')->join('tbl_source', 'tbl_source.sourceId = tbl_food.sourceId')->where('tbl_food.status', "normal")->orderBy('tbl_food.foodName', 'ASC');
        return [
            'food' => $this->paginate(15, 'bootstrap'),
            'pager' => $this->pager,
        ];
    }

    public function getData_edit($id)
    {
        $db = \Config\Database::connect();

        $builder = $db->table('tbl_food a');
        $builder->select('a.*, b.sourceName');
        $builder->join('tbl_source b', 'a.sourceId = b.sourceId', 'LEFT JOIN');
        $builder->where('a.id', $id);

        return $builder->get()->getResultArray();
    }

    public function simpan_data($data)
    {
        $db = \Config\Database::connect();

        $db->table('tbl_food')->insert($data);

        return $db->insertID();
    }

    public function update_data($data, $where)
    {
        $db = \Config\Database::connect();
        $db->table('tbl_food')->update($data, $where);
    }

    public function delete_data($id)
    {
        $db = \Config\Database::connect();
        $data = [
            "status" => "nullified"
        ];

        $db->table('tbl_food')->update($data, array('id' => $id));
    }
}
