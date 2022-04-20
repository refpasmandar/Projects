<div class="container-fluid">
    <p class="title_halaman text-dark"><i class="fas fa-receipt"></i> Daftar Invoice</p>
    <hr>

    <div class="row">
        <div class="col-lg-12">
            <div class='text-right btnBack'>
                <a class="btn btn-sm btn-warning" href="<?php echo base_url('Pembelian/Pembelian/daftarPembelian'); ?>"><i class="fas fa-arrow-circle-left"></i> Kembali</a>
            </div>
            <div class="card">
                <div class="card-header">
                    <h6 class="font-weight-bold text-primary">Daftar Invoice
                        <small class="text-danger">
                            <?php foreach ($namasupp as $t) : ?>
                                <?= $t->nama_supplier ?>
                            <?php endforeach; ?>
                        </small>
                    </h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="bootstrap" class="table table-striped table-bordered">
                            <thead class="text-center bg-primary text-white">
                                <tr>
                                    <td class="align-middle" rowspan="2">No</td>
                                    <td class="align-middle" rowspan="2">
                                        <?php foreach ($setting as $set) : ?>
                                            <label for="Kode Transaksi"><?php echo $set->kode_transaksi ?></label>
                                        <?php endforeach; ?>
                                    </td>
                                    <td class="align-middle" rowspan="2">Tanggal Transaksi</td>
                                    <td class="align-middle" rowspan="2">Total Transaksi</td>
                                    <td class="align-middle" rowspan="2">Total Bayar </td>
                                    <td class="align-middle" rowspan="2">Total Utang </td>
                                    <td class="align-middle" rowspan="2">Aksi</td>
                                </tr>
                            </thead>
                            <tbody class="text-center">
                                <?php
                                $i  = 1;
                                $debit = 0;
                                $kredit = 0; ?>
                                <?php foreach ($testing as $t) : ?>
                                    <tr>
                                        <td><?php echo $i++ ?></td>
                                        <td class="text-center"><?= $t->kode_jurnal; ?></td>
                                        <td><?php echo format_indo(date('Y-m-d', strtotime($t->tanggal_terbaru))) ?></td>
                                        <td>Rp <?= substr(number_format($t->totalTransaksi, 0, ',', '.'), 0, 12) ?></td>
                                        <?php if ($t->totalBayar == 0) { ?>
                                            <td>Rp <?= substr(number_format($t->totalBayar, 0, ',', '.'), 0, 12) ?></td>
                                        <?php } else { ?>
                                            <td>Rp <?= substr(number_format($t->totalBayar, 0, ',', '.'), 1, 12) ?></td>
                                        <?php } ?>
                                        <?php if ($t->totalUtang == 0) { ?>
                                            <td> Rp <?= substr(number_format($t->totalUtang, 0, ',', '.'), 0, 12) ?> <span class="text-primary">(Lunas)</span></td>
                                        <?php } else { ?>
                                            <td> Rp <?= substr(number_format($t->totalUtang, 0, ',', '.'), 1, 12) ?></td>
                                        <?php } ?>
                                        <td class="text-center">
                                            <a href="<?= base_url(); ?>Pembelian/Pembelian/detailTransaksiPembelian/<?= $t->kode_jurnal . '/' . $t->tanggal_terbaru; ?>" class="btn btn-info"><i class="fas fa-file-invoice-dollar"></i> Detail</a></a>
                                        </td>
                                    </tr>
                                <?php endforeach ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>