<div class="container-fluid">
    <p class="title_halaman"><i class="fas fa-people-carry"></i> Tambah Pelanggan</p>
    <hr>

    <!-- Button kembali -->
    <div class='text-right btnBack'>
        <a class="btn btn-sm btn-warning" href="<?php echo base_url('Master_data/Customer/daftarCustomer'); ?>"><i class="fas fa-arrow-circle-left"></i> Kembali</a>
    </div>

    <div class="card">
        <div class="card-header">
            <h6 class="text-primary font-weight-bold">Form Tambah Pelanggan</h6>
        </div>
        <div class="card-body">
            <form method="post" name="addCustomer" action="<?php echo base_url('Master_data/Customer/prosesTambah') ?>">
                <div class="form-group">
                    <label for="Kode Customer">Kode Pelanggan <span class="text-danger">*</span></label>
                    <input class="form-control" name="kode_cust" type="text" value="<?php echo set_value('kode_cust') ?>">
                    <?php echo form_error('kode_cust') ?>
                </div>
                <div class="form-group">
                    <label for="Nama Customer">Nama Pelanggan <span class="text-danger">*</span></label>
                    <input class="form-control" name="nama_customer" type="text" value="<?php echo set_value('nama_customer') ?>">
                    <?php echo form_error('nama_customer') ?>
                </div>
                <div class="form-group">
                    <label for="Nomor Telepon Customer">Nomor Telepon <span class="text-danger">*</span></label>
                    <input class="form-control" name="no_telp" onkeypress="return hanyaAngka(event)" value="<?php echo set_value('no_telp') ?>">
                    <?php echo form_error('no_telp') ?>
                </div>
                <div class="form-group">
                    <label for="Alamat Customer">Alamat <span class="text-danger">*</span></label>
                    <input class="form-control" name="alamat" type="text" value="<?php echo set_value('alamat') ?>">
                    <?php echo form_error('alamat') ?>
                </div>
                <div class="form-group">
                    <label for="Email Supplier">E-mail <span class="text-danger">*</span></label>
                    <input class="form-control" name="email" type="email" value="<?php echo set_value('email') ?>">
                    <?php echo form_error('email') ?>
                </div>
                <p class="text-danger reminder"><span>*</span> : Wajib Diisi</p>
                <div class="text-center">
                    <button type="submit" class="btn btn-sm btn-submit btn-primary mr-2"><i class="fas fa-save mr-1"></i> Simpan</button>
                    <button type="reset" class="btn btn-sm btn-undo btn-danger"><i class="fas fa-undo-alt mr-1"></i> Ulang</button>
                </div>
            </form>
        </div>
    </div>
</div>