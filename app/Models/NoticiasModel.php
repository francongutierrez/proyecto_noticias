<?php

namespace App\Models;
use CodeIgniter\Model;

class NoticiasModel extends Model { 
    protected $table = 'noticias'; protected $primaryKey = 'id';
    protected $useAutoIncrement = true; 
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $allowedFields = ['titulo', 'descripcion', 'categoria', 'fecha', 'imagen', 'estado', 'usuario_id'];
    protected $useTimestamps = false;
    protected $dateFormat = 'datetime';
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    protected $deletedField = 'deleted_at';
    protected $validationRules = [];
    protected $validationMessages = []; 
    protected $skipValidation = false;
    protected $cleanValidationRules = true;

    public function getNoticias($page, $perPage) {
        $db = \Config\Database::connect();
        $builder = $db->table('noticias');
        $builder->select('noticias.titulo, noticias.descripcion, noticias.fecha, categorias.nombre as categoria_nombre, imagen');
        $builder->join('categorias', 'categorias.id = noticias.categoria'); // INNER JOIN con la tabla de categorías
        $builder->where('noticias.estado', 'publicada'); // Agregar condición de estado 'publicada'
        $builder->where('noticias.vigencia', 'activa'); // Agregar condición de vigencia 'activa'
        $builder->limit($perPage, ($page - 1) * $perPage); // Agregar límite y desplazamiento
        $query = $builder->get(); // Ejecutar la consulta y obtener los resultados
        
        return $query->getResultArray(); // Devolver los resultados como un arreglo asociativo
    }
    
    public function getBorradoresPorUsuario($usuarioId) {
        $db = \Config\Database::connect();
        $builder = $db->table('noticias');
        $builder->select('noticias.id, noticias.titulo, noticias.descripcion, noticias.fecha, noticias.imagen, usuarios.id as usuario_id');
        $builder->join('usuarios', 'usuarios.id = noticias.usuario_id');
        $builder->where('noticias.estado', 'borrador');
        $builder->where('noticias.usuario_id', $usuarioId);
        $query = $builder->get();
        return $query->getResultArray();
    }

    public function getBorradorPorId($id)
    {
        return $this->find($id);
    }

    public function obtenerNoticiasParaValidar($per_page = 10)
    {
        $estado = 'validar';
        return $this->where('estado', $estado)->paginate($per_page);
    }

    
    public function obtenerNoticiaConDetalles($id)
    {
        $query = $this->db->table('noticias')
            ->select('noticias.*, categorias.nombre as nombre_categoria, usuarios.email as nombre_autor')
            ->join('categorias', 'categorias.id = noticias.categoria')
            ->join('usuarios', 'usuarios.id = noticias.usuario_id')
            ->where('noticias.id', $id)
            ->get();
    
        // Devolver una única fila de resultados
        return $query->getRowArray();
    }

}



