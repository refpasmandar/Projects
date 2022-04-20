<!-- Begin Page Content -->
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
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Laba Rugi</h6>
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
                    <a class="nav-link <?= ($hal == 'daftarSupplierLunas') ? 'active' : ''; ?>" href="<?= base_url('Closing/closingTabBukuBesar/' . $tanggal1 . '/' . $tanggal2) ?>">Buku Besar</a>
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
                    <div class="text-right">
                        <form method="post" action="<?php echo base_url('Laporan/Laba_rugi/cetakLabaRugi') ?>">
                            <div class="form-group">
                                <input class="form-control" name="tanggal1labarugi" type="date" value="<?php echo $tanggal1 ?>" hidden>
                                <?php echo form_error('tanggal1labarugi') ?>
                            </div>
                            <div class="form-group">
                                <input class="form-control" name="tanggal2labarugi" type="date" value="<?php echo $tanggal2 ?>" hidden>
                                <?php echo form_error('tanggal2labarugi') ?>
                            </div>
                            <div class="text-right">
                                <label class="text-white" for="">aa</label>
                                <button type="submit" class="btn btn-primary"><i class="fas fa-print mr-1"></i>Cetak</button>
                            </div>
                        </form>
                    </div>
                    <div class="text-center mt-4">
                        <?php foreach ($profil as $pr) { ?>
                            <h5 class="text-primary"><?php echo $pr->nama_perusahaan ?></h5>
                        <?php } ?>
                        <p>Laporan Laba Rugi</p>
                        <p class="font-weight-bold">Periode <?= format_indo($tanggal1) ?> - <?= format_indo($tanggal2) ?></p>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="table-responsive mt-3 col-12">
                            <table class="table table-borderless" style="font-size:1rem;">
                                <thead>
                                    <tr class="font-weight-bold text-primary">
                                        <td>Pendapatan</td>
                                        <td></td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $total_pendapatan = 0;
                                    $total = 0;
                                    foreach ($pendapatan as $na) { ?>
                                        <tr class="">
                                            <?php if ($na->level == 1) { ?>
                                                <td class="font-weight-bolder"><?= $na->nama_akun ?></td>
                                                <td></td>
                                            <?php } else if ($na->level == 2) { ?>
                                                <td class="level_2 font-weight-bolder"><?php echo $na->nama_akun ?></td>
                                                <td></td>
                                            <?php } else if ($na->level == 3) { ?>
                                                <td class="level_3 font-weight-bolder"><?php echo $na->nama_akun ?></td>
                                                <td></td>
                                            <?php } else { ?>
                                                <td class="level_4"><?= $na->nama_akun ?></td>
                                                <?php if ($na->saldo_jurnal < 0) { ?>
                                                    <td class="level_4 text-right">Rp <?= substr(number_format($na->saldo_jurnal, 0, ',', '.'), 1, 19) ?></td>
                                                <?php } else { ?>
                                                    <td class="level_4 text-right">Rp <?= substr(number_format($na->saldo_jurnal, 0, ',', '.'), 0, 19) ?></td>
                                                <?php } ?>
                                                <?php $total_pendapatan = $total_pendapatan + $na->saldo_jurnal ?>
                                            <?php } ?>
                                        </tr>

                                    <?php } ?>
                                    <tr class="">
                                        <td class="font-weight-bold text-primary">TOTAL PENDAPATAN
                                        </td>
                                        <?php if ($total_pendapatan < 0) { ?>
                                            <td class="font-weight-bold text-right text-primary">Rp <?= substr(number_format($total_pendapatan, 0, ',', '.'), 1.19) ?>
                                            </td>
                                        <?php } else { ?>
                                            <td class="font-weight-bold text-right text-primary">Rp <?= substr(number_format($total_pendapatan, 0, ',', '.'), 0.19) ?>
                                            </td>
                                        <?php } ?>
                                    </tr>
                                </tbody>
                            </table>
                            <hr>
                            <table class="table table-borderless" style="font-size:1rem;">
                                <thead>
                                    <tr class="font-weight-bold text-danger">
                                        <td><br>Pengeluaran</td>
                                        <td></td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $total_pengeluaran = 0;
                                    $total = 0;
                                    foreach ($pengeluaran as $na) { ?>
                                        <tr class="">
                                            <?php if ($na->level == 1) { ?>
                                                <td class="font-weight-bolder"><?= $na->nama_akun ?></td>
                                                <td></td>
                                            <?php } else if ($na->level == 2) { ?>
                                                <td class="level_2 font-weight-bolder"><?php echo $na->nama_akun ?></td>
                                                <td></td>
                                            <?php } else if ($na->level == 3) { ?>
                                                <td class="level_3 font-weight-bolder"><?php echo $na->nama_akun ?></td>
                                                <td></td>
                                            <?php } else { ?>
                                                <td class="level_4"><?= $na->nama_akun ?></td>
                                                <td class="level_4 text-right">Rp <?= number_format($na->saldo_jurnal, 0, ',', '.') ?></td>
                                                <?php $total_pengeluaran = $total_pengeluaran + $na->saldo_jurnal ?>
                                            <?php } ?>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                    <tr class="">
                                        <td class="font-weight-bold text-danger">TOTAL PENGELUARAN
                                        </td>
                                        <td class="font-weight-bold text-right text-danger">Rp <?= number_format($total_pengeluaran, 0, ',', '.') ?>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <table class="table table-borderless" style="font-size:1rem;">
                                <thead>
                                    <?php
                                    if ($total_pendapatan == 0 && $total_pengeluaran == 0) {
                                        $total_laba_rugi = 0 - 0;
                                    } else if ($total_pendapatan == 0 && $total_pengeluaran != 0) {
                                        $total_laba_rugi = 0 - $total_pengeluaran;
                                    } else if ($total_pendapatan != 0 && $total_pengeluaran == 0) {
                                        $total_laba_rugi = substr($total_pendapatan, 1, 19) - 0;
                                    } else {
                                        $total_laba_rugi = substr($total_pendapatan, 1, 19) - $total_pengeluaran;
                                    }
                                    ?>
                                    <?php if ($total_laba_rugi < 0) { ?>
                                        <tr class=" bg-danger text-white text-center">
                                            <td class="font-weight-bold">TOTAL RUGI BERSIH
                                            </td>
                                            <td class="font-weight-bold text-right">(Rp <?= substr(number_format($total_laba_rugi, 0, ',', '.'), 1) ?>)
                                            </td>
                                        </tr>
                                    <?php } else if ($total_laba_rugi > 0) { ?>
                                        <tr class="bg-success text-white">
                                            <td class="font-weight-bold text-center">TOTAL LABA BERSIH
                                            </td>
                                            <td class="font-weight-bold text-right">Rp <?= number_format($total_laba_rugi, 0, ',', '.') ?>
                                            </td>
                                        </tr>
                                    <?php } else if ($total_laba_rugi == 0) { ?>
                                        <tr class="bg-info text-white">
                                            <td class="font-weight-bold text-center">SEIMBANG
                                            </td>
                                            <td class="font-weight-bold text-right">Rp <?= number_format($total_laba_rugi, 0, ',', '.') ?>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>