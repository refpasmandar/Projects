<div class="container-fluid">
    <p class="title_halaman text-dark"><i class="fas fa-list-ol"></i> Kategori Barang</p>
    <hr>
    <div class='col-md-12 text-right btnBack'>
        <a class="btn btn-sm btn-warning mt-4" href="<?php echo base_url('Master_data/Barang/Persediaan'); ?>"><i class="fas fa-arrow-circle-left"></i> Kembali</a>
    </div>


    <div class="card">
        <div class="card-header">
            <h6 class="font-weight-bold text-primary">Form Tambah Kategori Barang</h6>
        </div>
        <div class="card-body">
            <form name="satuan" method="post" action="<?php echo base_url('Master_data/Barang/tambahKategori') ?>">
                <div class="form-group">
                    <label for="">Kategori Barang <span class="text-danger">*</span></label>
                    <input class="form-control" name="kategori_barang" type="text" onkeypress="return hanyaHuruf(event)">
                    <?php echo form_error('kategori_barang') ?>
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
                        <td>Kategori</td>
                        <td>Aksi</td>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    foreach ($kategori as $kt) { ?>
                        <tr class="text-center">
                            <td><?php echo $no++ ?></td>
                            <td><?php echo $kt->kategori_barang ?></td>
                            <td>
                                <?php echo anchor('Master_data/Barang/editKategori/' . $kt->id_kategori, '<div class="btn btn-sm btn-info"><i class="fa fa-edit mr-1"></i> Edit</div>') ?>
                                <a onclick="return confirm ('Anda Yakin Ingin Menghapus Data ?')" href="<?php echo base_url('Master_data/Barang/deleteKategori/') . $kt->id_kategori ?>" class="btn btn-sm btn-danger"><i class="fas fa-trash mr-1"></i> Hapus</a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>