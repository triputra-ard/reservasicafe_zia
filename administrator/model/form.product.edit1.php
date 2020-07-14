<?php
$id = decrypt($_GET['id']);
$sql = "SELECT * from `menu` Where id_menu = '$id'";
$query = mysqli_query($db,$sql);
while ($info = mysqli_fetch_assoc($query)) {
 ?>
 <form id="form" action="control/script.product" method="post" enctype="multipart/form-data">
   <div class="form-group row">
     <div class="col-xl-2">
       <label class="text-white">ID</label>
     </div>
     <div class="col-xl-4">
       <input class="form-control" readonly required="" type="text" name="id" value="<?php echo $info['id_menu']; ?>">
     </div>
   </div>
   <div class="form-group row">
     <div class="col-xl-2">
       <label class="text-white">Tipe</label>
     </div>
     <div class="col-xl-4">
       <select class="custom-select" name="kategori" required>
         <option value="">-Kategori Menu-</option>
         <option value="snack" <?php if($info['kategori_menu'] == "snack") echo "selected"; ?> >Makanan Ringan</option>
         <option value="meal" <?php if($info['kategori_menu'] == "meal") echo "selected"; ?> >Makanan Berat</option>
         <option value="drinks" <?php if($info['kategori_menu'] == "drinks") echo "selected"; ?> >Minuman</option>
       </select>
     </div>
   </div>
   <div class="form-group row">
     <div class="col-xl-2">
       <label class="text-white">Nama Menu</label>
     </div>
     <div class="col-xl-4">
       <input class="form-control" required="" type="text" name="nama" value="<?php echo $info['nama_menu']; ?>">
     </div>
   </div>
   <div class="form-group row">
     <div class="col-xl-2">
       <label class="text-white">Harga Produk</label>
     </div>
     <div class="col-xl-4">
       <input class="form-control" required="" min="0" type="number" name="harga" value="<?php echo $info['harga_menu']; ?>" onkeypress="return OnlyNumber(event)">
     </div>
   </div>
   <div class="form-group row">
     <div class="col-xl-2">
       <label class="text-white">Ketersediaan</label>
     </div>
     <div class="col-xl-4">
       <label class="custom-control custom-radio custom-control-inline">
           <input type="radio" name="ketersediaan" class="custom-control-input" value="TERSEDIA" required <?php if($info['ketersediaan_menu'] == "TERSEDIA") echo "checked"; ?> >
           <span class="custom-control-label text-white">Tersedia</span>
       </label>
       <label class="custom-control custom-radio custom-control-inline">
           <input type="radio" name="ketersediaan"  class="custom-control-input" value="KOSONG" required <?php if($info['ketersediaan_menu'] == "KOSONG") echo "checked"; ?> >
           <span class="custom-control-label text-white">Kosong</span>
       </label>
     </div>
   </div>
   <div class="form-group row">
     <div class="col-xl-2">
       <label class="text-white">Deskripsi Menu</label>
     </div>
     <div class="col-xl-6">
       <textarea id="summernote" name="deskripsi"><?php echo $info['deskripsi_menu']; ?></textarea>
     </div>
   </div>

   <button type="submit" name="editinfo" class="btn btn-block btn-primary"><i class="fas fa-edit"></i>Perbarui Menu</button>
 </form>
<?php } ?>
<script type="text/javascript">
  var summernoteplaceholder = "Tambahkan Deskripsi dari Menu";
</script>
