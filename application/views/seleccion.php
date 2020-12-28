<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
        integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

    <!-- Ajax-Jquery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <!-- Tempus Dominus (Calendario)-->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/moment.min.js"></script>
    <script
        src="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.1.2/js/tempusdominus-bootstrap-4.min.js"
        integrity="sha512-2JBCbWoMJPH+Uj7Wq5OLub8E5edWHlTM4ar/YJkZh3plwB2INhhOC3eDoqHm1Za/ZOSksrLlURLoyXVdfQXqwg=="
        crossorigin="anonymous"></script>
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.1.2/css/tempusdominus-bootstrap-4.min.css"
        integrity="sha512-PMjWzHVtwxdq7m7GIxBot5vdxUY+5aKP9wpKtvnNBZrVv1srI8tU6xvFMzG8crLNcMj/8Xl/WWmo/oAP/40p1g=="
        crossorigin="anonymous" />
    
    <title>Norma</title>
</head>

<body>

<pre><?php //print_r($tiponorma); ?></pre>
    <div class="container bg-warning">
        <a href="https://abm-norma.concejosantotome.gob.ar/index.php/abmnorma">Volver al inicio de Carga</a>
        <?php //echo validation_errors(); ?>
        <h3 class="text-white text-center">~ Formulario de Norma ~</h3>
        <!--<form action="<?php //base_url() ?>Norma_controller/crea_norma" method="post">-->
        <?php echo form_open_multipart('Norma_controller/buscar/',array("class"=>"form-group")); ?>
            <div class="row">
                <div class="form-group col-sm-6">
                    <input type="number" class="form-control" name="numnorma" placeholder="N° Norma" value="">
                    <small
                        class="form-text"><?php echo form_error('numnorma', '<div class="text-danger">', '</div>'); ?></small>
                </div>
                <div class="form-group col-sm-6">
                    <select class="form-control" name="tiponorma">
                        <option>Seleccionar Tipo de Norma</option>
                        <?php 
                    foreach ($tiponorma as $row) {
                        echo '<option value= "' . $row->codigo . '" >' . $row->nombre . '</option>';
                    }
                    ?>
                    </select>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-4 col-sm-8">
                        <button type="submit" class="btn btn-info">Buscar</button>
                </div>
            </div>
        <?php echo form_close(); ?>
    </div>

    <?php
	    if(isset($listaNormas)) {
            foreach ($listaNormas as $row) {
    ?>

        <div class="container bg-warning">
        <?php //echo validation_errors(); ?>
        <h3 class="text-white text-center">Está Modificando la Norma <?php echo $row->numero; ?> </h3>
        <!--<form action="<?php //base_url() ?>Norma_controller/crea_norma" method="post">-->
        <?php echo form_open_multipart('Norma_controller/guarda_norma/',array("class"=>"form-group")); ?>
            <div class="row">
                <div class="form-group col-sm-6">
                    <input hidden type="number" class="form-control" name="numnorma" placeholder="N° Norma" value="<?php echo ($this->input->post('numero') ? $this->input->post('numero') : $row->numero); ?>">
                    <small
                        class="form-text"><?php echo form_error('numnorma', '<div class="text-danger">', '</div>'); ?></small>
                </div>
                <div class="form-group col-sm-6">
                    <select hidden class="form-control" name="tiponorma" value="<?php echo ($this->input->post('tipo') ? $this->input->post('tipo') : $row->tipo); ?>">>
                        <option value="<?php echo ($this->input->post('tipo') ? $this->input->post('tipo') : $row->tipo); ?>"><?php echo ($this->input->post('tipo') ? $this->input->post('tipo') : $row->tipo); ?></option>
                        <?php 
                    ?>
                    </select>
                </div>
                <div class="form-group col-sm-6">
                    <label>Expediente CHM</label>
                    <input type="text" class="form-control" name="expedientechm" placeholder="Expediente HCM" value="<?php echo ($this->input->post('expedientechm') ? $this->input->post('expedientechm') : $row->expedientechm); ?>">
                    <small
                        class="form-text"><?php echo form_error('expedientechm', '<div class="text-danger">', '</div>'); ?></small>
                </div>
                <div class="form-group col-sm-6">
                    <label>Expediente DEM</label>
                    <input type="text" class="form-control" name="expedientedem" placeholder="Expediente DEM" value="<?php echo ($this->input->post('expedientedem') ? $this->input->post('expedientedem') : $row->expedientedem); ?>">
                    <small
                        class="form-text"><?php echo form_error('expedientedem', '<div class="text-danger">', '</div>'); ?></small>
                </div>
            </div>
            <br>

            <div class="row">
                <div class="form-group col-sm-6">
                    <?php
                        $inicio1 = strtotime($row->fechasancion);
                        $fff1 = date('d-m-Y',$inicio1);
                    ?>
                    <label>Fecha de Sanción</label>
                    <input type=" text" class="form-control" name="fechasancion" placeholder="Fecha de Sancion" value="<?php echo $fff1; ?> ">
                    <small
                        class="form-text"><?php echo form_error('fechasancion', '<div class="text-danger">', '</div>'); ?></small>
                    
                </div>
                <div class="form-group col-sm-6">
                    <?php
                        $inicio2 = strtotime($row->fechapromulgacion);
                        $fff2 = date('d-m-Y',$inicio2);
                    ?>
                    <label>Fecha de Promulgación</label>
                    <input type=" text" class="form-control" name="fechapromulgacion" placeholder="Fecha de Promulgacion" value="<?php echo $fff2; ?>">
                    <small
                        class="form-text"><?php echo form_error('fechapromulgacion', '<div class="text-danger">', '</div>'); ?></small>
                    

                </div>
                <div class="form-group col-sm-6">
                    <label>Origen</label>
                    <input type="text" class="form-control" name="origen" placeholder="Origen" value="<?php echo ($this->input->post('origen') ? $this->input->post('origen') : $row->origen); ?>">
                    <small
                        class="form-text"><?php echo form_error('origen', '<div class="text-danger">', '</div>'); ?></small>
                </div>
                <div class="form-group col-sm-6">
                    <label>Autor</label>
                    <input type=" text" class="form-control" name="autor" placeholder="Autor" value="<?php echo ($this->input->post('autor') ? $this->input->post('autor') : $row->autor); ?>">
                    <small
                        class="form-text"><?php echo form_error('autor', '<div class="text-danger">', '</div>'); ?></small>
                </div>
                <div class="form-group col-sm-6">
                    Caracter
                    <select class="form-control" name="caracter" placeholder="Caracter">
                        <option value= "<?php echo ($this->input->post('caracter') ? $this->input->post('caracter') : $row->caracter); ?>" ><?php echo ($this->input->post('caracter') ? $this->input->post('caracter') : $row->caracter); ?></option>
                        <option value= "PERMANENTE" >PERMANENTE</option>
                        <option value= "TRANSITORIA" >TRANSITORIA</option>
                    </select>
                    <small
                        class="form-text"><?php echo form_error('caracter', '<div class="text-danger">', '</div>'); ?></small>
                </div>
                <div class="form-group col-sm-6">
                    Alcance:
                    <select class="form-control" name="alcance" placeholder="Alcance">
                        <option value= "<?php echo ($this->input->post('alcance') ? $this->input->post('alcance') : $row->alcance); ?>" ><?php echo ($this->input->post('alcance') ? $this->input->post('alcance') : $row->alcance); ?></option>
                        <option value= "PERMANENTE" >PERMANENTE</option>
                        <option value= "TEMPORAL" >TEMPORAL</option>
                        
                    </select>
                    <small
                        class="form-text"><?php echo form_error('alcance', '<div class="text-danger">', '</div>'); ?></small>
                </div>
                <div class="form-group col-sm-6">
                    <label>Nro de Caja</label>
                    <input type="number" class="form-control" name="nrocaja" placeholder="Caja" value="<?php echo ($this->input->post('nrocaja') ? $this->input->post('nrocaja') : $row->nrocaja); ?>">
                    <small
                        class="form-text"><?php echo form_error('nrocaja', '<div class="text-danger">', '</div>'); ?></small>
                </div>
                <div class="form-group col-sm-6">
                    <label>Nº de Orden</label>
                    <input type="text" class="form-control" name="nroorden" placeholder="N° Orden" value="<?php echo ($this->input->post('nroorden') ? $this->input->post('nroorden') : $row->nroorden); ?>">
                    <small
                        class="form-text"><?php echo form_error('nroorden', '<div class="text-danger">', '</div>'); ?></small>
                </div>
            </div>

            <div class="form-group">
                <label>Observaciones</label>
                <textarea class="form-control" name="observaciones" placeholder="Observaciones" rows="3"><?php echo ($this->input->post('observaciones') ? $this->input->post('observaciones') : $row->observaciones); ?></textarea>
                <small
                    class="form-text"><?php echo form_error('observaciones', '<div class="text-danger">', '</div>'); ?></small>
            </div>

            <div class="form-group">
                 <label>Contenido</label>
                <textarea class="form-control" name="contenido" placeholder="Contenido" rows="3"><?php echo ($this->input->post('contenido') ? $this->input->post('contenido') : $row->contenido); ?></textarea>
                <small
                    class="form-text"><?php echo form_error('contenido', '<div class="text-danger">', '</div>'); ?></small>
            </div>

            <div class="form-group">
            	Archivo:
                <input id="archivo" name="archivo" type="file" placeholder="Archivo" class="form-control" value="<?php echo ($this->input->post('archivo') ? $this->input->post('archivo') : $row->archivo); ?>">
                <?php echo form_error('archivo'); ?>
                <input id="archivo1" name="archivo1" type="text" placeholder="Archivo" class="form-control" value="<?php echo ($this->input->post('archivo') ? $this->input->post('archivo') : $row->archivo); ?>">
            </div>
            <div class="form-group">
            	Archivo Ordenado:
                <input id="archivoord" name="archivoord" type="file" placeholder="Archivo Ordenanza" class="form-control" value="<?php echo ($this->input->post('archivoord') ? $this->input->post('archivoord') : $row->archivoord); ?>">
                <?php echo form_error('archivoord'); ?>
                <input id="archivoord" name="archivoord1" type="text" placeholder="Archivo Ordenanza" class="form-control" value="<?php echo ($this->input->post('archivoord') ? $this->input->post('archivoord') : $row->archivoord); ?>">
            </div>

            <button type="submit" class="btn btn-primary">Guardar Cambios</button>
        <!--</form>-->
        <?php echo form_close(); ?>
    </div>


    <script>
    $("#tematican1").change(function() {
        var idtematican1 = $(this).children("option:selected").val();
        $.ajax({
            url: "https://abm-norma.concejosantotome.gob.ar/index.php/Norma_controller/get_tematican2",
            method: 'post',
            data: {
                idtematican1: idtematican1
            },
            dataType: 'json',
            error: function() {
                alert('error');
            },
            success: function(data) {
                //console.log(data);
                $('#tematican2').empty();
                for (i of data) {
                    //console.log(i.indice2 + ' ' + i.descripcion2);
                    $('#tematican2').prepend('<option value="' + i.indice2 + '" >' + i
                        .descripcion2 + '</option>');
                }
                $('#tematican2').prepend(
                    '<option selected>Seleccionar Tematica de Nivel 2</option>');
            }
        });
    });
    </script>

<?php
        };
    };
?>