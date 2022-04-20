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
        <!-- DataTales Example -->
        <div class="laporan" style="font-size:10px;">
            <div class="col-lg-12">
                <?php foreach ($profil as $pr) { ?>
                    <img src="<?php echo ("uploads/") . $pr->logo ?>" class="logo" style="position: absolute; width: 80px; height: auto; left: 70px; top:40px;">
                <?php } ?>
                <table class="table table-borderless align-items-center" style="border-bottom:2px solid black;">
                    <tr>
                        <td class="text-center">
                            <h5 class="mt-4">
                                <?php foreach ($profil as $pr) : ?>
                                    <?php echo $pr->nama_perusahaan ?>
                                <?php endforeach ?>
                            </h5>
                            <p>Laporan Neraca</p>
                            <p>Per: <span class="text-primary"><?php echo format_indo($tanggal2neraca) ?></span></p>
                        </td>
                    </tr>
                </table>

                <div class="">
                    <div class="table-responsive mt-3">
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

                    <div class="table-responsive mt-3">
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
                                            // $akunModal = $this->db->query("SELECT id_akun from tb_linkacc where keterangan_link = 'Akun Laba'")->row_array();
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
</body>

</html>