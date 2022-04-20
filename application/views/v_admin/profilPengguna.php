<div class="container-fluid">
    <p class="title_halaman text-dark"><i class="far fa-address-card mr-1"></i> Profil Pengguna</p>
    <hr>


    <!-- Button kembali -->
    <div class='text-right btnBack'>
        <a class="btn btn-sm btn-warning" href="<?php echo base_url('Dashboard'); ?>"><i class="fas fa-arrow-circle-left"></i> Kembali</a>
    </div>
    <?php $this->view('flashdata') ?>
    <div class="card">
        <div class="card-header">
            <h6 class="font-weight-bold text-primary">Profil Pengguna</h6>
        </div>
        <div class="card-body">
            <form method="post" name="profilPengguna" action="<?php echo base_url('Profil/prosesEditProfil') ?>">
                <?php foreach ($profilPengguna as $pr) { ?>
                    <div class="form-group">
                        <label for="Kode Supplier">Nama Pengguna <span class="text-danger">*</span></label>
                        <input class="form-control" name="username" type="text" value="<?php echo $pr->username ?>">
                        <input type="hidden" name="id_user" value="<?php echo $pr->id_user ?>">
                        <?php echo form_error('username') ?>
                    </div>
                    <div class="form-group">
                        <label for="Nama Supplier">Nama Lengkap Pengguna <span class="text-danger">*</span></label>
                        <input class="form-control" name="nama_pengguna" type="text" value="<?php echo $pr->nama_user ?>">
                        <?php echo form_error('nama_pengguna') ?>
                    </div>
                    <div class="form-group">
                        <label for="Nomor Telepon Supplier">Nomor Telepon <span class="text-danger">*</span></label>
                        <input class="form-control" name="no_telp" onkeypress="return hanyaAngka(event)" value="<?php echo $pr->telp_user ?>">
                        <?php echo form_error('no_telp') ?>
                    </div>
                    <div class="form-group">
                        <label for="Alamat Supplier">Alamat <span class="text-danger">*</span></label>
                        <input class="form-control" name="alamat" type="text" value="<?php echo $pr->alamat_user ?>">
                        <?php echo form_error('alamat') ?>
                    </div>
                    <div class="form-group">
                        <label>Kata Sandi <span class="text-danger">(biarkan kosong jika tidak diganti)</span></label>
                        <input type="password" class="form-control" name="password" id="password" value='<?= set_value('password') ?>'>
                        <?php echo form_error('password') ?>
                    </div>
                    <div class="form-group">
                        <label>Konfirmasi Kata Sandi</label>
                        <input type="password" class="form-control" name="passconf" id="passconf" value='<?= set_value('passconf') ?>'>
                        <?php echo form_error('passconf') ?>
                    </div>
                    <p class="text-danger reminder"><span>*</span> : Wajib Diisi</p>
                    <div class="text-center">
                        <button type="submit" class="btn btn-sm btn-primary btn-submit"><i class="fas fa-save mr-1"></i> Simpan</button>
                        <button type="reset" class="btn btn-sm btn-danger btn-undo"><i class="fas fa-undo-alt mr-1"></i> Ulang</button>
                    </div>
                <?php } ?>
            </form>
        </div>
    </div>
</div>