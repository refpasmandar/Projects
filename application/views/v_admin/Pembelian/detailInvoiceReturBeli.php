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
                    <h6 class="m-0 font-weight-bold text-primary">Detail Retur</h6>
                </div>
                <div class="card-body">
                    <!--<p class="card-text">With supporting text below as a natural lead-in to additional content.</p>-->

                    <div class="col-lg-12">
                        <?php foreach ($jurnal as $j) : ?>
                            <?php if ($j->jenis_transaksi == 'Retur Pembelian') { ?>
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
                                    <td>Jumlah Retur</td>
                                    <td>Total</td>
                                </thead>
                                <tbody class="text-center">
                                    <?php foreach ($listRetur as $k) : ?>
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
                                            <td>
                                                <?= $k->qty_returbeli; ?>
                                            </td>
                                            <td>
                                                Rp <?php echo number_format($k->total_returbeli, 0, '.', '.') ?>
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
</div>