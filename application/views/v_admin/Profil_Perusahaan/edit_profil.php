<div class="container-fluid">
    <p class="title_halaman"><i class="far fa-building"></i> Profil Usaha</p>
    <hr>

    <?php $this->view('flashdata') ?>
    <form class="mb-4" action="<?php echo base_url('Pengaturan/Perusahaan/updateProfil') ?>" method="post" enctype="multipart/form-data">
        <!-- Setting Website -->
        <div class="card">
            <div class="card-header">
                <h6 class="text-primary font-weight-bold">Form Setting Website</h6>
            </div>
            <div class="card-body">
                <?php foreach ($setting as $set) : ?>
                    <div class="form-row">
                        <div class="form-group col-lg-12">
                            <label for="Nama Perusahaan">Tanggal Awal Pembukuan <span class="text-danger">*</span></label>
                            <input type="hidden" name="id_setting" value="<?php echo $set->id_setting ?>">
                            <input class="form-control" name="tanggal_pembukuan" type="date" value="<?php echo $set->tanggal_pembukuan ?>">
                            <?php echo form_error('tanggal_pembukuan') ?>
                        </div>
                        <div class="form-group col-lg-12">
                            <label for="Kode Pembelian/Penjualan">Kode Pembelian/Penjualan</label>
                            <select name="kode_transaksi" id="kode_transaksi" class="form-control" value="<?php echo set_value('kode_transaksi') ?>">
                                <option value="" selected="selected" disabled="disabled">-- Pilih Kode --</option>
                                <option value="Nomor Invoice" <?php echo ($set->kode_transaksi == "Nomor Invoice") ? 'selected' : '' ?>>Nomor Invoice</option>
                                <option value="Kode Transaksi" <?php echo ($set->kode_transaksi == "Kode Transaksi") ? 'selected' : '' ?>>Kode Transaksi</option>
                                <option value="Nomor Faktur" <?php echo ($set->kode_transaksi == "Nomor Faktur") ? 'selected' : '' ?>>Nomor Faktur</option>
                            </select>
                            <?php echo form_error('kode_pembelian') ?>
                        </div>
                        <div class="form-group col-lg-12">
                            <label for="Alamat Perusahaan">Kode Entri Jurnal</label>
                            <select name="kode_entry" id="kode_entry" class="form-control" value="<?php echo set_value('kode_entry') ?>">
                                <option value="" selected="selected" disabled="disabled">-- Pilih Kode --</option>
                                <option value="Nomor Invoice" <?php echo ($set->kode_entry == "Nomor Invoice") ? 'selected' : '' ?>>Nomor Invoice</option>
                                <option value="Kode Transaksi" <?php echo ($set->kode_entry == "Kode Transaksi") ? 'selected' : '' ?>>Kode Transaksi</option>
                                <option value="Nomor Faktur" <?php echo ($set->kode_entry == "Nomor Faktur") ? 'selected' : '' ?>>Nomor Faktur</option>
                            </select>
                            <?php echo form_error('kode_entry') ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
        <br>
        <!-- Profil Perusahaan -->
        <div class="card">
            <div class="card-header">
                <h6 class="text-primary font-weight-bold">Form Profil Usaha</h6>
            </div>
            <div class=" card-body">
                <?php foreach ($profil as $pr) : ?>
                    <div class="form-row">
                        <div class="form-group col-lg-12">
                            <label for="Nama Perusahaan">Nama Usaha <span class="text-danger">*</span></label>
                            <input type="hidden" name="id_perusahaan" value="<?php echo $pr->id_perusahaan ?>">
                            <input class="form-control" name="nama_perusahaan" type="text" value="<?php echo $pr->nama_perusahaan ?>">
                            <?php echo form_error('nama_perusahaan') ?>
                        </div>
                        <div class="form-group col-lg-12">
                            <label for="Alamat Perusahaan">Alamat</label>
                            <textarea class="form-control" name="alamat"><?php echo $pr->alamat_perusahaan ?></textarea>
                            <?php echo form_error('alamat') ?>
                        </div>
                        <div class="form-group col-lg-4">
                            <label for="Provinsi Perusahaan">Provinsi <span class="text-danger">*</span></label>
                            <input class="form-control" name="provinsi" type="text" value="<?php echo $pr->provinsi ?>">
                            <?php echo form_error('provinsi') ?>
                        </div>
                        <div class="form-group col-lg-4">
                            <label for="Kota Perusahaan">Kota <span class="text-danger">*</span></label>
                            <input class="form-control" name="kota" type="text" value="<?php echo $pr->kota ?>">
                            <?php echo form_error('kota') ?>
                        </div>
                        <div class="form-group col-lg-4">
                            <label for="Kode Pos Perusahaan">Kode Pos <span class="text-danger">*</span></label>
                            <input class="form-control" name="kode_pos" type="text" value="<?php echo $pr->kode_pos ?>">
                            <?php echo form_error('kode_pos') ?>
                        </div>
                        <div class="form-group col-lg-6">
                            <label for="Nomor Telepon Perusahaan">Nomor Telepon #1 <span class="text-danger">*</span></label>
                            <input class="form-control" name="no_telp_1" type="text" value="<?php echo $pr->telp_perusahaan1 ?>">
                            <?php echo form_error('no_telp_1') ?>
                        </div>
                        <div class="form-group col-lg-6">
                            <label for="Nomor Telepon Perusahaan">Nomor Telepon #2</label>
                            <input class="form-control" name="no_telp_2" type="text" value="<?php echo $pr->telp_perusahaan2 ?>">
                        </div>
                        <div class="form-group col-lg-12">
                            <label for="Email Perusahaan">Email <span class="text-danger">*</span></label>
                            <input class="form-control" name="email" type="text" value="<?php echo $pr->email_perusahaan ?>">
                            <?php echo form_error('email') ?>
                        </div>
                        <div class="form-group col-lg-12">
                            <label>Logo Usaha </label><br>
                            <div class="col-lg-4">
                                <img src="<?php echo base_url('/uploads/' . $pr->logo) ?>" class="mb-2 preview" id="image-preview" alt="image preview" />
                            </div>
                            <input type="hidden" name='old_image' value="<?php echo $pr->logo ?>">
                            <input class="form-control" type="file" name="logo" id="logo" onchange="preview();">
                            <?php echo form_error('logo') ?>
                        </div>
                        <p class="text-danger reminder col-lg-12"><span>*</span> : Wajib Diisi</p>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-sm btn-primary mr-1 btn-submit"><i class="fas fa-save mr-1"></i> Simpan</button>
                        <button type="reset" class="btn btn-sm btn-danger btn-undo"><i class="fas fa-undo-alt mr-1"></i> Ulang</button>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </form>
</div>
<script>
    function preview() {
        document.getElementById("image-preview").style.display = "block";
        var oFReader = new FileReader();
        oFReader.readAsDataURL(document.getElementById("logo").files[0]);

        oFReader.onload = function(oFREvent) {
            document.getElementById("image-preview").src = oFREvent.target.result;
        };
    };
</script>