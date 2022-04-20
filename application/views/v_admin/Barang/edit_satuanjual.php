<div class="container-fluid">
    <p class="title_halaman text-dark"><i class="fas fa-edit"></i> Edit Satuan Jual</p>
    <hr>

    <!-- Button Kembali -->
    <div class='col-md-12 text-right btnBack'>
        <a class="btn btn-sm btn-warning" href="<?php echo base_url('Master_data/Barang/satuanJual');?>"><i class="fas fa-arrow-circle-left"></i> Kembali</a>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <p>Form Edit Satuan Jual Barang</p>
                </div>
                <div class="card-body">
                <?php foreach($satuan as $st): ?>
                    <form method="post" action="<?php echo base_url('Master_data/Barang/prosesEditSatuanJual')?>">
                        <div class="form-group">
                            <label for="">Satuan <span class="text-danger">*</span></label>
                            <input type="hidden" class="form-control" name="id_satuan" value="<?php echo $st->id_satuan?>">
                            <input name ="satuan_jual" class="form-control" type="text" onkeypress="return hanyaHuruf(event)" value="<?php echo $st->satuan_jual?>">
                            <?php echo form_error('satuan_jual') ?>
                        </div>
                        <button type="submit" class="btn btn-sm btn-primary"><i class="far fa-save"></i> Simpan</button>
                        <button type="reset" class="btn btn-sm btn-danger"><i class="fa fa-eraser"></i> Bersihkan</button>
                    </form>
                <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</div>
