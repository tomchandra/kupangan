<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'tbl_users';
    //protected $allowedFields = ['user_name', 'user_email', 'user_password', 'user_created_at'];

    public function simpan_data($data)
    {
        $db = \Config\Database::connect();

        $db->table('tbl_users')->insert($data);

        return $db->insertID();
    }
}
