<?php echo form_open('user/cambiapass',array("class"=>"form-horizontal")); ?>

		<label for="fechaEntrega" class="col-md-4 control-label">Nuevo Password</label>
		<div class="col-md-8">
			<input type="text" name="password" value="" class="form-control" id="password" />
		</div>
		<label for="fechaEntrega" class="col-md-4 control-label">Reingrese su Password</label>
		<div class="col-md-8">
			<input type="text" name="password1" value="" class="form-control" id="password1" />
		</div>
		<div class="form-group">
			<div class="col-sm-offset-4 col-sm-8">
				<button type="submit" class="btn btn-success">Cambiar Password</button>
			</div>
		</div>
		
<?php echo form_close(); ?>