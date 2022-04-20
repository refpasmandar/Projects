<div class="container-fluid">
    <p class="title_halaman text-center">Satuan Jual Barang</p>
        <div class='col-md-12 text-right btnBack'>
            <a class="btn btn-sm btn-warning mt-4" href="<?php echo base_url('Master_data/Barang/Persediaan');?>"><i class="fas fa-arrow-circle-left"></i> Kembali</a>
        </div>
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <p>Tambah Satuan Jual</p>
                </div>
                <div class="card-body">
                    <form name="satuan" method="post" action="<?php echo base_url('Master_data/Barang/tambahSatuanJual')?>">
                        <div class="form-group">
                            <label for="">Satuan Barang<span class="text-danger">*</span></label>
                            <input class="form-control" name="satuan_jual" type="text" onkeypress="return hanyaHuruf(event)">
                            <?php echo form_error('satuan_jual') ?>
                        </div>
                        <button type="submit" class="btn btn-sm btn-primary"><i class="far fa-plus-square"></i> Tambah</button>
                        <button type="reset" class="btn btn-sm btn-danger"><i class="fa fa-eraser"></i> Bersihkan</button>
                    </form>
                </div>
            </div>
        </div>

        <hr>
        <div class="col-lg-12 mt-4">
            <?php $this->view('flashdata')?>
            <table class="table dtTable table-bordered table-stripped table-hover dt-responsive">
                <thead class="bg-primary text-white">
                    <tr class="text-center">
                        <td>No</td>
                        <td>Satuan</td>
                        <td>Aksi</td>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $no = 1;
                    foreach($satuan as $st) {?>
                        <tr class="text-center">
                            <td><?php echo $no++ ?></td>
                            <td><?php echo $st->satuan_jual ?></td>
                            <td>
                                <?php echo anchor('Master_data/Barang/editSatuanJual/'.$st->id_satuan, '<div class="btn btn-sm btn-info"><i class="fa fa-edit"></i></div>')?>
                                <a onclick="return confirm ('Anda Yakin Ingin Menghapus Data ?')" href="<?php echo base_url('Master_data/Barang/deleteSatuanJual/').$st->id_satuan?>" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
</div>