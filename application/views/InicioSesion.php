<div class="justify-content-center">
<?php echo validation_errors(); ?>
<?= (isset($error))? $error:''; ?>
<?php echo form_open('InicioSesion/LogIn'); ?>
<h2>Iniciar sesión</h2>
<h5>Usuario</h5>
<input type="text" name="usuario" value="" size="50" />
<h5>Contraseña</h5>
<input type="text" name="contrasena" value="" size="50" />

<div><input type="submit" value="Iniciar sesion" /></div>
</form>
</div>