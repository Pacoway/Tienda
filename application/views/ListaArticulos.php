<?php foreach ($productos as $row) :?>
          <td><img src="<?=base_url().'/img/' . $row->imagen ?>" alt="" class="img-fluid" height="100" width="100"></td></tr>
          <tr><td> <?= $row->nombre ?></td></tr>
          <tr><td><?= $row->precio ?></td></tr>
          <tr><td><button>Al carrito</button ></td></tr></div>
        <?php endforeach;?>