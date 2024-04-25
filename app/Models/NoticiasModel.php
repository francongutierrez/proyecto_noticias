<?php

namespace App\Models;
use CodeIgniter\Model;
class NoticiasModel extends Model { 
    protected $table = 'noticias'; protected $primaryKey = 'id';
    protected $useAutoIncrement = true; 
    protected $returnType = 'array';
    protected $useSoftDeletes = true;
    protected $allowedFields = ['titulo', 'descripcion', 'categoria', 'fecha'];
    protected $useTimestamps = false;
    protected $dateFormat = 'datetime';
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    protected $deletedField = 'deleted_at';
    protected $validationRules = [];
    protected $validationMessages = [];
    protected $skipValidation = false;
    protected $cleanValidationRules = true;

}

