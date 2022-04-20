<div class="container-fluid">
    <p class="title_halaman text-dark"><i class="fas fa-receipt"></i> Detail Invoice</p>
    <hr>

    <div class="row">
        <div class="col-lg-12">
            <div class='text-right btnBack'>
                <a class="btn btn-sm btn-warning" onclick="goBack()"><i class="fas fa-arrow-circle-left"></i> Kembali</a>
            </div>
            <?php $this->view('flashdata') ?>
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Detail Penjualan</h6>
                </div>
                <div class="card-body">
                    <!--<p class="card-text">With supporting text below as a natural lead-in to additional content.</p>-->
                    <div class="col-lg-12 mt-3">
                        <?php foreach ($jurnal as $j) : ?>
                            <?php if ($j->jenis_transaksi == 'Penjualan' || $j->jenis_transaksi == 'Piutang Awal') { ?>
                                <table class="mb-4">
                                    <tbody>
                                        <tr>
                                            <td class="detail-invoice">
                                                <?php foreach ($setting as $set) { ?>
                                                    <?php echo $set->kode_transaksi ?>
                                                <?php } ?>
                                            </td>
                                            <td class="detail-invoice">:</td>
                                            <td class="detail-invoice"><span class="text-primary"><?= $j->kode_jurnal ?></span></td>
                                        </tr>
                                        <tr>
                                            <td class="detail-invoice">
                                                Tanggal Transaksi
                                            </td>
                                            <td class="detail-invoice">:</td>
                                            <td class="detail-invoice"><span class="text-primary"><?php echo format_indo(date('Y-m-d', strtotime($j->tanggal_transaksi))) ?></span></td>
                                        </tr>
                                        <tr>
                                            <td class="detail-invoice">
                                                Pegawai
                                            </td>
                                            <td class="detail-invoice">:</td>
                                            <td class="detail-invoice">
                                                <?php foreach ($getDataPegawai as $gp) { ?>
                                                    <span class="text-primary"><?= $gp->nama_user ?>
                                                    <?php } ?>
                                                    </span>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            <?php } ?>
                        <?php endforeach ?>
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped" id="">
                                <thead class="text-center bg-primary text-white">
                                    <td>Nama Barang</td>
                                    <td>Kode Barang</td>
                                    <td>Kode Pabrik</td>
                                    <td>Jumlah</td>
                                    <td>Harga Jual</td>
                                    <td>Diskon</td>
                                    <td>Total</td>
                                </thead>
                                <tbody class="text-center">
                                    <?php foreach ($listBarang as $k) : ?>
                                        <tr>
                                            <td>
                                                <?= $k->nama_barang; ?>
                                            </td>
                                            <td>
                                                <?= $k->kode_barang; ?>
                                            </td>
                                            <td>
                                                <?= $k->kode_pabrik; ?>
                                            </td>
                                            <?php if ($k->qtyRetur == 0) { ?>
                                                <td>
                                                    <?= $k->qty_jual; ?>
                                                </td>
                                            <?php } else { ?>
                                                <td>
                                                    <?= $k->totalQtyJual; ?>
                                                </td>
                                            <?php } ?>
                                            <td>Rp <?= number_format($k->harga_jual, 0, ',', '.') ?></td>
                                            <td>
                                                Rp <?= number_format($k->diskon_jual, 0, ',', '.'); ?>
                                            </td>
                                            <?php if ($k->qtyRetur == 0) { ?>
                                                <td>
                                                    Rp <?= number_format($k->total_jual, 0, ',', '.'); ?>
                                                </td>
                                            <?php } else { ?>
                                                <td>
                                                    Rp <?= number_format($k->totalTransaksi, 0, ',', '.'); ?>
                                                </td>
                                            <?php } ?>
                                        </tr>
                                    <?php endforeach ?>
                                </tbody>
                            </table>
                        </div>
                        <div>
                            <?php foreach ($detailInvoice as $u) : ?>
                                <?php if ($u->totalTransaksi < 0) { ?>
                                    <label> Jumlah Transaksi : </label>
                                    <input value="Rp <?= substr(number_format($u->totalTransaksi, 0, ',', '.'), 1) ?>" class="form-control" readonly>
                                <?php } ?>
                            <?php endforeach ?>
                        </div>
                        <div>
                            <?php foreach ($detailInvoice as $b) : ?>
                                <?php if ($b->totalBayar == 0) { ?>
                                    <label> Jumlah Bayar : </label>
                                    <input value="Rp <?= number_format($b->totalBayar, 0, ',', '.') ?>" class="form-control" readonly>
                                <?php } else { ?>
                                    <label> Jumlah Bayar : </label>
                                    <input value="Rp <?= substr(number_format($b->totalBayar, 0, ',', '.'), 0) ?>" class="form-control" readonly>
                                <?php } ?>
                            <?php endforeach ?>
                        </div>
                        <div>
                            <?php foreach ($detailInvoice as $u) : ?>
                                <?php if ($u->totalPiutang == 0) { ?>
                                    <label> Jumlah Piutang : </label>
                                    <input value="Rp <?= number_format($u->totalPiutang, 0, ',', '.') ?>" class="form-control" readonly>
                                <?php } else if ($u->totalPiutang != 0) { ?>
                                    <label> Jumlah Piutang : </label>
                                    <input value="Rp <?= substr(number_format($u->totalPiutang, 0, ',', '.'), 0) ?>" class="form-control" readonly>
                                <?php } ?>
                            <?php endforeach ?>
                        </div>
                    </div>

                    <div class="text-center mt-4">
                        <?php foreach ($detailInvoice as $t) { ?>
                            <?php if ($t->totalPiutang == 0) { ?>
                                <a>
                                    <button type="button" class="btn font-weight-bold btn-success btn-submit"><i class="fas fa-check-double mr-1"></i></i>Lunas
                                    </button>
                                </a>
                            <?php } else { ?>
                                <a href="<?php echo base_url('Penjualan/Penjualan/terimaPiutang/') . $t->kode_jurnal ?>"> <button type="button" class="btn font-weight-bold btn-info btn-submit"><i class="fas fa-money-bill mr-1"></i>Terima Piutang</button></a>
                            <?php } ?>
                            <?php foreach ($jurnal as $j) { ?>
                                <?php if ($j->jenis_transaksi == 'Penjualan' || $j->jenis_transaksi == 'Piutang Awal') { ?>
                                    <a href="<?php echo base_url('Penjualan/Penjualan/returJual/') . $t->kode_jurnal . '/' . $j->tanggal_transaksi ?>"> <button type="button" class="btn font-weight-bold btn-primary btn-submit"><i class="fas fa-exchange-alt mr-1"></i>Retur</button></a>
                                <?php } ?>
                            <?php } ?>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>