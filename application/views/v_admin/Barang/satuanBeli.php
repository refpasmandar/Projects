<div class="container-fluid">
    <p class="title_halaman text-dark"><i class="fas fa-ruler-vertical"></i> Satuan Barang</p>
    <hr>
    <div class='text-right btnBack'>
        <a class="btn btn-sm btn-warning mt-4" href="<?php echo base_url('Master_data/Barang/Persediaan'); ?>"><i class="fas fa-arrow-circle-left"></i> Kembali</a>
    </div>


    <div class="card">
        <div class="card-header">
            <h6 class="text-primary font-weight-bold">Form Tambah Satuan Barang</h6>
        </div>
        <div class="card-body">
            <form name="satuan" method="post" action="<?php echo base_url('Master_data/Barang/tambahSatuanBeli') ?>">
                <div class="form-row">
                    <div class="form-group col-lg-6">
                        <label for="">Satuan Barang<span class="text-danger">*</span></label>
                        <input class="form-control" name="satuan_beli" type="text" onkeypress="return hanyaHuruf(event)" value="<?php echo set_value('satuan_beli') ?>">
                        <?php echo form_error('satuan_beli') ?>
                    </div>
                    <div class="form-group col-lg-6">
                        <label for="">Simbol Satuan<span class="text-danger">*</span></label>
                        <input class="form-control" name="simbol_satuan" type="text" onkeypress="return hanyaHuruf(event)" value="<?php echo set_value('simbol_satuan') ?>">
                        <?php echo form_error('simbol_satuan') ?>
                    </div>
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-sm btn-submit btn-primary mr-2"><i class="fas fa-save mr-1"></i> Simpan</button>
                    <button type="reset" class="btn btn-sm btn-undo btn-danger"><i class="fas fa-undo-alt mr-1"></i> Ulang</button>
                </div>
            </form>
        </div>
    </div>


    <hr>
    <div class="mt-4">
        <?php $this->view('flashdata') ?>
        <div class="table-responsive">
            <table class="table dtTable table-bordered table-stripped table-hover">
                <thead class="bg-primary text-white">
                    <tr class="text-center">
                        <td>No</td>
                        <td>Satuan</td>
                        <td>Simbol</td>
                        <td>Aksi</td>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    foreach ($satuan as $st) { ?>
                        <tr class="text-center">
                            <td><?php echo $no++ ?></td>
                            <td><?php echo $st->satuan_beli ?></td>
                            <td><?php echo $st->simbol_satuanbeli ?></td>
                            <td>
                                <?php echo anchor('Master_data/Barang/editSatuanBeli/' . $st->id_satuanbeli, '<div class="btn btn-sm btn-info"><i class="fa fa-edit mr-1"></i> Edit</div>') ?>
                                <a onclick="return confirm ('Anda Yakin Ingin Menghapus Data ?')" href="<?php echo base_url('Master_data/Barang/deleteSatuanBeli/') . $st->id_satuanbeli ?>" class="btn btn-sm btn-danger"><i class="fas fa-trash mr-1"></i> Hapus</a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>