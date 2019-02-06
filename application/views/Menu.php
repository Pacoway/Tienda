<nav class="navbar navbar-expand-sm bg-dark navbar-dark">
    <ul class="navbar-nav">
        <li class="nav-item"><span class="nav-link"><?php echo anchor('Inicio', 'Inicio'); ?></span></li>
        <li class="nav-item">
                <a class="nav-link dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" ref='<?= base_url(); ?>categorias'>categorias</a>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                    <?php foreach ($categorias as $row) : /* Revisar*/ ?>
                    <a class="dropdown-item" href="<?= site_url('/productos/mostrarCategorias/{$row->id}')?>"><?= $row->nombre ?></a> 
                    <?php endforeach; ?>   
                </div>
        </li>
       
    </ul>
</nav>