<?php

namespace App\Models;
use CodeIgniter\Model;
class CategoriasModel extends Model { 
    protected $table = 'categorias'; protected $primaryKey = 'id';
    protected $useAutoIncrement = true; 
    protected $returnType = 'array';
    protected $useSoftDeletes = true;
    protected $allowedFields = ['nombre'];
    protected $useTimestamps = false;
    protected $dateFormat = 'datetime';
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    protected $deletedField = 'deleted_at';
    protected $validationRules = [];
    protected $validationMessages = [];
    protected $skipValidation = false;
    protected $cleanValidationRules = true;

    public function getNombreCategorias() {
        $db = \Config\Database::connect();
        $query = $db->table('categorias')->select('id, nombre')->get();
        $resultado = $query->getResultArray();
        return $resultado;
    }
}

