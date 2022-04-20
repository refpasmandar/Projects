<div class="container">
    <p class="title_halaman"><i class="fa fa-plus-circle"></i> Tambah Pegawai</p>
    <hr>

    <div class="row">
        <div class="col lg-12">
            <!-- Button kembali -->
            <div class='text-right btnBack'>
                <a class="btn btn-sm btn-warning" href="<?php echo base_url('Master_data/Pegawai/daftarPegawai');?>"><i class="fas fa-arrow-circle-left"></i> Kembali</a>
            </div>
            <form method="post" name="addPegawai" action="<?php echo base_url('Master_data/Pegawai/prosesTambah')?>">
                <div class="form-group">
                    <label for="">Nama Pegawai <span class="text-danger">*</span></label>
                    <input class="form-control" name="nama_pegawai" type="text" onkeypress="return hanyaHuruf(event)">
                    <?php echo form_error('nama_pegawai') ?>
                </div>
                <div class="form-group">
                    <label for="">Alamat Pegawai <span class="text-danger">*</span></label>
                    <input class="form-control" name="alamat_pegawai">
                    <?php echo form_error('alamat_pegawai') ?>
                </div>
                <div class="form-group">
                    <label for="">Nomor Telepon <span class="text-danger">*</span></label>
                    <input class="form-control" name="no_telp" type="text" onkeypress="return hanyaAngka(event)">
                    <?php echo form_error('no_telp') ?>
                </div>
                <p class="text-danger reminder"><span>*</span> : Wajib Diisi</p>
                <button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-plus"></i> Tambah</button>
                <button type="reset" class="btn btn-sm btn-danger"><i class="fa fa-eraser"></i> Bersihkan</button>
            </form>
        </div>
    </div>
</div>