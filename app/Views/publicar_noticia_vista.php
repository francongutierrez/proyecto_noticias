<?= $this->extend('template') ?>

<?= $this->section('content') ?>

<div class="container">
            <div class="row">
                <div class="col">
                    <?php if(session()->getFlashdata('error') != null) { ?>
                            <div class='alert alert-danger'>
                                <?= session()->getFlashdata('error') ?>
                            </div>
                    <?php }?>
                    <?php


                        $categoriasDropdown = array();

                        $categoriasDropdown[] = 'Seleccione una opción';

                        foreach ($categorias as $index => $categoria) {
                            $categoriasDropdown[$index + 1] = $categoria['nombre'];
                        }


                        echo form_open(base_url('PublicarNoticia')); 
                        echo form_label('Título:', 'título', array('class'=>'form-label mt-3')) . '<br>';
                        echo form_input(array('name'=>'titulo', 'class'=>'form-control'), set_value('titulo')) . '<br>';
                        echo form_label('Descripción:', 'descripcion', array('class'=>'form-label mt-3')) . '<br>';
                        echo form_textarea(array('name'=>'descripcion', 'class'=>'form-control'), set_value('descripcion')) . '<br>';
                        echo form_label('Categoria:', 'categoria', array('class'=>'form-label mt-3')) . '<br>';
                        echo form_dropdown('categoria', $categoriasDropdown, '', 'class="form-control"') . '<br>';
                        echo form_label('Fecha:', 'fecha', array('class'=>'form-label mt-3')) . '<br>';
                        echo form_input(array('name'=>'fecha', 'type'=>'date', 'class'=>'form-control'), set_value('fecha')) . '<br>';
                        echo form_submit('enviar','Enviar', 'class="btn btn-primary mt-3 mb-3"');
                        echo form_close();
                    ?>
                </div>
            </div>
        </div>

<?= $this->endSection('content') ?>