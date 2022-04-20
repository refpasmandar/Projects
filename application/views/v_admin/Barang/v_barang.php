<div class="container-fluid">
    <p class="title_halaman text-dark"><i class="fas fa-boxes"></i> Daftar Barang</p>
    <hr>

    <div class="row">
        <div class="col-lg-12">
            <a href="<?php echo base_url('Master_data/Barang/tambahBarang') ?>" class="btn btn-primary mb-4 mt-4"> <i class="fa fa-plus"></i> Tambah Barang</a>
            <a href="<?php echo base_url('Master_data/Barang/satuanBeli') ?>" class="btn btn-info mb-4 mt-4"> <i class="fas fa-ruler-vertical"></i> Satuan</a>
            <a href="<?php echo base_url('Master_data/Barang/kategoriBarang') ?>" class="btn btn-danger mb-4 mt-4"> <i class="fas fa-list-ol"></i></i> Kategori</a>
            <?php $this->view('flashdata') ?>
            <div class="table-responsive">
                <table class="table dtTable table-bordered table-striped table-hover">
                    <thead class="text-center bg-primary text-white">
                        <tr>
                            <td rowspan="2">No</td>
                            <td rowspan="2">Kode Barang</td>
                            <td rowspan="2">Kode Pabrik</td>
                            <td rowspan="2">Nama Barang</td>
                            <td rowspan="2">Nama Pemasok</td>
                            <td colspan="2">Beli</td>
                            <td rowspan="2">Nilai Konversi</td>
                            <td colspan="2">Jual</td>
                            <td colspan="3">Harga </td>
                            <td rowspan="2">Aksi</td>
                        </tr>
                        <tr>
                            <td>Stok</td>
                            <td>Satuan</td>
                            <td>Stok</td>
                            <td>Satuan</td>
                            <td>Beli</td>
                            <td>Pokok Penjualan</td>
                            <td>Jual</td>
                        </tr>
                    </thead>
                    <tbody class="text-center">
                        <?php
                        $no = 1;
                        foreach ($barang as $pdk) { ?>
                            <tr>
                                <td class="text-center"><?php echo $no++ ?></td>
                                <td><?php echo $pdk['kode_barang']; ?></td>
                                <td><?php echo $pdk['kode_pabrik']; ?></td>
                                <td><?php echo $pdk['nama_barang']; ?></td>
                                <td><?php echo $pdk['nama_supplier']; ?></td>
                                <td><?php echo round($pdk['stok_beli'], 2); ?></td>
                                <td><?php echo $pdk['satuan_beli']; ?></td>
                                <td><?php echo $pdk['nilai_konversi']; ?></td>
                                <td><?php echo $pdk['stok_jual']; ?></td>
                                <td><?php echo $pdk['satuan_jual']; ?></td>
                                <td><?php echo 'Rp ' . number_format($pdk['harga_beli'], 0, ',', '.'); ?></td>
                                <td><?php echo 'Rp ' . number_format($pdk['hpp'], 0, ',', '.'); ?></td>
                                <td><?php echo 'Rp ' . number_format($pdk['harga_jual'], 0, ',', '.'); ?></td>
                                <td class="text-center">
                                    <div class="btn-group" style="margin-bottom: 5px;">
                                        <a href="<?php echo base_url('Master_data/Barang/editBarang/' . $pdk['id_barang']) ?>"><button class="btn-info btn btn-sm" type="submit"><i class="fa fa-edit mr-1"></i> Edit</button></a>
                                    </div>
                                    <div class="btn-group" style="margin-bottom: 5px;">
                                        <a href="<?= base_url('Master_data/Barang/deleteBarang/' . $pdk['id_barang']) ?>" onclick="return confirm('Yakin ingin hapus data?')" class="btn-danger btn btn-sm"><i class="fas fa-trash mr-1"></i> Hapus</a>
                                    </div>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>