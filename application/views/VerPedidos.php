
<table class="table col-md-6">
<tr>
    <td>Pedido_ID</td>
    <td>Estado del pedido</td>
    <td>Importe del pedido</td>
</tr>
<?php 
$this->load->model("Model_productos");

foreach ($pedidos as $row) {
    echo "<tr><td>".$row->pedido_id."</td><td>".$this->Model_productos->aclaraEstado($row->estado)."</td><td>".$row->importe."€</td><td><a href='".site_url()."/Productos/verListaPedido/".$row->pedido_id."'>Ver Pedido</a></td></tr>";
}
?>
</table>