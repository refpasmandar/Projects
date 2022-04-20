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
            <h6 class="m-0 font-weight-bold text-primary">Neraca</h6>
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
                        <form method="get" action="<?php echo base_url('Laporan/Neraca/cetakNeraca') ?>">
                            <div class="form-group">
                                <input class="form-control" name="tanggal1neraca" type="date" value="<?php echo $tanggal1 ?>" hidden>
                                <?php echo form_error('tanggal1neraca') ?>
                            </div>
                            <div class="form-group">
                                <input class="form-control" name="tanggal2neraca" type="date" value="<?php echo $tanggal2 ?>" hidden>
                                <?php echo form_error('tanggal2neraca') ?>
                            </div>
                            <div class="text-right">
                                <label class="text-white" for="">aa</label>
                                <button type="submit" class="btn btn-primary"><i class="fas fa-print mr-1"></i>Cetak</button>
                            </div>
                        </form>
                    </div>
                    <?php foreach ($profil as $pr) { ?>
                        <img src="<?php echo base_url('/uploads/') . $pr->logo ?>" class="logo" style="position: absolute; width: 140px; height: auto; left: 100px;">
                    <?php } ?>
                    <table class="table table-borderless align-items-center">
                        <tr>
                            <td class="text-center">
                                <h5 class="">
                                    <?php foreach ($profil as $pr) : ?>
                                        <?php echo $pr->nama_perusahaan ?>
                                    <?php endforeach ?>
                                </h5>
                                <p>Laporan Neraca</p>
                                <p>Per: <span class="text-primary"><?php echo format_indo($tanggal2) ?></span></p>
                            </td>
                        </tr>
                    </table>

                    <div class="row">
                        <div class="table-responsive mt-3 col-6" style="border-right:1px solid #007bff;">
                            <table class="table table-border">
                                <thead>
                                    <tr class="font-weight-bold text-primary text-center ">
                                        <td>Kode Akun</td>
                                        <td>Keterangan</td>
                                        <td>Saldo</td>
                                    </tr>
                                </thead>
                                <tbody>

                                    <!-- AKTIVA  -->
                                    <tr class="">
                                        <td class="text-center bg-grey font-weight-bold text-primary" colspan="3">AKTIVA</td>
                                    </tr>

                                    <?php
                                    $total_aktiva = 0;
                                    $total = 0;
                                    $total_saldoAwal = 0;
                                    $total_l3 = 0;
                                    foreach ($neraca_aktiva as $na) { ?>
                                        <tr class="">
                                            <?php if ($na->level == 1) { ?>
                                                <td class="font-weight-bolder"><?= $na->kode_akun . "-" . $na->no_akun ?></td>
                                                <td class="font-weight-bolder"><?= $na->nama_akun ?></td>
                                                <td></td>
                                            <?php } else if ($na->level == 2) { ?>
                                                <td class="level_2 font-weight-bolder"><?php echo $na->kode_akun . '-' . $na->no_akun ?><span class="nama_akun"></td>
                                                <td class="level_2 font-weight-bolder"><?php echo $na->nama_akun ?></td>
                                                <td></td>
                                            <?php } else if ($na->level == 3) { ?>
                                                <td class="level_3 font-weight-bolder"><?php echo $na->kode_akun . '-' . $na->no_akun ?><span class="nama_akun"></td>
                                                <td class="level_3 font-weight-bolder"><?php echo $na->nama_akun ?></td>
                                                <td></td>
                                            <?php } else { ?>
                                                <td class="level_4"><?= $na->kode_akun . "-" . $na->no_akun ?></td>
                                                <td class="level_4"><?= $na->nama_akun ?></td>
                                                <?php if ($na->total == 0 && $na->saldo_awal < 0) { ?>
                                                    <td class="level_4 text-right">(Rp <?php echo substr(number_format($na->saldo_awal, 0, ',', '.'), 1) ?>) </td>
                                                    <?php $total_aktiva = $total_aktiva + $na->saldo_awal ?>
                                                <?php } else if ($na->total == 0) { ?>
                                                    <td class="level_4 text-right">Rp <?php echo number_format($na->saldo_awal, 0, ',', '.') ?></td>
                                                    <?php $total_aktiva = $total_aktiva + $na->saldo_awal ?>
                                                <?php } else { ?>
                                                    <td class="level_4 text-right">Rp <?php echo number_format($na->total, 0, ',', '.') ?></td>
                                                    <?php $total_aktiva = $total_aktiva + $na->total ?>
                                                <?php } ?>
                                            <?php } ?>
                                        </tr>
                                    <?php } ?>
                                    <tr class="">
                                        <td></td>
                                        <td class="font-weight-bold text-primary text-center">TOTAL AKTIVA
                                        </td>
                                        <td class="font-weight-bold text-right text-primary">Rp <?= number_format($total_aktiva, 0, ',', '.') ?>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <div class="table-responsive mt-3 col-6">
                            <table class="table table-border">
                                <thead>
                                    <tr class="font-weight-bold text-primary text-center ">
                                        <td>Kode Akun</td>
                                        <td>Keterangan</td>
                                        <td>Saldo</td>
                                    </tr>
                                </thead>
                                <tbody>

                                    <!-- AKTIVA  -->
                                    <tr class="">
                                        <td class="text-center bg-grey font-weight-bold text-primary" colspan="3">PASIVA</td>
                                    </tr>

                                    <?php
                                    $total_pasiva = 0;
                                    $total = 0;
                                    $total_saldoAwal = 0;
                                    $total_l3 = 0;
                                    $pendapatan = substr($pendapatan['pendapatan'], 1);
                                    $pengeluaran = $pengeluaran['pengeluaran'];
                                    foreach ($neraca_pasiva as $na) { ?>
                                        <tr class="">
                                            <?php if ($na->level == 1) { ?>
                                                <td class="font-weight-bolder"><?= $na->kode_akun . "-" . $na->no_akun ?></td>
                                                <td class="font-weight-bolder"><?= $na->nama_akun ?></td>
                                                <td></td>
                                            <?php } else if ($na->level == 2) { ?>
                                                <td class="level_2 font-weight-bolder"><?php echo $na->kode_akun . '-' . $na->no_akun ?><span class="nama_akun"></td>
                                                <td class="level_2 font-weight-bolder"><?php echo $na->nama_akun ?></td>
                                                <td></td>
                                            <?php } else if ($na->level == 3) { ?>
                                                <td class="level_3 font-weight-bolder"><?php echo $na->kode_akun . '-' . $na->no_akun ?><span class="nama_akun"></td>
                                                <td class="level_3 font-weight-bolder"><?php echo $na->nama_akun ?></td>
                                                <td></td>
                                            <?php } else { ?>
                                                <td class="level_4"><?= $na->kode_akun . "-" . $na->no_akun ?></td>
                                                <td class="level_4"><?= $na->nama_akun ?></td>
                                                <?php
                                                $akunModal = $this->db->query("SELECT id_akun from tb_linkacc where keterangan_link = 'Akun Laba'")->row_array();
                                                $laba = $pendapatan - $pengeluaran; ?>
                                                <?php if ($na->total == 0 && $na->saldo_awal == 0) { ?>
                                                    <td class="level_4 text-right">Rp <?php echo substr(number_format($na->saldo_awal, 0, ',', '.'), 0) ?></td>
                                                    <?php $total_pasiva = $total_pasiva + $na->saldo_awal ?>
                                                <?php } else if ($na->total == 0) { ?>
                                                    <td class="level_4 text-right">Rp <?php echo substr(number_format($na->saldo_awal, 0, ',', '.'), 1) ?></td>
                                                    <?php $total_pasiva = $total_pasiva + $na->saldo_awal ?>
                                                <?php } else { ?>
                                                    <td class="level_4 text-right">Rp <?php echo substr(number_format($na->total, 0, ',', '.'), 1) ?></td>
                                                    <?php $total_pasiva = $total_pasiva + $na->total ?>
                                                <?php } ?>
                                            <?php } ?>
                                        </tr>
                                    <?php } ?>
                                    <tr>
                                        <td></td>
                                        <td class="level_4 font-weight-bold">Laba Periode Ini</td>
                                        <?php if ($laba < 0) { ?>
                                            <td class="text-right font-weight-bold">(Rp <?php echo substr(number_format($laba, 0, ',', '.'), 1) ?>)</td>
                                            <?php $total_pasiva = $total_pasiva - $laba ?>
                                        <?php } else { ?>
                                            <td class="text-right font-weight-bold">Rp <?php echo number_format($laba, 0, ',', '.') ?></td>
                                            <?php $total_pasiva = $total_pasiva - $laba ?>
                                        <?php } ?>
                                    </tr>
                                    <tr class="">
                                        <td></td>
                                        <td class="font-weight-bold text-primary text-center">TOTAL PASIVA</td>
                                        <td class="font-weight-bold text-right text-primary">Rp <?= substr(number_format($total_pasiva, 0, ',', '.'), 1) ?>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <hr>
            <!-- <form method="post" action="<?php echo base_url('Closing/closingPeriode') ?>">
                <div class="form-group">
                    <input class="form-control" name="tanggal1" type="date" value="<?php echo $tanggal1 ?>" hidden>
                    <?php echo form_error('tanggal1') ?>
                </div>
                <div class="form-group">
                    <input class="form-control" name="tanggal2" type="date" value="<?php echo $tanggal2 ?>" hidden>
                    <?php echo form_error('tanggal2') ?>
                </div>
                <div class="text-right">
                    <label class="text-white" for="">aa</label>
                    <button type="submit" class="btn btn-danger"><i class="fas fa-times"></i> Tutup Buku</button>
                </div>
            </form> -->
            <?php if ($closing > 0) { ?>
                <div class="text-right">
                    <a class="btn btn-info mr-1 text-white"><i class="fas fa-check-double"></i> Periode Sudah Ditutup</a>
                </div>
            <?php } else if ($transaksi == 0) { ?>
                <div class="text-right">
                    <a class="btn btn-warning mr-1"><i class="far fa-folder-open"></i> Tidak Ada Transaksi</a>
                </div>
            <?php } else { ?>
                <div class="text-right">
                    <a onclick="return confirm ('Anda Yakin Ingin Menutup Periode ?')" href="<?php echo base_url('Closing/closingPeriode/') . $tanggal1 . '/' . $tanggal2 ?>" class="btn btn-danger mr-1"><i class="fas fa-times"></i> Tutup Buku</a>
                </div>
            <?php } ?>
        </div>
    </div>