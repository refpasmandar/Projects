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
                    <h6 class="m-0 font-weight-bold text-primary">Detail Pembelian</h6>
                </div>
                <div class="card-body">
                    <!--<p class="card-text">With supporting text below as a natural lead-in to additional content.</p>-->

                    <div class="col-lg-12">
                        <?php foreach ($jurnal as $j) : ?>
                            <?php if ($j->jenis_transaksi == 'Pembelian' || $j->jenis_transaksi == 'Utang Awal') { ?>
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
                            <table class="table table-bordered table-striped mb-4" id="">
                                <thead class="text-center bg-primary text-white font-weight-bold">
                                    <td>Nama Barang</td>
                                    <td>Kode Barang</td>
                                    <td>Kode Pabrik</td>
                                    <td>Jumlah</td>
                                    <td>Harga Beli</td>
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
                                                    <?= $k->qty_beli; ?>
                                                </td>
                                            <?php } else { ?>
                                                <td>
                                                    <?= $k->totalQtyBeli; ?>
                                                </td>
                                            <?php } ?>
                                            <td>Rp <?= number_format($k->harga_beli, 0, ',', '.') ?></td>
                                            <td>
                                                Rp <?= $k->diskon_beli; ?>
                                            </td>
                                            <?php if ($k->qtyRetur == 0) { ?>
                                                <td>
                                                    Rp <?= number_format($k->total_beli, 0, ',', '.'); ?>
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
                            <?php foreach ($detailInvoice as $b) : ?>
                                <label> Total Transaksi : </label>
                                <input value="Rp <?= number_format($b->totalTransaksi, 0, ',', '.') ?>" class="form-control" readonly>
                            <?php endforeach ?>
                        </div>
                        <div>
                            <?php foreach ($detailInvoice as $b) : ?>
                                <?php if ($b->totalBayar == 0) { ?>
                                    <label> Jumlah Bayar : </label>
                                    <input value="Rp <?= number_format($b->totalBayar, 0, ',', '.') ?>" class="form-control" readonly>
                                <?php } else { ?>
                                    <label> Jumlah Bayar : </label>
                                    <input value="Rp <?= substr(number_format($b->totalBayar, 0, ',', '.'), 1) ?>" class="form-control" readonly>
                                <?php } ?>
                            <?php endforeach ?>
                        </div>
                        <div>
                            <?php foreach ($detailInvoice as $u) : ?>
                                <?php if ($u->totalUtang == 0) { ?>
                                    <label> Jumlah Utang : </label>
                                    <input value="Rp <?= number_format($u->totalUtang, 0, ',', '.') ?>" class="form-control" readonly>
                                <?php } else if ($u->totalUtang != 0) { ?>
                                    <label> Jumlah Utang : </label>
                                    <input value="Rp <?= substr(number_format($u->totalUtang, 0, ',', '.'), 1) ?>" class="form-control" readonly>
                                <?php } ?>
                            <?php endforeach ?>
                        </div>
                    </div>

                    <div class="text-center mt-4">
                        <?php foreach ($detailInvoice as $t) { ?>
                            <?php if ($t->totalUtang == 0) { ?>
                                <a>
                                    <button type="button" class="btn font-weight-bold btn-success btn-submit"><i class="fas fa-check-double mr-1"></i></i>Lunas
                                    </button>
                                </a>
                            <?php } else { ?>
                                <a href="<?php echo base_url('Pembelian/Pembelian/bayarUtang/') . $t->kode_jurnal ?>">
                                    <button type="button" class="btn font-weight-bold btn-info btn-submit"><i class="fas fa-money-bill mr-1"></i>Bayar Utang
                                    </button>
                                </a>
                            <?php } ?>
                            <?php foreach ($jurnal as $j) { ?>
                                <?php if ($j->jenis_transaksi == 'Pembelian' || $j->jenis_transaksi == 'Utang Awal') { ?>
                                    <a href="<?php echo base_url('Pembelian/Pembelian/returBeli/') . $t->kode_jurnal . '/' . $j->tanggal_transaksi ?>"> <button type="button" class="btn font-weight-bold btn-primary btn-submit" data-dismiss=" modal"><i class="fas fa-exchange-alt mr-1"></i>Retur</button></a>
                                <?php } ?>
                            <?php } ?>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>