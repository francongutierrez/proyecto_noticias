<?php

namespace App\Controllers;

use CodeIgniter\HTTP\ResponseInterface;
use App\Models\NoticiasModel;
use App\Models\CambiosModel;
use App\Controllers\BaseController;

class Validar extends BaseController
{
    /**
     * Return an array of resource objects, themselves in array format.
     *
     * @return ResponseInterface
     */
    public function __construct() {
        helper('date_helper');
    }
    public function index()
    {
        if (!session()->has('user_id')) {
            return redirect()->to(base_url('Auth'));
        }
    
        $modelo = new NoticiasModel();
        $pager = \Config\Services::pager();
        
        $page = $this->request->getVar('page') ?? 1;
        $perPage = 10; // Número de noticias por página
    
        $tipoUsuario = session()->get('tipo');
        $vista = 'validar_noticias_vista';
        $totalNoticias = 0;
    
        switch ($tipoUsuario) {
            case 1:
                $vista = 'validador/validar_noticias_vista';
                $validar = $modelo->obtenerNoticiasParaValidar($page, $perPage);
                $totalNoticias = $modelo->countNoticiasParaValidar();
                break;
            case 2:
                $vista = 'validador-editor/validar_noticias_vista';
                $validar = $modelo->obtenerNoticiasParaValidarValidadorEditor($page, $perPage);
                $totalNoticias = $modelo->countNoticiasParaValidarValidadorEditor();
                break;
            default:
                return redirect()->to(base_url('Auth'));
                break;
        }
    
        $data = [
            'validar' => $validar,
            'pager' => $pager->makeLinks($page, $perPage, $totalNoticias),
            'currentPage' => $page,
            'perPage' => $perPage,
            'totalNoticias' => $totalNoticias
        ];
    
        return view($vista, $data);
    }
     

    /**
     * Return the properties of a resource object.
     *
     * @param int|string|null $id
     *
     * @return ResponseInterface
     */
    public function show($id)
    {
        $model = new NoticiasModel();
        $noticia = $model->obtenerNoticiaConDetalles($id);

        $data['noticia'] = $noticia;

        $tipoUsuario = session()->get('tipo');
        $vista = 'validar_noticias_vista';
        if ($noticia) {
            switch ($tipoUsuario) {
                case 1:
                    $vista = 'validador/vista_noticia';
                    break;
                case 2:
                    $vista = 'validador-editor/vista_noticia';
                    break;
                default:
                    // Vista predeterminada si el tipo de usuario no coincide con ningún caso
                    return redirect()->to(base_url('Auth'));
                    break;
            }
    
            return view($vista, $data);    
        }

        if ($noticia) {
            return view('validador/vista_noticia', $data);
        } else {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('La noticia no pudo ser encontrada.');
        }
    }
    

    /**
     * Return a new resource object, with default properties.
     *
     * @return ResponseInterface
     */
    public function new()
    {
        //
    }

    /**
     * Create a new resource object, from "posted" parameters.
     *
     * @return ResponseInterface
     */
    public function create()
    {
        //
    }

    /**
     * Return the editable properties of a resource object.
     *
     * @param int|string|null $id
     *
     * @return ResponseInterface
     */
    public function edit($id = null)
    {
        //
    }

    /**
     * Add or update a model resource, from "posted" properties.
     *
     * @param int|string|null $id
     *
     * @return ResponseInterface
     */
    public function update($id = null)
    {
        //
    }

    /**
     * Delete the designated resource object from the model.
     *
     * @param int|string|null $id
     *
     * @return ResponseInterface
     */
    public function delete($id = null)
    {
        //
    }

    public function crearEventoFinalizacion($id) {
        $db = \Config\Database::connect();
        $nombreEvento = 'finalizar_noticia_'.$id;

        $sql = "
            CREATE EVENT $nombreEvento
            ON SCHEDULE AT CURRENT_TIMESTAMP + INTERVAL 7 DAY
            DO
            BEGIN
                UPDATE noticias
                SET estado = 'finalizada', vigencia = 'desactivada'
                WHERE id = $id AND estado = 'publicada';
        
                -- Insertar registro de cambio
                INSERT INTO cambios (descripcion, relacionado_a, fecha, hora, realizado_por, noticia_id)
                VALUES ('Noticia finalizada automáticamente', 'Noticia', CURDATE(), CURTIME(), 0, $id);
            END;
        ";
    
        $query = $db->query($sql);

        if ($query) {
            return true;
        } else {
            return false;
        }
    }

    public function borrarEventoFinalizacion($id) {
        $db = \Config\Database::connect();
        $nombreEvento = 'finalizar_noticia_'.$id;
        $sql = "DROP EVENT IF EXISTS $nombreEvento";
        $query = $db->query($sql);
        if ($query) {
            return true;
        } else {
            return false;
        }
    }

    protected function registrarCambio($noticiaId, $descripcion)
    {
        // Crea un nuevo registro de cambio en la tabla cambios
        $cambiosModel = new CambiosModel();
        $cambioData = [
            'descripcion' => $descripcion,
            'fecha' => date('Y-m-d'),
            'hora' => date('H:i:s', now()),
            'realizado_por' => session()->get('user_id'), // Suponiendo que tienes una función para obtener el ID del usuario actual
            'noticia_id' => $noticiaId
        ];
        $cambiosModel->insert($cambioData);
    }

    public function checkTipoUsuario() {
        $tipoUsuario = session()->get('tipo');
        $vista = 'cambios_guardados_vista';
        switch ($tipoUsuario) {
            case 1:
                $vista = 'validador/cambios_guardados_vista';
                break;
            case 2:
                $vista = 'validador-editor/cambios_guardados_vista';
                break;
            default:
                return redirect()->to(base_url('Auth'));
                break;
        }
        return $vista;
    }

    public function publicar($id)
    {
        $noticiasModel = new NoticiasModel();
        $noticia = $noticiasModel->find($id);

        session()->set('estado_anterior', $noticia['estado']);
        session()->set('vigencia_anterior', $noticia['vigencia']);
        session()->set('recien_creada_anterior', $noticia['recien_creada']);

        $this->registrarCambio($id, 'Publicada');

        $noticia['estado'] = 'publicada';
        $noticia['vigencia'] = 'activa';
        $noticia['recien_creada'] = 0;

        // Evento que finaliza la noticia luego de 7 dias
        $this->crearEventoFinalizacion($id);

        $noticiasModel->update($id, $noticia);

        $vista = $this->checkTipoUsuario();

        return view($vista, ['id' => $id]);
    }

    public function enviarCorreccion($id)
    {
        $noticiasModel = new NoticiasModel();
        $noticia = $noticiasModel->find($id);

        session()->set('estado_anterior', $noticia['estado']);
        session()->set('vigencia_anterior', $noticia['vigencia']);
        session()->set('recien_creada_anterior', $noticia['recien_creada']);

        $this->registrarCambio($id, 'Enviada a borradores');

        $noticia['estado'] = 'borrador';
        $noticia['vigencia'] = 'activa';
        $noticia['recien_creada'] = 0;

        $noticiasModel->update($id, $noticia);

        $vista = $this->checkTipoUsuario();

        return view($vista, ['id' => $id]);
    }

    public function rechazar($id)
    {
        $noticiasModel = new NoticiasModel();
        $noticia = $noticiasModel->find($id);

        session()->set('estado_anterior', $noticia['estado']);
        session()->set('vigencia_anterior', $noticia['vigencia']);
        session()->set('recien_creada_anterior', $noticia['recien_creada']);

        $this->registrarCambio($id, 'Rechazada');
        
        $noticia['estado'] = 'rechazada';
        $noticia['vigencia'] = 'desactiva';
        $noticia['recien_creada'] = 0;

        $noticiasModel->update($id, $noticia);

        $vista = $this->checkTipoUsuario();

        return view($vista, ['id' => $id]);
    }

    public function deshacer($id)
    {
        $noticiasModel = new NoticiasModel();
        $noticia = $noticiasModel->find($id);
        $estadoAnterior = session()->get('estado_anterior');
        $vigenciaAnterior = session()->get('vigencia_anterior');
        $recienCreadaAnterior = session()->get('recien_creada_anterior');

        if ($estadoAnterior !== null && $vigenciaAnterior !== null) {
            $noticia['estado'] = $estadoAnterior;
            $noticia['vigencia'] = $vigenciaAnterior;
            $noticia['recien_creada'] = $recienCreadaAnterior;
            $noticiasModel->update($id, $noticia);

            $cambiosModel = new CambiosModel();

            $ultimoCambio = $cambiosModel->where('noticia_id', $id)->orderBy('fecha', 'DESC')->orderBy('hora', 'DESC')->first();

            if ($ultimoCambio) {
                $cambiosModel->delete($ultimoCambio['id']);
                $this->borrarEventoFinalizacion($id); // Evento que borra el evento anteriormente creado
            }

            $vista = $this->checkTipoUsuario();

            return view($vista, ['id' => $id]);
        } else {
            return redirect()->back()->with('error', 'No se encontró un estado anterior para deshacer');
        }
    }
}
