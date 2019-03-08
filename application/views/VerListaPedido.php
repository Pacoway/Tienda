
<h2>Pedido numero: <?= $numeroPedido?></h2>
<table class="table">
    <tr>
        <td><b>Imágen</b></td>
        <td><b>Nombre</b></td>
        <td><b>Precio</b></td>
        <td><b>Cantidad</b></td>
        <td><b>Subtotal</b></td>
    </tr>
    <?php
        foreach ($pedidos as $row) :?>
        <tr>
        <td><img src="<?=base_url().'img/'.$row->imagen_producto?>"  height="50px" width="50px"></td>
        <td><?= $row->nombre_producto ?></td>
        <td><?= $row->importe ?>€</td>
        <td><?= $row->cantidad ?></td>
        <td><?= $row->cantidad*$row->importe ?>€</td>
        </tr>

    <?php endforeach;?>
    
 </table>

 <a href="<?=site_url().'/Productos/verPedidos/'?>"><button>Volver a lista Pedidos</button></a><br><br>