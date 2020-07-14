<div class="card-header">
  <h2 class="text-center">Buat Reservasi Baru</h2>
</div>
<div class="card-body">
  <div class="row">
    <div class="col-xl-4">
      <div class="alert bg-info">
        <h3 class="text-white pb-4">Info : Minggu tutup</h3>
      </div>
    </div>
    <div class="col-xl-4">
      <div class="alert bg-success">
        <h3 class="text-white pb-4">Pembayaran menu dilakukan di cafe</h3>
      </div>
    </div>
    <div class="col-xl-4">
      <div class="alert bg-warning">
        <h3 class="text-white">Reservasi yang sudah dibayar tidak bisa diubah</h3>
      </div>
    </div>
  </div>
  <form id="form" class="" action="control/script.reservation" method="post">

    <div class="form-group row justify-content-center">
      <div class="col-xl-2">
        <h4 class="text-dark text-bold">Pilih Tanggal</h4>
      </div>
      <div class="col-xl-6">
        <input type="text" class="form-control" hidden name="reservation" value="<?php echo $_GET['id']; ?>" required>
          <input type="text" class="form-control" hidden name="user" value="<?php echo encrypt($_SESSION["id"]); ?>" required>
        <input class="form-control" type="date" name="tanggal" required id="date1">
      </div>
    </div>
    <div class="form-group row justify-content-center">
      <div class="col-xl-2">
        <h4 class="text-dark text-bold">Pilih Waktu Reservasi</h4>
      </div>
      <div class="col-xl-6">
        <select class="custom-select" name="waktu" required onchange="return ReservationPrice(this.value)">
          <option value="">Harap pilih</option>
          <optgroup label="Pagi">
            <option value="pagi">Pagi (11:00 - 12:00)</option>
          </optgroup>
          <optgroup label="Siang">
            <option value="siang-a">Siang (12:00 - 14:00)</option>
            <option value="siang-b">Siang (14:00 - 16:00)</option>
          </optgroup>
          <optgroup label="Sore">
            <option value="sore-a">Sore (16:00 - 18:00)</option>
            <option value="sore-b">Sore (18:00 - 20:00)</option>
          </optgroup>
          <optgroup label="Malam">
            <option value="malam">Malam (20:00 - 23:00)</option>
          </optgroup>
        </select>
      </div>
    </div>
    <div class="row justify-content-center">
      <div class="col-xl-3">
        <img src="<?php echo $interface."/images/zia - floor 1.jpg" ?>" alt="floor 1.jpg">
      </div>
      <div class="col-xl-3">
        <img src="<?php echo $interface."/images/zia - floor 2.jpg" ?>" alt="floor 2.jpg">
      </div>
    </div>
    <div class="form-group row justify-content-center">
      <div class="col-xl-2">
        <h4 class="text-dark text-bold">Pilih Meja</h4>
      </div>
      <div class="col-xl-6">
        <select class="custom-select" name="meja" required>
          <option value="">Harap pilih</option>
          <optgroup label="Lantai 1">
            <option value="1.1">1.1 Meja TV (6 Orang)</option>
            <option value="1.2">1.2 Meja Meeting (10 Orang)</option>
            <option value="2.1">2.1 Meja Jahit (2 Orang)</option>
            <option value="2.2">2.2 Meja Jahit (2 Orang)</option>
            <option value="3">3 Meja Kaca (4 Orang)</option>
            <option value="4.1">4.1 Sofa (4 Orang)</option>
            <option value="4.2">4.2 Sofa (4 Orang)</option>
            <option value="5.1">5.1 Meja Halaman Belakang (4 Orang)</option>
            <option value="5.2">5.2 Meja Halaman Belakang (4 Orang)</option>
            <option value="5.3">5.3 Meja Halaman Belakang (4 Orang)</option>
            <option value="5.4">5.4 Meja Halaman Belakang (4 Orang)</option>
            <option value="5.5">5.5 Meja Halaman Belakang (4 Orang)</option>
          </optgroup>
          <optgroup label="Lantai 2">
            <option value="6.1">6.1 Meja Jati (5 Orang)</option>
            <option value="6.2">6.2 Meja Jati (5 Orang)</option>
            <option value="7.1">7.1 Meja Jahit (4 Orang)</option>
            <option value="7.2">7.2 Meja Jahit (4 Orang)</option>
            <option value="8">8 Meja Kursi Tinggi (4 Orang)</option>
            <option value="9.1">9.1 Meja Taman Atas (4 Orang)</option>
            <option value="9.2">9.2 Meja Taman Atas (4 Orang)</option>
          </optgroup>
        </select>
      </div>
    </div>
    <div class="form-group row justify-content-center">
      <div class="col-xl-2">
        <h4 class="text-dark text-bold">Total Biaya Pemesanan</h4>
      </div>
      <div class="col-xl-6">
        <input class="form-control" type="text" name="harga" readonly required id="price">
      </div>
    </div>

    <div class="form-group">
      <button type="submit" name="update" class="btn btn-block btn-rounded btn-primary"><i class="fas fa-check"></i>  Buat Reservasi</button>
    </div>


  </form>
</div>
