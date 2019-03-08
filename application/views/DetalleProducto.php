<h2>Detalles del producto</h2>

<div class="row ">
<?php echo form_open('Productos/addProducto/'.$productos->producto_id.'/True'); ?>
    <table class="table col-md-8" >      
        <tr><td><img src="<?=base_url().'img/'.$productos->imagen?>" alt="" class="img-fluid" style="width: 200px;height: 200px;"><td></tr>

        <tr><td>precio</td><td> <?= $productos->precio.'€' ?></td></tr>
        <tr><td>descuento</td><td> <?= $productos->descuento ?>%</td></tr>
        <tr><td>descripcion</td><td> <?= $productos->descripcion ?></td></tr>
        <tr><td>stock</td><td> <?= $productos->stock ?></td></tr>
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