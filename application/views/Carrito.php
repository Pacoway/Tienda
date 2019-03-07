
  <table class="table table-bordered">
        <tr>
            <td colspan="6"><h4>Aquí están sus productos seleccionados.</h4></td>
            <td><a href="<?= site_url() . '/Productos/vaciarCarrito/' ?>">Vaciar Carrito</a></td>
        </tr>
        <tr>
            <td><b>Imágen</b></td>
            <td><b>Nombre</b></td>
            <td><b>Descuento</b></td>
            <td><b>Cantidad</b></td>
            <td><b>precio</b></td>
            <td><b>Subtotal</b></td>
            <td><b>Quitar</b> &nbsp<i class="fas fa-times"></i></td>
        </tr>

            <?php 
            foreach ($productosCarrito as $row) :?>
            <tr>
            <td><img src="<?=base_url().'img/'.$row['imagen']?>"  height="50px" width="50px"></td>
            <td><b><?= $row['name'] ?></b></td>
            <td><b><?= $row['descuento'] ?>%</b></td>
            <td><b><?= $row['qty']?></b></td>
            <td><b><?= $row['price'] ?>€</b></td>
            <td><b><?= ($row['price'] )*$row['qty'] ?>€</b></td>
            <td><a href="<?= site_url().'/Productos/eliminarProducto/'.$row['rowid']?>"><b>Quitar</b> &nbsp<i class="fas fa-times"></i></a></td>
        </tr>
        <?php endforeach;?>
</table>
        <a class="btn btn-info" href="<?=site_url().'/Productos/tramitarPedido'?>">Al carrito</a>
