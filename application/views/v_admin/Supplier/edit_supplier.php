<div class="container-fluid">
    <p class="title_halaman text-dark"><i class="fas fa-people-carry"></i> Edit Pemasok</p>
    <hr>

    <!-- Button Kembali -->
    <div class='text-right btnBack'>
        <a class="btn btn-sm btn-warning" href="<?php echo base_url('Master_data/Supplier/daftarSupplier'); ?>"><i class="fas fa-arrow-circle-left"></i> Kembali</a>
    </div>

    <div class="card">
        <div class="card-header">
            <h6 class="font-weight-bold text-primary">Form Edit Pemasok</h6>
        </div>
        <div class="card-body">
            <?php foreach ($supp as $sp) : ?>
                <form method="post" name="supplier" action="<?php echo base_url('Master_data/Supplier/prosesEdit') ?>">
                    <div class="form-group">
                        <label for="Kode Supplier">Kode Pemasok <span class="text-danger">*</span></label>
                        <input class="form-control" type="text" name="kode_supp" value="<?php echo $sp->kode_supplier ?>">
                        <?php echo form_error('kode_supp') ?>
                    </div>
                    <div class="form-group">
                        <label for="Nama Supplier">Nama Pemasok <span class="text-danger">*</span></label>
                        <input class="form-control" type="hidden" name="id_supplier" value="<?php echo $sp->id_supplier ?>">
                        <input class="form-control" type="text" name="nama_supplier" value="<?php echo $sp->nama_supplier ?>">
                        <?php echo form_error('nama_supplier') ?>
                    </div>
                    <div class="form-group">
                        <label for="Alamat Supplier">Alamat<span class="text-danger">*</span></label>
                        <input class="form-control" type="text" name="alamat" value="<?php echo $sp->alamat_supplier ?>">
                        <?php echo form_error('alamat') ?>
                    </div>
                    <div class="form-group">
                        <label for="Nomor Telepon Supplier">Nomor Telepon <span class="text-danger">*</span></label>
                        <input class="form-control" type="text" name="no_telp" onkeypress="return hanyaANgka(event)" value="<?php echo $sp->telp_supplier ?>">
                        <?php echo form_error('no_telp') ?>
                    </div>
                    <div class="form-group">
                        <label for="Email Supplier">Email <span class="text-danger">*</span></label>
                        <input class="form-control" type="email" name="email" value="<?php echo $sp->email_supplier ?>">
                        <?php echo form_error('email') ?>
                    </div>
                    <p class="text-danger reminder"><span>*</span> : Wajib Diisi</p>
                    <div class="text-center">
                        <button type="submit" class="btn btn-sm btn-primary btn-submit"><i class="fas fa-save mr-1"></i> Simpan</button>
                        <button type="reset" class="btn btn-sm btn-danger btn-undo"><i class="fas fa-undo-alt mr-1"></i> Ulang</button>
                    </div>
                </form>
            <?php endforeach; ?>
        </div>
    </div>
</div>