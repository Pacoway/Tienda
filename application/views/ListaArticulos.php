<div class="row">
    <?php foreach ($productos as $row) :?>
    <tr class="row">
        <td><img src="<?=base_url().'img/portatilroto.jpg'?>" alt="" class="img-fluid mr-3" height="211" width="100"></td><br>
        <td> <?= $row->nombre ?><br>
        <td><?= $row->precio ?></td><br>
        <td><button>Al carrito</button ></td>
    </tr>
    <?php endforeach;?>
</div>
