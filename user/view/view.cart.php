<table class="table table-hover table-bordered">
  <?php if (empty(@$_SESSION["cart"])): ?>
    <h3 class="text-center">Oh.. Kosong ketuk menu untuk menambahkan</h3>
  <?php else: ?>
    <?php foreach (@$_SESSION["cart"] as $menu_id => $quantity): ?>
      <?php
      $sql = "SELECT * From `menu` Where id_menu='$menu_id'";
      $query = mysqli_query($db,$sql);
      $cart = mysqli_fetch_assoc($query);
      $totalcart = $cart['harga_menu']*$quantity;
       ?>
       <tr class="text-dark">
         <td>
           <img src="<?php echo $pictLink."/".$cart['foto_menu']; ?>" class="img-thumbnail" width="240px" height="240px" alt="<?php echo $cart['nama_menu']; ?>">
         </td>
         <td class="bg-info text-white">
           <?php echo $cart['nama_menu']; ?>
         </td>
         <td class="bg-success text-white"><?php echo $quantity; ?> Item</td>
         <td><b>IDR Rp. <?php echo number_format($totalcart,0,'.',','); ?></b></td>
         <td>
           <form class="" action="control/script.cart" method="post">
             <input type="text" hidden name="cart" value="<?php echo encrypt($menu_id); ?>">
             <button type="submit" title="Hapus item" name="delete" class="btn btn-danger"><i class="fas fa-trash"></i> Hapus</button>
           </form>
         </td>
       </tr>
    <?php endforeach; ?>
    <tr>
      <td colspan="5">
        <form class="" action="control/script.reservation" method="post">
          <input type="text" hidden name="user" required value="<?php echo encrypt($_SESSION["id"]); ?>">
          <button type="submit" name="new" class="btn btn-block btn-primary">Buat Reservasi</button>
        </form>
      </td>
    </tr>
  <?php endif; ?>

</table>
