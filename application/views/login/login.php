Concejo%2020AbM
<div class="container">
  <div class="frame">

		<?php
              $success_msg= $this->session->flashdata('success_msg');
              $error_msg= $this->session->flashdata('error_msg');

                  if($success_msg){
                    ?>
                    <div class="alert alert-success">
                      <?php echo $success_msg; ?>
                    </div>
                  <?php
                  }
                  if($error_msg){
                    ?>
                    <div class="alert alert-danger">
                      <?php echo $error_msg; ?>
                    </div>
                    <?php
                  }
                  ?>
    <div ng-app ng-init="checked = false">
				  <?php echo form_open('inicio/verifylogin', 'class="form-signin"'); ?>
						<label for="username">Usuario</label>
						<input class="form-styling" type="text" name="username" id="username" placeholder=""/>
						<label for="password">Contraseña</label>
						<input class="form-styling" type="password" name="password" id="password" placeholder=""/>
						<input type="checkbox" id="checkbox"/>
						<label for="checkbox" ><span class="ui"></span>Mantener logueado?</label>
						<div class="btn-animate">
							<button class="btn-signin" type="submit">Ingresar</button>
						</div>
					<?php echo form_close(); ?>
		</div>
</div>

        
				        