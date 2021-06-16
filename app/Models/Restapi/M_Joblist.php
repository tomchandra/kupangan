<?php

namespace App\Models\Restapi;

use CodeIgniter\Model;

class M_Joblist extends Model
{
    protected $db;
    protected $table            = 'tbl_jobs';
    protected $useTimestamps    = true;
    protected $createdField     = 'createdDate';
    protected $updatedField     = 'lastUpdateDate';

    public function __construct()
    {
        $this->db = \Config\Database::connect();
    }

    public function getJoblist()
    {
        $builder = $this->db->table('tbl_jobs');
        $builder->select('job_cd,job_name');
        return $builder->get()->getResultArray();
    }
}
