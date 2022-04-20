<!-- Begin Page Content -->
<div class="container-fluid">
    <p class="title_halaman"><i class="fas fa-book"></i> Tutup Buku</p>
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
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Buku Besar
                <br>
                <span class="text-dark"><?= format_indo(date(($tanggal1))) . " Hingga " .  format_indo(($tanggal2)) ?></span>
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
            <div class="row">
                <div class="col-lg-12">
                    <hr>
                    <?php
                    $saldoawal = $this->db->query("SELECT a.*,b.* from tb_saldo a
                                                right Join tb_akun b on a.id_akun = b.id_akun
                                                where b.level = '4' and a.periode_saldo = '$tanggal1' order by b.kode_akun,b.no_akun")->result();
                    foreach ($saldoawal as $jr) { ?>
                        <div class="row" style="font-size:20px;">
                            <div class="col">
                                <div style="font-size:12px;">Nama Akun :</div>
                                <div class="text-primary font-weight-bold"> <?= $jr->nama_akun; ?></div>
                            </div>
                            <div class="col text-right">
                                <div style="font-size:12px;">Nomor Akun :</div>
                                <div class="text-primary font-weight-bold"> <?= $jr->kode_akun . '-' . $jr->no_akun; ?></div>
                            </div>
                        </div>
                        <div class="table-responsive mt-3">
                            <table id="bootstrap" class="table table-bordered">
                                <thead class="text-center bg-primary text-white">
                                    <tr>
                                        <td class="align-middle" rowspan="2">Tanggal Transaksi</td>
                                        <td class="align-middle" rowspan="2">Nama Akun</td>
                                        <td class="align-middle" rowspan="2">Debit</td>
                                        <td class="align-middle" rowspan="2">Kredit</td>
                                        <td class="align-middle" colspan="2">Saldo</td>
                                    </tr>
                                    <tr>
                                        <td>Debit</td>
                                        <td>Kredit</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $akun = $this->db->query("SELECT a.*,b.* from tb_saldo a
                                                right Join tb_akun b on a.id_akun = b.id_akun
                                                where b.level = '4' and a.id_akun = '$jr->id_akun' and a.periode_saldo = '$tanggal1'")->result();
                                    foreach ($akun as $sa) { ?>
                                        <?php if ($sa->saldo_awal != 0) { ?>
                                            <tr class="text-center">
                                                <td><?php echo $sa->periode_saldo ?></td>
                                                <td><?php echo $sa->nama_akun ?></td>
                                                <?php if ($sa->saldo_awal > 0) { ?>
                                                    <td class="text-right">
                                                        <?= 'Rp. ' . number_format($sa->saldo_awal, 0, ',', '.') ?>
                                                    </td>
                                                    <td class="text-right">Rp. 0</td>
                                                <?php } else { ?>
                                                    <td class="text-right">Rp. 0</td>
                                                    <td class="text-right">
                                                        <?= 'Rp. ' . substr(number_format($sa->saldo_awal, 0, ',', '.'), 1) ?>
                                                    </td>
                                                <?php } ?>
                                                <?php if ($sa->saldo_awal > 0) { ?>
                                                    <td class="text-right">
                                                        <?= 'Rp. ' . number_format($sa->saldo_awal, 0, ',', '.') ?>
                                                    </td>
                                                    <td class="text-right">-</td>
                                                <?php } else { ?>
                                                    <td class="text-right">-</td>
                                                    <td class="text-right">
                                                        <?= 'Rp. ' . substr(number_format($sa->saldo_awal, 0, ',', '.'), 1) ?>
                                                    </td>
                                                <?php } ?>
                                            </tr>
                                        <?php } ?>
                                    <?php } ?>

                                    <?php
                                    $id_akun = $jr->id_akun;
                                    $testing = $this->db->query("SELECT * from tb_saldo a
                                                where id_akun = '$id_akun' and periode_saldo = '$tanggal1'")->row_array();
                                    // $daftarTransaksi = $testing->result();
                                    $buku_besar = $this->M_laporan->closingBukuBesar($tanggal1, $tanggal2, $id_akun)->result();
                                    ?>
                                    <?php if (empty($buku_besar) && $testing['saldo_awal'] == 0) { ?>
                                        <tr>
                                            <td colspan='6' class="text-center">Tidak Ada Transaksi & Saldo Awal</td>
                                        </tr>
                                    <?php } else if (empty($buku_besar) && ($testing['saldo_awal'] < 0 || $testing['saldo_awal'] > 0)) {
                                        $no = 1;
                                        if (empty($testing['saldo_awal'])) {
                                            $debit = 0;
                                        } else {
                                            $debit = $testing['saldo_awal'];
                                        }
                                        $kredit = 0;
                                        $hasil = $debit - $kredit; ?>
                                        <tr>
                                            <td class="text-center bg-primary text-white" colspan="4"><b>Total</b></td>
                                            <?php if ($hasil >= 0) { ?>
                                                <td class="text-right text-success font-weight-bold"><?= 'Rp. ' . number_format($hasil, 0, ',', '.') ?></td>
                                                <td class="text-right text-danger"> - </td>
                                            <?php } elseif ($hasil < 0) { ?>
                                                <td class="text-right text-success"> - </td>
                                                <td class="text-right text-danger font-weight-bold"><?= 'Rp. ' . number_format(abs($hasil), 0, ',', '.') ?></td>
                                            <?php } ?>
                                        </tr>
                                    <?php } else { ?>
                                        <?php
                                        $no = 1;
                                        if (empty($testing['saldo_awal'])) {
                                            $debit = 0;
                                        } else {
                                            $debit = $testing['saldo_awal'];
                                        }
                                        $kredit = 0;
                                        foreach ($buku_besar as $bb) { ?>
                                            <tr class="text-center">
                                                <td><?php echo $bb->tanggal_transaksi ?></td>
                                                <td><?php echo $bb->nama_akun ?></td>
                                                <?php if ($bb->posisi == 'Debit') { ?>
                                                    <td class="text-right">
                                                        <?= 'Rp. ' . number_format($bb->saldo_jurnal, 0, ',', '.') ?>
                                                    </td>
                                                    <td class="text-right">Rp. 0</td>
                                                <?php } else if ($bb->posisi == 'Kredit' && $bb->saldo_jurnal == 0) { ?>
                                                    <td class="text-right">Rp. 0</td>
                                                    <td class="text-right">
                                                        <?= 'Rp. ' . substr(number_format($bb->saldo_jurnal, 0, ',', '.'), 0) ?>
                                                    </td>
                                                <?php } else { ?>
                                                    <td class="text-right">Rp. 0</td>
                                                    <td class="text-right">
                                                        <?= 'Rp. ' . substr(number_format($bb->saldo_jurnal, 0, ',', '.'), 1) ?>
                                                    </td>
                                                <?php } ?>
                                                <?php if ($bb->posisi == "Debit" && $bb->saldo_jurnal > 0) {
                                                    $debit = $debit + $bb->saldo_jurnal;
                                                } else if ($bb->posisi == "Kredit" && $bb->saldo_jurnal < 0) {
                                                    $kredit = $kredit + substr(($bb->saldo_jurnal), 1);
                                                }
                                                $hasil = $debit - $kredit;
                                                ?>
                                                <?php if ($hasil >= 0) { ?>
                                                    <td class="text-right"><?= 'Rp. ' . number_format($hasil, 0, ',', '.') ?></td>
                                                    <td class="text-right"> - </td>
                                                <?php } else { ?>
                                                    <td class="text-right"> - </td>
                                                    <td class="text-right"><?= 'Rp. ' . number_format(abs($hasil), 0, ',', '.') ?></td>
                                                <?php } ?>
                                            </tr>
                                        <?php } ?>
                                        <?php
                                        $debit = 0;
                                        $kredit = 0;
                                        ?>
                                        <td class="text-center bg-primary text-white" colspan="4"><b>Total</b></td>
                                        <?php if ($hasil >= 0) { ?>
                                            <td class="text-right text-success font-weight-bold"><?= 'Rp. ' . number_format($hasil, 0, ',', '.') ?></td>
                                            <td class="text-right text-danger"> - </td>
                                        <?php } elseif ($hasil < 0) { ?>
                                            <td class="text-right text-success"> - </td>
                                            <td class="text-right text-danger font-weight-bold"><?= 'Rp. ' . number_format(abs($hasil), 0, ',', '.') ?></td>
                                        <?php } ?>
                                    <?php } ?>
                                </tbody>
                            </table>
                            <hr class="mb-4" style="border-bottom:1px solid #007bff">
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>