<?php

namespace App\Models;

use CodeIgniter\Model;

class CambiosModel extends Model
{
    protected $table            = 'cambios';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['descripcion', 'fecha', 'hora', 'realizado_por', 'noticia_id'];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    protected array $casts = [];
    protected array $castHandlers = [];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];


    public function obtenerCambiosConNoticiasYUsuarios($perPage, $offset)
    {
        return $this->db->table('cambios')
            ->select('cambios.descripcion, cambios.fecha, cambios.hora, 
                      IF(cambios.realizado_por = 0, "Sistema", usuarios.email) AS email_realizador, 
                      noticias.titulo')
            ->join('noticias', 'noticias.id = cambios.noticia_id')
            ->join('usuarios', 'usuarios.id = cambios.realizado_por')
            ->orderBy('cambios.fecha', 'DESC')
            ->orderBy('cambios.hora', 'DESC')
            ->limit($perPage, $offset)
            ->get()
            ->getResultArray();
    }
    
    

    public function borrarUltimoCambio($noticia_id) {
        $ultimo_cambio = $this->db->table('cambios')
                            ->where('noticia_id', $noticia_id)
                            ->orderBy('fecha', 'DESC')
                            ->get()
                            ->getRow(); 
    
        if ($ultimo_cambio) {
            $this->db->table('cambios')->where('id', $ultimo_cambio->id)->delete();
        }
    }
}
