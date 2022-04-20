<div class="container-fluid">
    <p class="title_halaman text-dark"><i class="fas fa-exchange-alt"></i> Retur Pembelian</p>
    <hr>

    <div class="row">
        <div class="col-lg-12">
            <div class='text-right btnBack'>
                <a class="btn btn-sm btn-warning" href="<?php echo base_url('Pembelian/Pembelian/daftarReturBeli'); ?>"><i class="fas fa-arrow-circle-left"></i> Kembali</a>
            </div>
            <div class="card">
                <div class="card-header">
                    <h6 class="text-primary font-weight-bold">Daftar Invoice Retur
                        <small class="detail-header">
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
                                            <label for="Kode Transaksi"><?php echo $set->kode_transaksi ?> <br> Pembelian</label>
                                        <?php endforeach; ?>
                                    </td>
                                    <td>Tanggal Transaksi</td>
                                    <td>Keterangan</td>
                                    <td class="align-middle" rowspan="2">Aksi</td>
                                </tr>
                            </thead>
                            <tbody class="text-center">
                                <?php
                                $i  = 1;
                                $debit = 0;
                                $kredit = 0; ?>
                                <?php foreach ($invoiceRetur as $t) : ?>
                                    <tr>
                                        <td><?php echo $i++ ?></td>
                                        <td class="text-center"><?= $t->kode_jurnal; ?></td>
                                        <td><?php echo format_indo($t->tanggal_transaksi) ?></td>
                                        <td><?php echo $t->memo ?></td>
                                        <td>
                                            <a href="<?= base_url(); ?>Pembelian/Pembelian/detailInvoiceReturPembelian/<?= $t->kode_jurnal . '/' . $t->tanggal_transaksi ?>" class="btn btn-info"><i class="fas fa-file-invoice-dollar"></i> Detail</a></a>
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