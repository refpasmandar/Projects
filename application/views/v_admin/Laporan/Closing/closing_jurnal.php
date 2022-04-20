<div class="container-fluid">
    <p class="title_halaman"><i class="fas fa-times"></i> Tutup Buku</p>
    <hr>
    <?php
    $closing = $this->db->query("SELECT * from tb_jurnal where tanggal_transaksi >= '$tanggal1' and tanggal_transaksi <= '$tanggal2' and status = 'Close'")->num_rows();
    $transaksi = $this->db->query("SELECT * from tb_jurnal where tanggal_transaksi >= '$tanggal1' and tanggal_transaksi <= '$tanggal2'")->num_rows();
    if ($closing > 0) {
    ?>
        <div class="alert alert-info alert-dismissable">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true"><i class="fa fa-times fa-sm"></i></button>
            <h5><i class="fas fa-check-double"></i> Periode Sudah Ditutup</h5>
        </div>
    <?php } else if ($transaksi == 0) { ?>
        <div class="alert alert-warning alert-dismissable">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true"><i class="fa fa-times fa-sm"></i></button>
            <h5><i class="far fa-folder-open"></i> Tidak Ada Transaksi</h5>
        </div>
    <?php } ?>
    <div class="card">
        <div class="card-header">
            <h6 class="text-primary font-weight-bold">Jurnal <br>
                <span class="text-dark"><?php echo format_indo(date('Y-m-d', strtotime($tanggal1))) ?> - <?php echo format_indo(date('Y-m-d', strtotime($tanggal2))) ?></span>
            </h6>
        </div>
        <div class="card-body">
            <?php $hal_ = $this->uri->segment(1); ?>
            <?php $hal = $this->uri->segment(2); ?>
            <?php $subhal = $this->uri->segment(3); ?>
            <ul class="nav nav-tabs">
                <li class="nav-item">
                    <a class="nav-link <?= ($hal == 'closingJurnal' || $hal == 'closingTabJurnal') ? 'active' : ''; ?>" href="<?= base_url('Closing/closingTabJurnal/' . $tanggal1 . '/' . $tanggal2) ?>">Jurnal</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= ($hal == 'closingTabBukuBesar') ? 'active' : ''; ?>" href="<?= base_url('Closing/closingTabBukuBesar/' . $tanggal1 . '/' . $tanggal2) ?>">Buku Besar</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= ($hal == 'closingTabLabaRugi') ? 'active' : ''; ?>" href="<?= base_url('Closing/closingTabLabaRugi/' . $tanggal1 . '/' . $tanggal2) ?>">Laba - Rugi</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= ($hal == 'closingTabNeraca') ? 'active' : ''; ?>" href="<?= base_url('Closing/closingTabNeraca/' . $tanggal1 . '/' . $tanggal2) ?>">Neraca</a>
                </li>
            </ul>
            <div class="table-responsive">
                <table class="table table-striped table-border table-hover tb_laporan mb-5">
                    <thead class="text-center text-white bg-primary">
                        <tr class="table-bordered">
                            <td class="align-middle" rowspan="2">No</td>
                            <td class="align-middle" rowspan="2">Kode Transaksi</td>
                            <td class="align-middle" rowspan="2">Tanggal Transaksi</td>
                            <td class="align-middle" rowspan="2">Nomor Akun</td>
                            <td class="align-middle" colspan="2">Nama Akun</td>
                            <td class="align-middle" rowspan="2">Debit</td>
                            <td class="align-middle" rowspan="2">Kredit</td>
                        </tr>
                        <!-- <tr>
                            <th>Debit</th>
                            <th>Kredit</th>
                        </tr> -->
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        $debit = 0;
                        $kredit = 0;
                        foreach ($header as $head) { ?>
                            <tr class="text-center">
                                <!-- Header -->
                                <td><?php echo $no++ ?></td>
                                <?php if ($head->jenis_transaksi == 'Retur Pembelian') { ?>
                                    <td>
                                        <?php echo $head->kode_jurnal ?> <br>
                                        <span class="text-primary"><small>(Retur Pembelian)</small></span>
                                    </td>
                                <?php } else if ($head->jenis_transaksi == 'Retur Penjualan') { ?>
                                    <td>
                                        <?php echo $head->kode_jurnal ?> <br>
                                        <span class="text-primary"><small>(Retur Penjualan)</small></span>
                                    </td>
                                <?php } else if ($head->jenis_transaksi == 'Bayar Utang') { ?>
                                    <td>
                                        <?php echo $head->kode_jurnal ?> <br>
                                        <span class="text-primary"><small>(Pembayaran Utang)</small></span>
                                    </td>
                                <?php } else if ($head->jenis_transaksi == 'Terima Piutang') { ?>
                                    <td>
                                        <?php echo $head->kode_jurnal ?> <br>
                                        <span class="text-primary"><small>(Penerimaan Piutang)</small></span>
                                    </td>
                                <?php } else if ($head->jenis_transaksi == 'Pembelian') { ?>
                                    <td>
                                        <?php echo $head->kode_jurnal ?> <br>
                                        <span class="text-primary"><small>(Pembelian)</small></span>
                                    </td>
                                <?php } else if ($head->jenis_transaksi == 'Penjualan') { ?>
                                    <td>
                                        <?php echo $head->kode_jurnal ?> <br>
                                        <span class="text-primary"><small>(Penjualan)</small></span>
                                    </td>
                                <?php } else if ($head->jenis_transaksi == 'Jurnal') { ?>
                                    <td>
                                        <?php echo $head->kode_jurnal ?> <br>
                                        <span class="text-primary"><small>(Jurnal Entry)</small></span>
                                    </td>
                                <?php } else if ($head->jenis_transaksi == 'Piutang Awal') { ?>
                                    <td>
                                        <?php echo $head->kode_jurnal ?> <br>
                                        <span class="text-primary"><small>(Piutang Awal)</small></span>
                                    </td>
                                <?php } else if ($head->jenis_transaksi == 'Utang Awal') { ?>
                                    <td>
                                        <?php echo $head->kode_jurnal ?> <br>
                                        <span class="text-primary"><small>(Utang Awal)</small></span>
                                    </td>
                                <?php } ?>
                                <td><?php echo format_indo($head->tanggal_transaksi) ?></td>
                                <td colspan="5"></td>
                            </tr>
                            <?php
                            $akun = $this->db->query("SELECT a.*,b.*
                            from tb_jurnal a
                            join tb_akun b on a.id_akun = b.id_akun
                            where a.kode_jurnal = '$head->kode_jurnal' and a.tanggal_transaksi ='$head->tanggal_transaksi'
                            and a.jenis_transaksi ='$head->jenis_transaksi' and a.saldo_jurnal <> 0");
                            $jumlahBaris = $akun->num_rows();
                            $daftarAkun = $akun->result();
                            ?>
                            <?php foreach ($daftarAkun as $a) { ?>
                                <tr class="text-center">
                                    <td colspan="3"></td>
                                    <td><?php echo $a->kode_akun . '-' . $a->no_akun ?></td>
                                    <?php if ($a->posisi == 'Debit') { ?>
                                        <td><?php echo $a->nama_akun ?></td>
                                        <td></td>
                                        <td class="text-right">Rp <?php echo number_format($a->saldo_jurnal, 0, ',', '.') ?></td>
                                        <td class="text-right">-</td>
                                        <?php $debit = $debit + $a->saldo_jurnal ?>
                                    <?php } elseif ($a->posisi == 'Kredit') { ?>
                                        <td></td>
                                        <td><?php echo $a->nama_akun ?><br>
                                        <td class="text-right">-</td>
                                        <td class="text-right">Rp <?php echo substr(number_format($a->saldo_jurnal, 0, ',', '.'), 1) ?></td>
                                        <?php $kredit = $kredit + $a->saldo_jurnal ?>
                                    <?php } ?>
                                </tr>
                            <?php } ?>
                        <?php } ?>
                    <tfoot>
                        <tr class="bg-light">
                            <th class="table-bordered text-center text-primary" colspan="6">Total</th>
                            <th class="text-right text-primary">Rp <?php echo number_format($debit, 0, ',', '.') ?></th>
                            <?php if ($kredit == 0) { ?>
                                <th class="text-right text-primary">Rp <?php echo substr(number_format($kredit, 0, ',', '.'), 0) ?></th>
                            <?php } else { ?>
                                <th class="text-right text-primary">Rp <?php echo substr(number_format($kredit, 0, ',', '.'), 1) ?></th>
                            <?php } ?>
                        </tr>
                        <tr class="bg-light">
                            <?php if ($debit == substr($kredit, 1, 12)) { ?>
                                <th class="text-center bg-success text-white" colspan="8">SEIMBANG</th>
                            <?php } else { ?>
                                <th class="text-center bg-danger text-white" colspan="8">TIDAK SEIMBANG</th>
                            <?php } ?>
                        </tr>
                    </tfoot>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>