<?php echo validation_errors(); ?>
<?php echo form_open('formulario'); ?>
<h5>Usuario</h5>
<input type="text" name="username" value="" size="50" />
<h5>Contraseña</h5>
<input type="text" name="password" value="" size="50" />
<h5>Confirmar contraseña</h5>
<input type="text" name="passconf" value="" size="50" />
<h5>Email</h5>
<input type="text" name="email" value="" size="50" />
<div><input type="submit" value="Enviar" /></div>
</form>
