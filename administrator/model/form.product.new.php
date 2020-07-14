<form id="form" action="control/script.product" method="post" enctype="multipart/form-data">
  <div class="form-group row">
    <div class="col-xl-2">
      <label class="text-white">ID</label>
    </div>
    <div class="col-xl-4">
      <input class="form-control" readonly required="" type="text" name="id" value="<?php echo autokode("menu", "menu"."-"); ?>">
    </div>
  </div>
  <div class="form-group row">
    <div class="col-xl-2">
      <label class="text-white">Kategori</label>
    </div>
    <div class="col-xl-4">
      <select class="custom-select" name="kategori" required>
        <option value="">-Kategori Menu-</option>
        <option value="snack">Makanan Ringan</option>
        <option value="meal">Makanan Berat</option>
        <option value="drinks">Minuman</option>
      </select>
    </div>
  </div>
  <div class="form-group row">
    <div class="col-xl-2">
      <label class="text-white">Nama Menu</label>
    </div>
    <div class="col-xl-4">
      <input class="form-control" required="" type="text" name="nama" value="">
    </div>
  </div>
  <div class="form-group row">
    <div class="col-xl-2">
      <label class="text-white">Harga Menu</label>
    </div>
    <div class="col-xl-4">
      <input class="form-control" required="" min="0" type="number" name="harga" value="" onkeypress="return OnlyNumber(event)">
    </div>
  </div>
  <div class="alert alert-info">
    <h4 class="text-center">Foto yang diperbolehkan dengan ekstensi : jpg, jpeg, bmp, png <br>
      Dengan maksimum ukuran 2mb
     </h4>
  </div>
  <!--Photo example -->
  <div class="form-group row">
    <div class="col-xl-2">
      <label class="text-white">Foto </label>
    </div>
    <div class="col-xl-4">
      <input class="form-control" required="" type="file" name="file1" value="" onchange="previewImg1(event)">
      <img class="previewImage img-thumbnail" id="preview1">
    </div>
  </div>
  <!--End Photo forms -->
  <div class="form-group row">
    <div class="col-xl-2">
      <label class="text-white">Ketersediaan</label>
    </div>
    <div class="col-xl-4">
      <label class="custom-control custom-radio custom-control-inline">
          <input type="radio" name="ketersediaan" checked="" class="custom-control-input" value="TERSEDIA" required>
          <span class="custom-control-label text-white">Tersedia</span>
      </label>
      <label class="custom-control custom-radio custom-control-inline">
          <input type="radio" name="ketersediaan"  class="custom-control-input" value="KOSONG" required>
          <span class="custom-control-label text-white">Kosong</span>
      </label>
    </div>
  </div>
  <div class="form-group row">
    <div class="col-xl-2">
      <label class="text-white">Deskripsi Menu</label>
    </div>
    <div class="col-xl-6">
      <textarea id="summernote" name="deskripsi"></textarea>
    </div>
  </div>

  <button type="submit" name="new" class="btn btn-block btn-primary"><i class="fas fa-plus"></i> Tambahkan Menu</button>
</form>
<script type="text/javascript">
  var summernoteplaceholder = "Tambahkan Deskripsi dari menu";
</script>
