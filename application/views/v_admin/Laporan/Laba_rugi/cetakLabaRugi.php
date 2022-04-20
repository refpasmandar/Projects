<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>TOKO RAHAYU BERKAH</title>

    <!-- Custom fonts for this template-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">

    <!-- Memanggil CSS -->
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/css/style.css">
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/vendor/bootstrap/css/bootstrap.css">
    <script src="<?php echo base_url() ?>assets/vendor/bootstrap/js/bootstrap.bundle.js"></script>

</head>

<body>
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="text-center mt-4">
                    <?php foreach ($profil as $pr) { ?>
                        <h5 class="text-primary"><?php echo $pr->nama_perusahaan ?></h5>
                    <?php } ?>
                    <p>Laporan Laba Rugi</p>
                    <p class="font-weight-bold">Periode <?= format_indo($tanggal1labarugi) ?> - <?= format_indo($tanggal2labarugi) ?></p>
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
</body>

</html>