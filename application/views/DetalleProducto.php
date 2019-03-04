<h2>Detalles del producto</h2>

<div class="row ">
<?php echo form_open('Productos/addProducto/'.$productos->producto_id.'/True'); ?>
    <table class="table" >      
        <tr><td><img src="<?=base_url().'img/'.$productos->imagen?>" alt="" class="img-fluid" style="width: 50%;height: 50%;"><td></tr>
        <tr><td>producto_id</td><td> <?= $productos->producto_id ?></td></tr> 
        <tr><td>precio</td><td> <?= $productos->precio.'€' ?></td></tr>
        <tr><td>descuento</td><td> <?= $productos->descuento ?></td></tr>
        <tr><td>iva</td><td> <?= $productos->iva ?></td></tr>
        <tr><td>descripcion</td><td> <?= $productos->descripcion ?></td></tr>
        <tr><td>anuncio</td><td> <?= ($productos->anuncio) ? $row->anuncio : 'Sin anuncios' ?></td></tr>
        <tr><td>stock</td><td> <?= $productos->stock ?></td></tr>
        <tr><td>visible</td><td> <?= ($productos->visible) ? 'Si' : 'No' ?></td></tr>
        <tr><td>destacado</td><td> <?= ($productos->destacado) ? 'Si' : 'No' ?></td></tr>
        <tr><td>Cantidad a comprar</td><td>
        <select name="cantidad" >
        <?php 
        
    for ($i=1; $i <=$productos->stock ; $i++) { 
        echo '<option>'.$i.'</option>';
    }
        ?>
        </select>
        </td></tr>
        <tr><td><input class="btn btn-info" type="submit" value="Añadir al carrito"/></td></tr>

       </table>

    </form>
    
</div>
<a class="float-left" href="<?= site_url().'/Productos/mostrarCategorias/'.$productos->categoria_id?>"><button>Volver a la categoria</button></a>