<nav class="navbar navbar-expand-sm bg-dark navbar-dark float-right">
    <ul class="navbar-nav float-right">
        <?php if ($this->session->userdata('usuario_id')) :?>
        <li class="nav-item"> <a class="nav-link" href="<?= site_url().'/PerfilUsuario'?>"> Bienvenido <?= $this->session->nombre ?></a></li>
        <li class="nav-item"> <a class="nav-link" href="<?= site_url().'/InicioSesion/LogOut'?>"> Cerrar Sesión</a></li>
       
              
        <?php else : ?>
        <li class="nav-item"> <a class="nav-link" href="<?= site_url().'/InicioSesion'?>"> Iniciar sesión</a></li>
        <li class="nav-item"> <a class="nav-link" href="<?= site_url().'/RegistroUsuario'?>"> Registrarse</a></li>
        <?php endif; ?>
        <li class="nav-item"> <a class="nav-link" href="<?= site_url().'/Productos/verCarrito'?>"> Carrito</a></li>
    </ul>
</nav>
<nav class="navbar navbar-expand-sm bg-dark navbar-dark">
    <ul class="navbar-nav">
        <li class="nav-item"><a class="nav-link" href="<?= site_url().'/Inicio'?>">Inicio</a></li>
        <li class="nav-item">
                <a class="nav-link dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" ref='<?= base_url(); ?>categorias'>categorias</a>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                    <?php foreach ($categorias as $row) : ?>
                    <a class="dropdown-item" href="<?= site_url().'/Productos/mostrarCategorias/'.$row->categoria_id?>"><?= $row->nombre ?></a> 
                    <?php endforeach; ?>   
                </div>
        </li>
    </ul> 
</nav>
