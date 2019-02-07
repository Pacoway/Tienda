<div class="row">
    <?php foreach ($productos as $row) :?>
    <table class="table-borderless col-md-4" >
        <tr><td><img src="<?=base_url().'img/'.$row->imagen?>" alt="" class="img-fluid" style="width: 30%;height: 30%;"><td></tr>
        <tr><td> <?= $row->nombre ?></td></tr>
        <tr><td><?= $row->precio ?></td></tr>
        <tr><td><button>Al carrito</button ></td></tr>
        </table>
    <?php endforeach;?>
</div>
