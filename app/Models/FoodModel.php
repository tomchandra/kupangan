<?php

namespace App\Models;

use CodeIgniter\Model;

class FoodModel extends Model
{
    protected $table            = 'tbl_food';
    protected $useTimestamps    = true;
    protected $createdField     = 'createdDate';
    protected $updatedField     = 'lastUpdateDate';

    public function getProduct()
    {
        $db = \Config\Database::connect();

        $builder = $db->table('tbl_food');
        $builder->select('foodId, foodName');

        return $builder->get()->getResultArray();
    }

    public function getSource()
    {
        $db = \Config\Database::connect();

        $builder = $db->table('tbl_source');
        $builder->select('sourceId, sourceName');

        return $builder->get()->getResultArray();
    }

    public function getProductDetail($food_id)
    {
        $db = \Config\Database::connect();

        $builder = $db->table('tbl_food a');
        $builder->select('a.*, b.sourceName');
        $builder->join('tbl_source b', 'a.sourceId = b.sourceId', 'LEFT JOIN');
        $builder->where('a.foodId', $food_id);

        return $builder->get()->getResultArray();
    }
}
