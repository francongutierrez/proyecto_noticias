<?php

namespace App\Models;
use CodeIgniter\Model;

class NoticiasModel extends Model { 
    protected $table = 'noticias'; protected $primaryKey = 'id';
    protected $useAutoIncrement = true; 
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $allowedFields = ['titulo', 'descripcion', 'categoria', 'fecha', 'imagen', 'estado', 'vigencia', 'usuario_id', 'publicada_automaticamente', 'recien_creada'];
    protected $useTimestamps = false;
    protected $dateFormat = 'datetime';
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    protected $deletedField = 'deleted_at';
    protected $validationRules = [];
    protected $validationMessages = []; 
    protected $skipValidation = false;
    protected $cleanValidationRules = true;

    public function countNoticiasPublicadas()
    {
        return $this->db->table('noticias')
            ->where('estado', 'publicada')
            ->where('vigencia', 'activa')
            ->countAllResults();
    }
    
    public function getNoticias($page, $perPage)
    {
        $offset = ($page - 1) * $perPage;
        return $this->db->table('noticias')
            ->select('noticias.id, noticias.titulo, noticias.descripcion, noticias.fecha, categorias.nombre as categoria_nombre, imagen')
            ->join('categorias', 'categorias.id = noticias.categoria')
            ->where('noticias.estado', 'publicada')
            ->where('noticias.vigencia', 'activa')
            ->limit($perPage, $offset)
            ->get()
            ->getResultArray();
    }
    
    
    public function getBorradoresPorUsuario($usuarioId, $page, $perPage)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('noticias');
        $builder->select('noticias.id, noticias.titulo, noticias.descripcion, noticias.fecha, noticias.imagen, usuarios.id as usuario_id, noticias.recien_creada, noticias.vigencia');
        $builder->join('usuarios', 'usuarios.id = noticias.usuario_id');
        $builder->where('noticias.estado', 'borrador');
        $builder->where('noticias.usuario_id', $usuarioId);
        $builder->limit($perPage, ($page - 1) * $perPage);
        $query = $builder->get();
        return $query->getResultArray();
    }
    
    public function countBorradoresPorUsuario($usuarioId)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('noticias');
        $builder->where('noticias.estado', 'borrador');
        $builder->where('noticias.usuario_id', $usuarioId);
        return $builder->countAllResults();
    }
    
    

    public function getBorradorPorId($id)
    {
        return $this->find($id);
    }

    public function countNoticiasParaValidar()
    {
        $estado = 'validar';
        return $this->where('estado', $estado)->countAllResults();
    }
    
    public function countNoticiasParaValidarValidadorEditor()
    {
        $estado = 'validar';
        $user_id = session()->get('user_id');
    
        return $this->where('estado', $estado)
                    ->where('usuario_id !=', $user_id)
                    ->countAllResults();
    }
    
    public function obtenerNoticiasParaValidar($page, $perPage)
    {
        $estado = 'validar';
        $offset = ($page - 1) * $perPage;
        return $this->where('estado', $estado)
                    ->limit($perPage, $offset)
                    ->findAll();
    }
    
    public function obtenerNoticiasParaValidarValidadorEditor($page, $perPage)
    {
        $estado = 'validar';
        $user_id = session()->get('user_id');
        $offset = ($page - 1) * $perPage;
    
        return $this->where('estado', $estado)
                    ->where('usuario_id !=', $user_id)
                    ->limit($perPage, $offset)
                    ->findAll();
    }
    
    
    public function obtenerNoticiaConDetalles($id)
    {
        $query = $this->db->table('noticias')
            ->select('noticias.*, categorias.nombre as nombre_categoria, usuarios.email as nombre_autor')
            ->join('categorias', 'categorias.id = noticias.categoria')
            ->join('usuarios', 'usuarios.id = noticias.usuario_id')
            ->where('noticias.id', $id)
            ->get();
    
        return $query->getRowArray();
    }

    public function getNoticiasPublicadasAutomaticamente() {
        $idUsuario = session()->get('user_id');
    
        $query = $this->db->table('noticias')
            ->select('noticias.*, categorias.nombre as nombre_categoria, usuarios.email as nombre_autor')
            ->join('categorias', 'categorias.id = noticias.categoria')
            ->join('usuarios', 'usuarios.id = noticias.usuario_id')
            ->where('noticias.publicada_automaticamente', 1)
            ->where('noticias.estado', 'publicada')
            ->where('noticias.usuario_id !=', $idUsuario)
            ->get();
    
        return $query->getResultArray();
    }

    public function countNoticiasPublicadasAutomaticamente()
    {
        return $this->where('publicada_automaticamente', 1)
                    ->where('estado', 'publicada')
                    ->where('usuario_id !=', session()->get('user_id'))
                    ->countAllResults();
    }
    

}



