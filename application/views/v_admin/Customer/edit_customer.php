<div class="container-fluid">
    <p class="title_halaman text-dark"><i class="fas fa-people-carry"></i> Edit Pelanggan</p>
    <hr>

    <!-- Button Kembali -->
    <div class='text-right btnBack'>
        <a class="btn btn-sm btn-warning" href="<?php echo base_url('Master_data/Customer/daftarCustomer'); ?>"><i class="fas fa-arrow-circle-left"></i> Kembali</a>
    </div>

    <div class="card">
        <div class="card-header">
            <h6 class="text-primary font-weight-bold">Form Edit Pelanggan</h6>
        </div>
        <div class="card-body">
            <?php foreach ($cust as $ct) : ?>
                <form method="post" name="customer" action="<?php echo base_url('Master_data/Customer/prosesEdit') ?>">
                    <div class="form-group">
                        <label for="Kode Customer">Kode Pelanggan <span class="text-danger">*</span></label>
                        <input class="form-control" type="text" name="kode_cust" value="<?php echo $ct->kode_customer ?>">
                        <?php echo form_error('kode_cust') ?>
                    </div>
                    <div class="form-group">
                        <label for="Nama Customer">Nama Pelanggan <span class="text-danger">*</span></label>
                        <input class="form-control" type="hidden" name="id_customer" value="<?php echo $ct->id_customer ?>">
                        <input class="form-control" type="text" name="nama_customer" value="<?php echo $ct->nama_customer ?>">
                        <?php echo form_error('nama_customer') ?>
                    </div>
                    <div class="form-group">
                        <label for="Alamat Customer">Alamat<span class="text-danger">*</span></label>
                        <input class="form-control" type="text" name="alamat" value="<?php echo $ct->alamat_customer ?>">
                        <?php echo form_error('alamat') ?>
                    </div>
                    <div class="form-group">
                        <label for="Nomor Telepon Customer">Nomor Telepon <span class="text-danger">*</span></label>
                        <input class="form-control" type="text" name="no_telp" onkeypress="return hanyaANgka(event)" value="<?php echo $ct->telp_customer ?>">
                        <?php echo form_error('no_telp') ?>
                    </div>
                    <div class="form-group">
                        <label for="Email Customer">E-mail <span class="text-danger">*</span></label>
                        <input class="form-control" type="email" name="email" value="<?php echo $ct->email_customer ?>">
                        <?php echo form_error('email') ?>
                    </div>
                    <p class="text-danger reminder"><span>*</span> : Wajib Diisi</p>
                    <div class="text-center">
                        <button type="submit" class="btn btn-sm btn-submit btn-primary mr-2"><i class="fas fa-save mr-1"></i> Simpan</button>
                        <button type="reset" class="btn btn-sm btn-undo btn-danger"><i class="fas fa-undo-alt mr-1"></i> Ulang</button>
                    </div>
                </form>
            <?php endforeach; ?>
        </div>
    </div>
</div>