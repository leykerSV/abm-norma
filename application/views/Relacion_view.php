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
    
    <title>Relacion</title>
</head>

<body>
    <pre><?php //print_r($tiponorma); ?></pre>
    <div class="container bg-info">
        <?php //echo validation_errors(); ?>
        <h3 class="text-white text-center">~ Formulario de Relacion ~</h3>
        <!--<form action="<?php //base_url() ?>Norma_controller/crea_norma" method="post">-->
        <?php echo form_open_multipart('Relacion_controller/crea_relacion/',array("class"=>"form-group")); ?>
            <div class="row">
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
                    <input type="number" class="form-control" name="nronorma" placeholder="N° Norma">
                    <small
                        class="form-text"><?php echo form_error('nronorma', '<div class="text-danger">', '</div>'); ?></small>
                </div>
            </div>
            <br>

            <div class="form-group">
                <select class="form-control" id="relacion" name="relacion">
                    <option>Tipo de Relacion</option>
                    <?php 
                    foreach ($relaciones as $row) {
                        echo '<option value= "' . $row->codigo . '" >' . $row->relacion . '</option>';
                    }
                    ?>
                </select>
                <small
                    class="form-text text-danger"><?php echo form_error('tiporelacion', '<div class="text-danger">', '</div>'); ?></small>
            </div>
            <br>
            <div class="row">
                <div class="form-group col-sm-6">
                    <select class="form-control" name="tiponormar">
                        <option>Seleccionar Tipo de Norma</option>
                        <?php 
                    foreach ($tiponorma as $row) {
                        echo '<option value= "' . $row->codigo . '" >' . $row->nombre . '</option>';
                    }
                    ?>
                    </select>
                </div>
                <div class="form-group col-sm-6">
                    <input type="number" class="form-control" name="nronormar" placeholder="N° Norma">
                    <small
                        class="form-text"><?php echo form_error('nronormar', '<div class="text-danger">', '</div>'); ?></small>
                </div>
            </div>
            <br>

            <div class="row">
                <div class="form-group col-sm-6">
                    <input type=" text" class="form-control" name="fecha" placeholder="Fecha">
                    <small
                        class="form-text"><?php echo form_error('fecha', '<div class="text-danger">', '</div>'); ?></small>
                    
                </div>
                <div class="form-group col-sm-6">
                    <input type=" text" class="form-control" name="observacion" placeholder="Observaciones">
                    <small
                        class="form-text"><?php echo form_error('observacion', '<div class="text-danger">', '</div>'); ?></small>
                    

                </div>
                
            </div>
            <button type="submit" class="btn btn-secondary">Crear Relacion</button>
        <!--</form>-->
        <?php echo form_close(); ?>
    </div>



</body>

</html>
