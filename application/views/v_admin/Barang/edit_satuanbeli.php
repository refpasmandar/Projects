<div class="container-fluid">
    <p class="title_halaman text-dark"><i class="fas fa-ruler-vertical"></i> Edit Satuan Barang</p>
    <hr>

    <!-- Button Kembali -->
    <div class='text-right btnBack'>
        <a class="btn btn-sm btn-warning text-right" href="<?php echo base_url('Master_data/Barang/satuanBeli'); ?>"><i class="fas fa-arrow-circle-left"></i> Kembali</a>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h6 class="text-primary font-weight-bold">Form Edit Satuan Barang</h6>
                </div>
                <div class="card-body">
                    <?php foreach ($satuan as $st) : ?>
                        <form method="post" action="<?php echo base_url('Master_data/Barang/prosesEditSatuanBeli') ?>">
                            <div class="form-group">
                                <label for="">Satuan <span class="text-danger">*</span></label>
                                <input type="hidden" class="form-control" name="id_satuan" value="<?php echo $st->id_satuanbeli ?>">
                                <input name="satuan_beli" class="form-control" type="text" onkeypress="return hanyaHuruf(event)" value="<?php echo $st->satuan_beli ?>">
                                <?php echo form_error('satuan_beli') ?>
                            </div>
                            <div class="form-group">
                                <label for="">Simbol Satuan<span class="text-danger">*</span></label>
                                <input class="form-control" name="simbol_satuan" type="text" onkeypress="return hanyaHuruf(event)" value="<?php echo $st->simbol_satuanbeli ?>">
                                <?php echo form_error('simbol_satuan') ?>
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
    </div>
</div>