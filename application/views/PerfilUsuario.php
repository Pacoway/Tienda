<h2>Perfil de usuario</h2><br>

<?= (isset($msg))? '<h4>'.$msg.'</h4>' : '' ?>

    <h4>Modificar datos personales</h4>
        <?php echo validation_errors(); ?>
        <?php echo form_open('PerfilUsuario/ModificarDatos'); ?>

            <h5>Nombre</h5>
            <input type="text" name="nombre" value="<?= $usuario->nombre?>" size="50" />
            <h5>Apellidos</h5>
            <input type="text" name="apellidos" value="<?= $usuario->apellidos ?>" size="50" />
            <h5>Direccion</h5>
            <input type="text" name="direccion" value="<?= $usuario->direccion ?>" size="50" />

            <div><input type="submit" value="Modificar Datos" /></div>
        </form>
        <br>
    <h4>Modificar contraseña</h4>
        <?php echo validation_errors(); ?>
        <?php echo form_open('PerfilUsuario/CambiarContrasena'); ?>

            <h5>Contraseña actual</h5>
            <input type="text" name="contraseñaActual" value="" size="50" />
            <h5>Nueva Contraseña</h5>
            <input type="text" name="contraseña" value="" size="50" />
            <div><input type="submit" value="Cambiar Contraseña" /></div>
        </form>
        <br>
    <h4>Dar usuario de baja</h4>
    <?php echo form_open('PerfilUsuario/darDeBaja'); ?>
            <div><input type="submit" value="Dar de baja" /></div>
        </form>