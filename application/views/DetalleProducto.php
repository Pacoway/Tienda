<h2>Detalles del producto</h2>
<div class="row">
    <?php foreach ($productos as $row) :?>
    <table class="table col-md-10" >      
        <tr><td><img src="<?=base_url().'img/'.$row->imagen?>" alt="" class="img-fluid" style="width: 50%;height: 50%;"><td></tr>
        <tr><td>producto_id</td><td> <?= $row->producto_id ?></td></tr> 
        <tr><td>precio</td><td> <?= $row->precio.'€' ?></td></tr>
        <tr><td>descuento</td><td> <?= $row->descuento ?></td></tr>
        <tr><td>iva</td><td> <?= $row->iva ?></td></tr>
        <tr><td>descripcion</td><td> <?= $row->descripcion ?></td></tr>
        <tr><td>anuncio</td><td> <?= ($row->anuncio) ? $row->anuncio : 'Sin anuncios' ?></td></tr>
        <tr><td>stock</td><td> <?= $row->stock ?></td></tr>
        <tr><td>visible</td><td> <?= ($row->visible) ? 'Si' : 'No' ?></td></tr>
        <tr><td>destacado</td><td> <?= ($row->destacado) ? 'Si' : 'No' ?></td></tr>
        <tr><td>fecha_inicio_destacado</td><td> <?= $row->fecha_inicio_destacado ?></td></tr>
        <tr><td>fecha_fin_destacado</td><td><?= $row->fecha_fin_destacado ?></td></tr>
        <tr><td><a href="<?= site_url().'/Productos/mostrarCategorias/'.$row->categoria_id?>"><button>Volver atras</button ></a></td><td><button>Al carrito</button ></td></tr>
        </table>
    <?php endforeach;?>
    
</div>