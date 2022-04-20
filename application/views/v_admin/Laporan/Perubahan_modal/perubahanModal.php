<!-- Begin Page Content -->
<div class="container-fluid">
    <p class="title_halaman"><i class="fas fa-chart-line"></i> Perubahan Modal</p>
    <hr>
    <!-- DataTales Example
    <div class='col-lg-12 text-right btnBack'>
        <a class="btn btn-sm btn-warning" href="<?php echo base_url('Laporan/Laba_rugi/filterLabaRugi') ?>"><i class="fas fa-arrow-circle-left"></i> Kembali</a>
    </div> -->

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Perubahan Modal</h6>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-lg-12">
                    <form method="post" action="<?php echo base_url('Laporan/Perubahan_modal/prosesFilterPerubahanModal') ?>">
                        <div class="form-row">
                            <div class="form-group col-lg-5">
                                <label for="tanggal1">Tanggal <span class="text-danger">*</span></label>
                                <input class="form-control" name="tanggal1modal" type="date">
                            </div>
                            <div class="form-group col-lg-5">
                                <label for="tanggal2">Tanggal <span class="text-danger">*</span></label>
                                <input class="form-control" name="tanggal2modal" type="date">
                            </div>
                            <div class="form-group col-lg-2">
                                <label class="text-white" for="">aa</label>
                                <button type="submit" class="btn btn-primary font-weight-bold form-control"> <i class="fas fa-search"></i> Tampilkan</button>
                            </div>
                        </div>
                    </form>
                    <div class="text-right">
                        <form method="get" action="<?php echo base_url('Laporan/Perubahan_modal/cetakPerubahanModal') ?>">
                            <div class="form-group">
                                <input class="form-control" name="tanggal1modal" type="date" value="<?php echo $tanggal1modal ?>" hidden>
                                <?php echo form_error('tanggal1modal') ?>
                            </div>
                            <div class="form-group">
                                <input class="form-control" name="tanggal2modal" type="date" value="<?php echo $tanggal2modal ?>" hidden>
                                <?php echo form_error('tanggal2modal') ?>
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
                        <p>Laporan Perubahan Modal</p>
                        <p class="font-weight-bold">Periode <?= format_indo($tanggal1modal) ?> - <?= format_indo($tanggal2modal) ?></p>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="table-responsive mt-3 col-12">
                            <table class="table table-borderless" style="font-size:1rem;">
                                <thead>
                                    <tr class="font-weight-bold text-primary">
                                        <td>Modal</td>
                                        <td></td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $modal_awal = 0;
                                    $total = 0;
                                    foreach ($modalAwal as $na) { ?>
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
                                                <td class="level_4 text-right">Rp <?= substr(number_format($na->saldo_awal, 0, ',', '.'), 1, 19) ?></td>
                                                <?php $modal_awal = $modal_awal + $na->saldo_awal ?>
                                            <?php } ?>
                                        </tr>
                                        <tr>
                                            <?php
                                            $pendapatan = substr($pendapatan['pendapatan'], 1);
                                            $pengeluaran = $pengeluaran['pengeluaran'];
                                            $laba = $pendapatan - $pengeluaran
                                            ?>
                                            <td class="level_4">Laba Bersih</td>
                                            <?php if ($laba > 0) { ?>
                                                <td class="level_4 text-right">Rp <?= substr(number_format($laba, 0, ',', '.'), 0, 19) ?></td>
                                            <?php } else if ($laba < 0) { ?>
                                                <td class="level_4 text-right">Rp <?= substr(number_format($laba, 0, ',', '.'), 1, 19) ?></td>
                                            <?php } else { ?>
                                                <td class="level_4 text-right">Rp <?= substr(number_format($laba, 0, ',', '.'), 0, 19) ?></td>
                                            <?php } ?>
                                        </tr>

                                    <?php } ?>
                                    <!-- <tr class="">
                                        <td class="font-weight-bold text-primary">Modal Akhir
                                        </td>
                                        <?php
                                        $modal_akhir = substr($modal_awal, 1) + $laba ?>
                                        <td class="font-weight-bold text-right text-primary">Rp <?= substr(number_format($modal_akhir, 0, ',', '.'), 1, 19) ?>
                                        </td>
                                    </tr> -->
                                </tbody>
                            </table>
                            <table class="table table-borderless">
                                <thead>
                                    <?php
                                    $modal_akhir = substr($modal_awal, 1) + $laba;
                                    ?>
                                    <?php if ($modal_akhir < 0) { ?>
                                        <tr class=" bg-primary text-white text-center">
                                            <td class="font-weight-bold white">
                                                Modal Akhir
                                            </td>
                                            <td class="font-weight-bold text-right text-white">
                                                Rp <?= substr(number_format($modal_akhir, 0, ',', '.'), 1, 19) ?>
                                            </td>
                                        </tr>
                                    <?php } else { ?>
                                        <tr class=" bg-primary text-white text-center">
                                            <td class="font-weight-bold text-white">
                                                Modal Akhir
                                            </td>
                                            <td class="font-weight-bold text-right text-white">
                                                Rp <?= substr(number_format($modal_akhir, 0, ',', '.'), 0, 19) ?>
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
</div>