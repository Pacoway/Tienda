<div class="row">
    <?php foreach ($productos as $row) :?>
    <table class="table-borderless col-md-4" >
        <tr><td><a href="<?= site_url().'/Productos/muestraDetalles/'.$row->producto_id ?>"><img src="<?=base_url().'img/'.$row->imagen?>" alt="" class="img-fluid" style="width: 30%;height: 30%;"></a><td></tr>
        <tr><td> <?= $row->nombre ?></td></tr>
        <tr><td><?= $row->precio ?></td></tr>
        <tr><td><button>Al carrito</button ></td></tr>
        </table>
    <?php endforeach;?>
    
</div>
