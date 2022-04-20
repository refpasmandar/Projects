<div class="container">
    <p class="title_halaman text-dark"><i class="fas fa-edit"></i> Edit Periode Transaksi</p>
    <hr>

    <!-- Button Kembali -->
    <div class='col-md-12 text-right btnBack'>
        <a class="btn btn-sm btn-warning" href="<?php echo base_url('Master_data/Periode/daftarPeriode');?>"><i class="fas fa-arrow-circle-left"></i> Kembali</a>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <?php foreach($periode as $pr): ?>
            <form method="post" action="<?php echo base_url('Master_data/Periode/prosesEdit')?>">
                <div class="form-group">
                    <label for="">Periode Transaksi <span class="font-italic ket_trans">(Bulan/Tanggal/Tahun)</span> <span class="text-danger">*</span></label>
                    <input type="hidden" class="form-control" name="id_periode" value="<?php echo $pr->id_periode?>">
                    <input name ="periode" class="form-control" type="date" value="<?php echo strftime('%Y-%m-%d', strtotime($pr->periode)); ?>">
                    <?php echo form_error('periode') ?>
                </div>
                <div class="form-group">
                    <label for="">Keterangan</label>
                    <input class="form-control" name="keterangan_periode" type="text" value="<?php echo $pr->keterangan_periode?>">
                    <?php echo form_error('keterangan_periode') ?>
                </div>
                <button type="submit" class="btn btn-sm btn-primary"><i class="far fa-save"></i> Simpan</button>
                <button type="reset" class="btn btn-sm btn-danger"><i class="fa fa-eraser"></i> Bersihkan</button>
            </form>
            <?php endforeach; ?>
        </div>
    </div>
</div>
