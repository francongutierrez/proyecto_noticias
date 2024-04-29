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

    public function getNoticias() {
        $db = \Config\Database::connect();
        $builder = $db->table('noticias');
        $builder->select('noticias.titulo, noticias.descripcion, noticias.fecha, categorias.nombre as categoria_nombre');
        $builder->join('categorias', 'categorias.id = noticias.categoria'); // INNER JOIN con la tabla de categorías
        $query = $builder->get(); // Ejecutar la consulta y obtener los resultados
        
        return $query->getResultArray(); // Devolver los resultados como un arreglo asociativo
    }
}



