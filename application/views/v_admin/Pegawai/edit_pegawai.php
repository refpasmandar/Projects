<div class="container">
    <p class="title_halaman text-dark"><i class="fas fa-edit"></i> Edit Pegawai</p>
    <hr>

    <div class="row">
        <div class="col-lg-12">
        <!-- Button Kembali -->
            <div class='text-right btnBack'>
                <a class="btn btn-sm btn-warning" href="<?php echo base_url('Master_data/Pegawai/daftarPegawai');?>"><i class="fas fa-arrow-circle-left"></i> Kembali</a>
            </div>
            <?php foreach($pegawai as $peg) : ?>
                <form method="post" name="coa" action="<?php echo base_url('Master_data/Pegawai/prosesEdit')?>">
                    <div class="form-group">
                        <label for="">Nama Pegawai <span class="text-danger">*</span></label>
                        <input class="form-control" type="hidden" name="id_pegawai" value="<?php echo $peg->id_pegawai?>">
                        <input class="form-control" type="text" name="nama_pegawai" onkeypress="return hanyaHuruf(event)" value="<?php echo $peg->nama_pegawai?>">
                        <?php echo form_error('nama_pegawai')?>
                    </div>
                    <div class="form-group">
                        <label for="">Alamat Pegawai <span class="text-danger">*</span></label>
                        <input class="form-control" type="text" name="alamat_pegawai" value="<?php echo $peg->alamat_pegawai?>">
                        <?php echo form_error('alamat_pegawai') ?>
                    </div>
                    <div class="form-group">
                        <label for="">Nomor Telepon <span class="text-danger">*</span></label>
                        <input class="form-control" type="text" name="no_telp" onkeypress="return hanyaHuruf(event)" value="<?php echo $peg->no_telp?>">
                        <?php echo form_error('no_telp') ?>
                    </div>
                    <p class="text-danger reminder"><span>*</span> : Wajib Diisi</p>
                    <button type="submit" class="btn btn-sm btn-primary"><i class="far fa-save"></i> Simpan</button>
                    <button type="reset" class="btn btn-sm btn-danger"><i class="fa fa-eraser"></i> Bersihkan</button>
                </form>
            <?php endforeach; ?>
    </div>
</div>