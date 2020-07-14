<div class="table-responsive">
  <table id="Admin_table" class="table table-bordered">
    <thead>
      <th>NO</th>
      <th>Foto</th>
      <th>Nama Menu</th>
      <th>Kategori</th>
      <th>Harga</th>
      <th>Ketersediaan</th>
      <th>Deskripsi</th>
      <th>Opsi</th>
    </thead>
    <tbody>
      <?php
      $nomor = 1;
      $sql = "SELECT * From `menu`";
      $query = mysqli_query($db,$sql);

      while ($view = mysqli_fetch_assoc($query)) {
       ?>
       <tr>
         <td><?php echo $nomor++ ;?></td>
         <td><img src="<?php echo $pictLink."/".$view['foto_menu']; ?>" class="img-thumbnail" height="220px" width="220px" alt="<?php echo $view['id_menu'];?>"> </td>
         <td><?php echo $view['nama_menu']; ?></td>
         <td><?php
         if ($view['kategori_menu'] == "snack") {
           echo "Makanan Ringan";
         }elseif ($view['kategori_menu'] == "meal") {
           echo "Makanan Berat";
         }elseif ($view['kategori_menu'] == "drinks") {
           echo "Minuman";
         }?></td>
         <td>Rp.<?php echo number_format($view['harga_menu'],0,',','.'); ?></td>
         <td>
           <?php if ($view['ketersediaan_menu'] == "TERSEDIA"): ?>
             <?php echo $view['ketersediaan_menu']; ?> <span class="badge badge-success"><i class="fas fa-check text-white"></i></span>
           <?php else: ?>
             <?php echo $view['ketersediaan_menu']; ?> <span class="badge badge-danger"><i class="fas fa-times text-white"></i></span>
           <?php endif; ?>
         </td>
         <td><?php echo $view['deskripsi_menu']; ?></td>
         <td>
           <a href="edit?data=menuinfo&id=<?php echo encrypt($view['id_menu']); ?>" title="Edit informasi menu" class="btn btn-rounded btn-success"><i class="fas fa-edit"></i> </a>
           &nbsp;
           <a href="edit?data=productimg&id=<?php echo encrypt($view['id_menu']); ?>" title="Edit gambar" class="btn btn-rounded btn-info"><i class="fas fa-image"></i> </a>
           &nbsp;
           <a href="delete?data=menu&id=<?php echo encrypt($view['id_menu']); ?>&name=<?php echo $view['nama_menu']; ?>" title="Hapus" class="btn btn-rounded btn-danger"><i class="fas fa-trash-alt"></i> </a>
         </td>
       </tr>
     <?php } ?>
    </tbody>
  </table>
</div>
