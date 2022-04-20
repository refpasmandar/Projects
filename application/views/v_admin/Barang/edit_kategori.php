<div class="container-fluid">
    <p class="title_halaman text-dark"><i class="fas fa-list-ol"></i> Edit Kategori Barang</p>
    <hr>

    <!-- Button Kembali -->
    <div class='col-md-12 text-right btnBack'>
        <a class="btn btn-sm btn-warning" href="<?php echo base_url('Master_data/Barang/kategoriBarang'); ?>"><i class="fas fa-arrow-circle-left"></i> Kembali</a>
    </div>

    <div class="card">
        <div class="card-header">
            <h6 class="font-weight-bold text-primary">Form Edit Kategori Barang</h6>
        </div>
        <div class="card-body">
            <?php foreach ($kategori as $kt) : ?>
                <form method="post" action="<?php echo base_url('Master_data/Barang/prosesEditKategori') ?>">
                    <div class="form-group">
                        <label for="">Kategori Barang <span class="text-danger">*</span></label>
                        <input type="hidden" class="form-control" name="id_kategori" value="<?php echo $kt->id_kategori ?>">
                        <input name="kategori_barang" class="form-control" type="text" onkeypress="return hanyaHuruf(event)" value="<?php echo $kt->kategori_barang ?>">
                        <?php echo form_error('kategori_barang') ?>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-sm btn-submit btn-primary mr-2"><i class="fas fa-save mr-1"></i> Simpan</button>
                        <button type="reset" class="btn btn-sm btn-undo btn-danger"><i class="fas fa-undo-alt mr-1"></i> Ulang</button>
                    </div>
                </form>
            <?php endforeach; ?>
        </div>
    </div>
</div>