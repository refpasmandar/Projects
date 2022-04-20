<div class="container-fluid">
    <p class="title_halaman text-dark"><i class="fas fa-people-carry"></i> Tambah Pemasok</p>
    <hr>


    <!-- Button kembali -->
    <div class='text-right btnBack'>
        <a class="btn btn-sm btn-warning" href="<?php echo base_url('Master_data/Supplier/daftarSupplier'); ?>"><i class="fas fa-arrow-circle-left"></i> Kembali</a>
    </div>

    <div class="card">
        <div class="card-header">
            <h6 class="font-weight-bold text-primary">Form Tambah Pemasok</h6>
        </div>
        <div class="card-body">
            <form method="post" name="addPegawai" action="<?php echo base_url('Master_data/Supplier/prosesTambah') ?>">
                <div class="form-group">
                    <label for="Kode Supplier">Kode Pemasok <span class="text-danger">*</span></label>
                    <input class="form-control" name="kode_supp" type="text" value="<?php echo set_value('kode_supp') ?>">
                    <?php echo form_error('kode_supp') ?>
                </div>
                <div class="form-group">
                    <label for="Nama Supplier">Nama Pemasok <span class="text-danger">*</span></label>
                    <input class="form-control" name="nama_supplier" type="text" value="<?php echo set_value('nama_supplier') ?>">
                    <?php echo form_error('nama_supplier') ?>
                </div>
                <div class="form-group">
                    <label for="Nomor Telepon Supplier">Nomor Telepon <span class="text-danger">*</span></label>
                    <input class="form-control" name="no_telp" onkeypress="return hanyaAngka(event)" value="<?php echo set_value('no_telp') ?>">
                    <?php echo form_error('no_telp') ?>
                </div>
                <div class="form-group">
                    <label for="Alamat Supplier">Alamat <span class="text-danger">*</span></label>
                    <input class="form-control" name="alamat" type="text" value="<?php echo set_value('alamat') ?>">
                    <?php echo form_error('alamat') ?>
                </div>
                <div class="form-group">
                    <label for="Email Supplier">Email <span class="text-danger">*</span></label>
                    <input class="form-control" name="email" type="email" value="<?php echo set_value('email') ?>">
                    <?php echo form_error('email') ?>
                </div>
                <p class="text-danger reminder"><span>*</span> : Wajib Diisi</p>
                <div class="text-center">
                    <button type="submit" class="btn btn-sm btn-primary btn-submit"><i class="fas fa-save mr-1"></i> Simpan</button>
                    <button type="reset" class="btn btn-sm btn-danger btn-undo"><i class="fas fa-undo-alt mr-1"></i> Ulang</button>
                </div>
            </form>
        </div>
    </div>
</div>