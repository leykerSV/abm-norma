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
        <?php //echo validation_errors(); ?>
        <h3 class="text-white text-center">~ Formulario de Norma ~</h3>
        <!--<form action="<?php //base_url() ?>Norma_controller/crea_norma" method="post">-->
        <?php echo form_open_multipart('Norma_controller/edit_norma/',array("class"=>"form-group")); ?>
            <div class="row">
                <div class="form-group col-sm-6">
                    <input type="number" class="form-control" name="numnorma" placeholder="N° Norma">
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
                <div class="form-group col-sm-6">
                    <input type="text" class="form-control" name="expedientechm" placeholder="Expediente HCM">
                    <small
                        class="form-text"><?php echo form_error('expedientechm', '<div class="text-danger">', '</div>'); ?></small>
                </div>
                <div class="form-group col-sm-6">
                    <input type="text" class="form-control" name="expedientedem" placeholder="Expediente DEM">
                    <small
                        class="form-text"><?php echo form_error('expedientedem', '<div class="text-danger">', '</div>'); ?></small>
                </div>
            </div>
            <br>

            <div class="form-group">
                <select class="form-control" id="tematican1" name="tematican1">
                    <option>Seleccionar Tematica de Nivel 1</option>
                    <?php 
                    foreach ($tematican1 as $row) {
                        echo '<option value= "' . $row->indice1 . '" >' . $row->descripcion1 . '</option>';
                    }
                    ?>
                </select>
                <small
                    class="form-text text-danger"><?php echo form_error('tematican1', '<div class="text-danger">', '</div>'); ?></small>
            </div>
            <div class="form-group">
                <select class="form-control" id="tematican2" name="tematican2">
                    <option>Seleccionar Tematica de Nivel 2</option>
                </select>
                <small
                    class="form-text"><?php echo form_error('tematican2', '<div class="text-danger">', '</div>'); ?></small>
            </div>
            <br>

            <div class="row">
                <div class="form-group col-sm-6">
                    <input type="date" class="form-control" name="fechasancion" placeholder="Fecha de Sancion">
                    <small
                        class="form-text"><?php echo form_error('fechasancion', '<div class="text-danger">', '</div>'); ?></small>
                    
                </div>
                <div class="form-group col-sm-6">
                    <input type="date" class="form-control" name="fechapromulgacion" placeholder="Fecha de Promulgacion">
                    <small
                        class="form-text"><?php echo form_error('fechapromulgacion', '<div class="text-danger">', '</div>'); ?></small>
                    

                </div>
                <div class="form-group col-sm-6">
                    <input type=" text" class="form-control" name="origen" placeholder="Origen">
                    <small
                        class="form-text"><?php echo form_error('origen', '<div class="text-danger">', '</div>'); ?></small>
                </div>
                <div class="form-group col-sm-6">
                    <input type=" text" class="form-control" name="autor" placeholder="Autor">
                    <small
                        class="form-text"><?php echo form_error('autor', '<div class="text-danger">', '</div>'); ?></small>
                </div>
                <div class="form-group col-sm-6">
                    Caracter
                    <select class="form-control" name="caracter" placeholder="Caracter">
                        <option value= "" ></option>
                        <option value= "PERMANENTE" >PERMANENTE</option>
                        <option value= "TRANSITORIA" >TRANSITORIA</option>
                    </select>
                    <small
                        class="form-text"><?php echo form_error('caracter', '<div class="text-danger">', '</div>'); ?></small>
                </div>
                <div class="form-group col-sm-6">
                    Alcance:
                    <select class="form-control" name="alcance" placeholder="Alcance">
                        <option value= "" ></option>
                        <option value= "PERMANENTE" >PERMANENTE</option>
                        <option value= "TEMPORAL" >TEMPORAL</option>
                    </select>
                    <small
                        class="form-text"><?php echo form_error('alcance', '<div class="text-danger">', '</div>'); ?></small>
                </div>
                <div class="form-group col-sm-6">
                    <input type="number" class="form-control" name="nrocaja" placeholder="Caja">
                    <small
                        class="form-text"><?php echo form_error('nrocaja', '<div class="text-danger">', '</div>'); ?></small>
                </div>
                <div class="form-group col-sm-6">
                    <input type="text" class="form-control" name="nroorden" placeholder="N° Orden">
                    <small
                        class="form-text"><?php echo form_error('nroorden', '<div class="text-danger">', '</div>'); ?></small>
                </div>
            </div>

            <div class="form-group">
                <textarea class="form-control" name="observaciones" placeholder="Observaciones" rows="3"></textarea>
                <small
                    class="form-text"><?php echo form_error('observaciones', '<div class="text-danger">', '</div>'); ?></small>
            </div>

            <div class="form-group">
                <textarea class="form-control" name="contenido" placeholder="Contenido" rows="3"></textarea>
                <small
                    class="form-text"><?php echo form_error('contenido', '<div class="text-danger">', '</div>'); ?></small>
            </div>

            <div class="form-group">
            	Archivo:
                <input id="archivo" name="archivo" type="file" placeholder="Archivo" class="form-control">
                <?php echo form_error('archivo'); ?>
            </div>
            <div class="form-group">
            	Archivo Ordenado:
                <input id="archivoord" name="archivoord" type="file" placeholder="Archivo Ordenanza" class="form-control">
                <?php echo form_error('archivoord'); ?>
            </div>

            <button type="submit" class="btn btn-primary">Crear Norma</button>
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
</body>

</html>
